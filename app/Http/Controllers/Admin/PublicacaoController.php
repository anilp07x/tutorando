<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publicacao;
use App\Models\AuditLog;
use App\Mail\PublicationStatusNotification;
use App\Services\CacheService;
use App\Services\FileValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class PublicacaoController extends Controller
{
    protected $cacheService;
    protected $fileService;
    
    /**
     * Constructor with dependency injection
     */
    public function __construct(CacheService $cacheService, FileValidationService $fileService)
    {
        $this->cacheService = $cacheService;
        $this->fileService = $fileService;
    }
    public function index(Request $request)
    {
        $query = Publicacao::with('user');

        // Filtrar por status se fornecido
        if ($request->has('status')) {
            if ($request->status === 'pendente') {
                $query->where('aprovado', false);
            } elseif ($request->status === 'aprovado') {
                $query->where('aprovado', true);
            }
        }

        // Filtrar por tipo
        if ($request->has('tipo') && $request->tipo) {
            $query->where('tipo', $request->tipo);
        }

        // Filtrar por busca
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                  ->orWhere('descricao', 'like', "%{$search}%")
                  ->orWhere('tipo', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Use query caching for better performance
        $cacheKey = 'admin.publicacoes.'.md5(json_encode($request->all()));
        $publicacoes = Cache::remember($cacheKey, 5, function () use ($query) {
            return $query->latest()->paginate(15);
        });

        // Get dashboard stats from cache service
        $stats = $this->cacheService->getDashboardStats();
        
        return view('admin.publicacoes.index', compact('publicacoes', 'stats'));
    }

    public function show(Publicacao $publicacao)
    {
        // Use cached version if available
        $publicacao = $this->cacheService->getPublicacao($publicacao->id);
        return view('admin.publicacoes.show', compact('publicacao'));
    }

    public function approve(Publicacao $publicacao)
    {
        $publicacao->update(['aprovado' => true]);
        
        // Send email notification
        $this->sendNotificationEmail($publicacao->user, $publicacao, 'approve', 'publicacao');
        
        // Log audit action
        $this->logAuditAction('approve', 1, 'publicacao');
        
        // Clear cache
        Cache::forget('publicacao-'.$publicacao->id);
        Cache::forget('admin-dashboard-stats');

        return redirect()->back()->with('success', 'Publicação aprovada com sucesso!');
    }

    public function reject(Publicacao $publicacao)
    {
        $publicacao->update(['aprovado' => false]);
        
        // Send email notification
        $this->sendNotificationEmail($publicacao->user, $publicacao, 'reject', 'publicacao');
        
        // Log audit action
        $this->logAuditAction('reject', 1, 'publicacao');
        
        // Clear cache
        Cache::forget('publicacao-'.$publicacao->id);
        Cache::forget('admin-dashboard-stats');

        return redirect()->back()->with('success', 'Publicação rejeitada com sucesso!');
    }

    public function destroy(Publicacao $publicacao)
    {
        try {
            // Delete the file if it exists
            if ($this->fileService) {
                $this->fileService->deleteFile($publicacao->conteudo_url);
            }
            
            // Log audit action before deletion
            $this->logAuditAction('delete', 1, 'publicacao', json_encode([
                'id' => $publicacao->id,
                'titulo' => $publicacao->titulo,
                'user_id' => $publicacao->user_id,
                'user_name' => $publicacao->user->name
            ]));
            
            $publicacao->delete();
            
            // Clear cache
            Cache::forget('admin-dashboard-stats');
            Cache::forget('public-publicacoes');
            
            return redirect()->route('admin.publicacoes.index')
                           ->with('success', 'Publicação excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Erro ao excluir publicação: ' . $e->getMessage());
        }
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'publicacao_ids' => 'required|array|min:1',
            'publicacao_ids.*' => 'exists:publicacaos,id'
        ]);

        $action = $request->action;
        $publicacaoIds = $request->publicacao_ids;
        $aprovado = $action === 'approve';

        try {
            // Update publications status
            $affectedRows = Publicacao::whereIn('id', $publicacaoIds)
                ->update(['aprovado' => $aprovado]);

            // Get publications with users for notifications
            $publicacoes = Publicacao::with('user')->whereIn('id', $publicacaoIds)->get();

            // Log audit action
            $this->logAuditAction($action, $publicacoes->count(), 'publicacao');

            // Send email notifications
            foreach ($publicacoes as $publicacao) {
                $this->sendNotificationEmail($publicacao->user, $publicacao, $action, 'publicacao');
                
                // Clear individual publication cache
                Cache::forget('publicacao-'.$publicacao->id);
            }
            
            // Clear relevant caches
            Cache::forget('admin-dashboard-stats');
            Cache::forget('public-publicacoes');

            $actionText = $aprovado ? 'aprovadas' : 'rejeitadas';
            $message = "✅ {$affectedRows} publicação(ões) {$actionText} com sucesso! Notificações por email foram enviadas aos usuários.";

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Erro ao processar ação em lote: ' . $e->getMessage());
        }
    }

    /**
     * Log audit action for administrative activities
     */
    private function logAuditAction($action, $count, $type, $data = null)
    {
        try {
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => $action,
                'model' => 'Bulk' . ucfirst($type),
                'model_id' => null,
                'data' => $data ?: json_encode([
                    'admin_user_name' => Auth::user()->name,
                    'affected_count' => $count,
                    'resource_type' => $type,
                    'timestamp' => now()
                ]),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log audit action: ' . $e->getMessage());
        }
    }

    /**
     * Send notification email to user
     */
    private function sendNotificationEmail($user, $item, $action, $type)
    {
        try {
            // Use the appropriate mail class based on the item type
            if ($type === 'publicacao') {
                Mail::to($user->email)
                    ->queue(new PublicationStatusNotification($user, $item, $action));
            }
            
            Log::info("Email Notification Queued", [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'item_id' => $item->id,
                'item_title' => $item->titulo,
                'action' => $action,
                'type' => $type
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send email notification: ' . $e->getMessage());
        }
    }
}
