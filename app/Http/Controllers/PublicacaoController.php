<?php

namespace App\Http\Controllers;

use App\Models\Publicacao;
use App\Services\FileValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;

class PublicacaoController extends Controller
{
    protected $fileService;
    
    /**
     * Constructor
     */
    public function __construct(FileValidationService $fileService)
    {
        $this->fileService = $fileService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicacoes = Auth::user()->publicacoes()->latest()->paginate(10);
        return view('publicacoes.index', compact('publicacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only tutors can create publications
        if (!Auth::user()->isTutor() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action. Only tutors can create publications.');
        }
        
        return view('publicacoes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only tutors can create publications
        if (!Auth::user()->isTutor() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action. Only tutors can create publications.');
        }
        
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo' => 'required|in:livro,artigo,video,curso,sebenta',
            'area' => 'nullable|string|max:255',
            'resumo' => 'nullable|string|max:1000',
            'conteudo_file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,mp4,avi,mov|max:51200', // 50MB max
            'conteudo_url' => 'nullable|url',
        ], [
            'conteudo_file.max' => 'O arquivo não pode ser maior que 50MB.',
            'conteudo_file.mimes' => 'Apenas arquivos PDF, DOC, DOCX, PPT, PPTX, ZIP, MP4, AVI, MOV são permitidos.',
            'conteudo_url.url' => 'Por favor, forneça uma URL válida.',
        ]);
        
        $publicacao = new Publicacao();
        $publicacao->titulo = $validated['titulo'];
        $publicacao->descricao = $validated['descricao'];
        $publicacao->tipo = $validated['tipo'];
        $publicacao->user_id = Auth::id();
        $publicacao->aprovado = Auth::user()->isAdmin() ? true : false;
        
        // Set optional fields
        if (!empty($validated['area'])) {
            $publicacao->area = $validated['area'];
        }
        if (!empty($validated['resumo'])) {
            $publicacao->resumo = $validated['resumo'];
        }
        
        // Handle file upload or URL with enhanced security
        if ($request->hasFile('conteudo_file')) {
            $file = $request->file('conteudo_file');
            
            // Validate and store file using the service
            $this->fileService->validate($file);
            $fileInfo = $this->fileService->storeSecurely($file, $validated['tipo']);
            
            $publicacao->conteudo_url = $fileInfo['path'];
            $publicacao->file_size = $fileInfo['size'];
            $publicacao->file_type = $fileInfo['type'];
            $publicacao->original_filename = $fileInfo['original_name'];
        } elseif (!empty($validated['conteudo_url'])) {
            $publicacao->conteudo_url = $validated['conteudo_url'];
        }
        
        $publicacao->save();
        
        return redirect()->route('publicacoes.show', $publicacao)
            ->with('success', 'Publicação criada com sucesso! ' . 
                  (Auth::user()->isAdmin() ? '' : 'Aguardando aprovação do administrador.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Publicacao $publicacao)
    {
        // Ensure user can only see their own publications or approved publications
        if ($publicacao->user_id !== Auth::id() && !$publicacao->aprovado && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('publicacoes.show', compact('publicacao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publicacao $publicacao)
    {
        // Ensure user can only edit their own publications
        if ($publicacao->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('publicacoes.edit', compact('publicacao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publicacao $publicacao)
    {
        // Ensure user can only update their own publications
        if ($publicacao->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo' => 'required|in:livro,artigo,video,curso,sebenta',
            'area' => 'nullable|string|max:255',
            'resumo' => 'nullable|string|max:1000',
            'conteudo_file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,mp4,avi,mov|max:51200', // 50MB max
            'conteudo_url' => 'nullable|url',
            'remove_file' => 'nullable|boolean',
        ], [
            'conteudo_file.max' => 'O arquivo não pode ser maior que 50MB.',
            'conteudo_file.mimes' => 'Apenas arquivos PDF, DOC, DOCX, PPT, PPTX, ZIP, MP4, AVI, MOV são permitidos.',
            'conteudo_url.url' => 'Por favor, forneça uma URL válida.',
        ]);
        
        $publicacao->titulo = $validated['titulo'];
        $publicacao->descricao = $validated['descricao'];
        $publicacao->tipo = $validated['tipo'];
        
        // Update optional fields
        $publicacao->area = $validated['area'] ?? null;
        $publicacao->resumo = $validated['resumo'] ?? null;
        
        // Reset approval status if non-admin updates
        if (!Auth::user()->isAdmin()) {
            $publicacao->aprovado = false;
        }
        
        // Handle file removal
        if (isset($validated['remove_file']) && $validated['remove_file']) {
            $this->fileService->deleteFile($publicacao->conteudo_url);
            $publicacao->conteudo_url = null;
            $publicacao->file_size = null;
            $publicacao->file_type = null;
            $publicacao->original_filename = null;
        }
        
        // Handle file upload or URL with enhanced security
        if ($request->hasFile('conteudo_file')) {
            $file = $request->file('conteudo_file');
            
            // Validate and store file using the service
            $this->fileService->validate($file);
            
            // Delete old file if exists
            $this->fileService->deleteFile($publicacao->conteudo_url);
            
            // Store new file
            $fileInfo = $this->fileService->storeSecurely($file, $validated['tipo']);
            
            $publicacao->conteudo_url = $fileInfo['path'];
            $publicacao->file_size = $fileInfo['size'];
            $publicacao->file_type = $fileInfo['type'];
            $publicacao->original_filename = $fileInfo['original_name'];
        } elseif (!empty($validated['conteudo_url'])) {
            // Only update URL if provided
            $publicacao->conteudo_url = $validated['conteudo_url'];
            $publicacao->file_size = null;
            $publicacao->file_type = null;
        }
        
        $publicacao->save();
        
        return redirect()->route('publicacoes.show', $publicacao)
            ->with('success', 'Publicação atualizada com sucesso! ' . 
                  (Auth::user()->isAdmin() ? '' : 'Aguardando aprovação do administrador.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publicacao $publicacao)
    {
        // Ensure user can only delete their own publications
        if ($publicacao->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Delete associated file if stored locally
        $this->fileService->deleteFile($publicacao->conteudo_url);
        
        $publicacao->delete();
        
        return redirect()->route('publicacoes.index')
            ->with('success', 'Publicação excluída com sucesso!');
    }
    
    /**
     * Display a listing of all approved publications.
     */
    public function all()
    {
        // Use caching to improve performance
        $publicacoes = Cache::remember('public-publicacoes', 60 * 15, function () {
            return Publicacao::where('aprovado', true)->latest()->paginate(12);
        });
        
        return view('publicacoes.public', compact('publicacoes'));
    }
    
    /**
     * Display a listing of all publications for admin approval.
     */
    public function adminIndex()
    {
        $publicacoes = Publicacao::with('user')->latest()->paginate(15);
        return view('admin.publicacoes.index', compact('publicacoes'));
    }
    
    /**
     * Approve or disapprove a publication.
     */
    public function approve(Request $request, Publicacao $publicacao)
    {
        $validated = $request->validate([
            'approved' => 'required|boolean',
        ]);
        
        $publicacao->aprovado = $validated['approved'];
        $publicacao->save();
        
        return redirect()->back()
            ->with('success', 'Status da publicação atualizado com sucesso!');
    }
}
