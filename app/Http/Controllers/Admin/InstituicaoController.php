<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instituicoes = Instituicao::latest()->paginate(10);
        return view('admin.instituicoes.index', compact('instituicoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.instituicoes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:técnico,médio,superior',
            'localizacao' => 'required|string|max:255',
        ]);

        Instituicao::create($request->all());

        return redirect()->route('admin.instituicoes.index')
            ->with('success', 'Instituição criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instituicao $instituicao)
    {
        return view('admin.instituicoes.show', compact('instituicao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instituicao $instituicao)
    {
        return view('admin.instituicoes.edit', compact('instituicao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instituicao $instituicao)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:técnico,médio,superior',
            'localizacao' => 'required|string|max:255',
        ]);

        $instituicao->update($request->all());

        return redirect()->route('admin.instituicoes.index')
            ->with('success', 'Instituição atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instituicao $instituicao)
    {
        // Check if the institution has users
        if ($instituicao->users()->count() > 0) {
            return redirect()->route('admin.instituicoes.index')
                ->with('error', 'Não é possível excluir esta instituição porque existem usuários associados a ela.');
        }

        $instituicao->delete();

        return redirect()->route('admin.instituicoes.index')
            ->with('success', 'Instituição excluída com sucesso!');
    }
}
