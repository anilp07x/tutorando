<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projeto;
use App\Models\AuditLog;
use App\Mail\ProjectStatusNotification;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProjetoController extends Controller
{
    protected $cacheService;
    
    /**
     * Constructor with dependency injection
     */
    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }
    
    public function index(Request $request)
    {
        $query = Projeto::with('user');

        // Filtrar por status se fornecido
        if ($request->has('status')) {
            if ($request->status === 'pendente') {
                $query->where('aprovado', false);
            } elseif ($request->status === 'aprovado') {
                $query->where('aprovado', true);
            }
        }

        // Filtrar por busca
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                  ->orWhere('descricao', 'like', "%{$search}%")
                  ->orWhere('area', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Use query caching for better performance
        $cacheKey = 'admin.projetos.'.md5(json_encode($request->all()));
        $projetos = Cache::remember($cacheKey, 5, function () use ($query) {
            return $query->latest()->paginate(15);
        });

        // Get dashboard stats from cache service
        $stats = $this->cacheService->getDashboardStats();
        
        return view('admin.projetos.index', compact('projetos', 'stats'));
    }

    public function show(Projeto $projeto)
    {
        // Use cached version if available
        $projeto = $this->cacheService->getProjeto($projeto->id);
        return view('admin.projetos.show', compact('projeto'));
    }

    public function approve(Projeto $projeto)
    {
        $projeto->update(['aprovado' => true]);
        
        // Send email notification
        $this->sendNotificationEmail($projeto, 'approve');
        
        // Log audit action
        $this->logAuditAction('approve', 'Projeto', $projeto->id, [
            'old_status' => false,
            'new_status' => true,
            'title' => $projeto->titulo,
            'user_id' => $projeto->user_id
        ]);
        
        // Clear cache
        Cache::forget('projeto-'.$projeto->id);
        Cache::forget('admin-dashboard-stats');

        return redirect()->back()->with('success', 'Projeto aprovado com sucesso!');
    }

    public function reject(Projeto $projeto)
    {
        $projeto->update(['aprovado' => false]);
        
        // Send email notification
        $this->sendNotificationEmail($projeto, 'reject');
        
        // Log audit action
        $this->logAuditAction('reject', 'Projeto', $projeto->id, [
            'old_status' => true,
            'new_status' => false,
            'title' => $projeto->titulo,
            'user_id' => $projeto->user_id
        ]);
        
        // Clear cache
        Cache::forget('projeto-'.$projeto->id);
        Cache::forget('admin-dashboard-stats');

        return redirect()->back()->with('success', 'Projeto rejeitado com sucesso!');
    }

    public function destroy(Projeto $projeto)
    {
        try {
            // Log audit action before deletion
            $this->logAuditAction('delete', 'Projeto', $projeto->id, [
                'title' => $projeto->titulo,
                'user_id' => $projeto->user_id,
                'user_name' => $projeto->user->name
            ]);
            
            $projeto->delete();
            
            // Clear cache
            Cache::forget('admin-dashboard-stats');
            Cache::forget('projeto-'.$projeto->id);
            
            return redirect()->route('admin.projetos.index')
                           ->with('success', 'Projeto excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Erro ao excluir projeto: ' . $e->getMessage());
        }
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'projeto_ids' => 'required|array|min:1',
            'projeto_ids.*' => 'exists:projetos,id'
        ]);

        $action = $request->input('action');
        $projetoIds = $request->input('projeto_ids');
        $projetos = Projeto::whereIn('id', $projetoIds)->with('user')->get();

        $count = 0;
        
        foreach ($projetos as $projeto) {
            $oldStatus = $projeto->aprovado;
            $newStatus = $action === 'approve';
            
            $projeto->update(['aprovado' => $newStatus]);
            
            // Log the action for audit trail
            $this->logAuditAction('bulk_' . $action, 'Projeto', $projeto->id, [
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'title' => $projeto->titulo,
                'author' => $projeto->user->name
            ]);
            
            // Send notification email
            $this->sendNotificationEmail($projeto, $action);
            
            // Clear individual project cache
            Cache::forget('projeto-'.$projeto->id);
            
            $count++;
        }
        
        // Clear relevant caches
        Cache::forget('admin-dashboard-stats');

        $actionText = $action === 'approve' ? 'aprovados' : 'rejeitados';
        return redirect()->back()->with('success', "{$count} projetos {$actionText} com sucesso!");
    }

    private function logAuditAction($action, $model, $modelId, $data = [])
    {
        try {
            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'model' => $model,
                'model_id' => $modelId,
                'data' => json_encode($data),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log audit action: ' . $e->getMessage());
        }
    }

    private function sendNotificationEmail($projeto, $action)
    {
        try {
            Mail::to($projeto->user->email)
                ->queue(new ProjectStatusNotification($projeto->user, $projeto, $action));
                
            Log::info("Email notification queued", [
                'to' => $projeto->user->email,
                'project' => $projeto->titulo,
                'action' => $action
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send email notification: ' . $e->getMessage());
        }
    }
}
