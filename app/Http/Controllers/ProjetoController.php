<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projetos = Auth::user()->projetos()->latest()->paginate(10);
        return view('projetos.index', compact('projetos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projetos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'youtube_link' => 'nullable|url',
            'imagens.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'arquivo_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $projeto = new Projeto();
        $projeto->titulo = $validated['titulo'];
        $projeto->descricao = $validated['descricao'];
        $projeto->youtube_link = $validated['youtube_link'] ?? null;
        $projeto->user_id = Auth::id();
        $projeto->aprovado = Auth::user()->isAdmin() ? true : false;
        
        // Handle PDF upload
        if ($request->hasFile('arquivo_pdf')) {
            $pdfPath = $request->file('arquivo_pdf')->store('projetos/pdfs', 'public');
            $projeto->arquivo_pdf = $pdfPath;
        }
        
        // Handle multiple images
        if ($request->hasFile('imagens')) {
            $imagePaths = [];
            foreach ($request->file('imagens') as $image) {
                $imagePath = $image->store('projetos/imagens', 'public');
                $imagePaths[] = $imagePath;
            }
            $projeto->imagens = $imagePaths;
        }
        
        $projeto->save();
        
        return redirect()->route('projetos.show', $projeto)
            ->with('success', 'Projeto criado com sucesso! ' . 
                  (Auth::user()->isAdmin() ? '' : 'Aguardando aprovação do administrador.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Projeto $projeto)
    {
        // Ensure user can only see their own projects or approved projects
        if ($projeto->user_id !== Auth::id() && !$projeto->aprovado && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('projetos.show', compact('projeto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projeto $projeto)
    {
        // Ensure user can only edit their own projects
        if ($projeto->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('projetos.edit', compact('projeto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projeto $projeto)
    {
        // Ensure user can only update their own projects
        if ($projeto->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'youtube_link' => 'nullable|url',
            'imagens.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'arquivo_pdf' => 'nullable|mimes:pdf|max:10240',
            'remove_images' => 'nullable|array',
            'remove_pdf' => 'nullable|boolean',
        ]);
        
        $projeto->titulo = $validated['titulo'];
        $projeto->descricao = $validated['descricao'];
        $projeto->youtube_link = $validated['youtube_link'] ?? null;
        
        // Reset approval status if non-admin updates
        if (!Auth::user()->isAdmin()) {
            $projeto->aprovado = false;
        }
        
        // Handle PDF removal
        if (isset($validated['remove_pdf']) && $validated['remove_pdf'] && $projeto->arquivo_pdf) {
            Storage::disk('public')->delete($projeto->arquivo_pdf);
            $projeto->arquivo_pdf = null;
        }
        
        // Handle PDF upload
        if ($request->hasFile('arquivo_pdf')) {
            // Delete old PDF if exists
            if ($projeto->arquivo_pdf) {
                Storage::disk('public')->delete($projeto->arquivo_pdf);
            }
            
            $pdfPath = $request->file('arquivo_pdf')->store('projetos/pdfs', 'public');
            $projeto->arquivo_pdf = $pdfPath;
        }
        
        // Handle image removal
        if (isset($validated['remove_images']) && is_array($validated['remove_images'])) {
            $currentImages = $projeto->imagens ?? [];
            $newImages = [];
            
            foreach ($currentImages as $index => $image) {
                if (!in_array($index, $validated['remove_images'])) {
                    $newImages[] = $image;
                } else {
                    Storage::disk('public')->delete($image);
                }
            }
            
            $projeto->imagens = $newImages;
        }
        
        // Handle multiple images
        if ($request->hasFile('imagens')) {
            $currentImages = $projeto->imagens ?? [];
            
            foreach ($request->file('imagens') as $image) {
                $imagePath = $image->store('projetos/imagens', 'public');
                $currentImages[] = $imagePath;
            }
            
            $projeto->imagens = $currentImages;
        }
        
        $projeto->save();
        
        return redirect()->route('projetos.show', $projeto)
            ->with('success', 'Projeto atualizado com sucesso! ' . 
                  (Auth::user()->isAdmin() ? '' : 'Aguardando aprovação do administrador.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projeto $projeto)
    {
        // Ensure user can only delete their own projects
        if ($projeto->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Delete associated files
        if ($projeto->arquivo_pdf) {
            Storage::disk('public')->delete($projeto->arquivo_pdf);
        }
        
        if ($projeto->imagens) {
            foreach ($projeto->imagens as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $projeto->delete();
        
        return redirect()->route('projetos.index')
            ->with('success', 'Projeto excluído com sucesso!');
    }
    
    /**
     * Display a listing of all approved projects.
     */
    public function all()
    {
        $projetos = Projeto::where('aprovado', true)->latest()->paginate(12);
        return view('projetos.public', compact('projetos'));
    }
    
    /**
     * Display a listing of all projects for admin approval.
     */
    public function adminIndex()
    {
        $projetos = Projeto::with('user')->latest()->paginate(15);
        return view('admin.projetos.index', compact('projetos'));
    }
    
    /**
     * Approve or disapprove a project.
     */
    public function approve(Request $request, Projeto $projeto)
    {
        $validated = $request->validate([
            'approved' => 'required|boolean',
        ]);
        
        $projeto->aprovado = $validated['approved'];
        $projeto->save();
        
        return redirect()->back()
            ->with('success', 'Status do projeto atualizado com sucesso!');
    }
}
