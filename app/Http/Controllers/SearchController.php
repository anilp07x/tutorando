<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Publicacao;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query)) {
            return redirect()->back()->with('error', 'Por favor, insira um termo de busca.');
        }
        
        // Search in projects
        $projetos = Projeto::where('titulo', 'LIKE', "%{$query}%")
            ->orWhere('descricao', 'LIKE', "%{$query}%")
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Search in publications
        $publicacoes = Publicacao::where('titulo', 'LIKE', "%{$query}%")
            ->orWhere('descricao', 'LIKE', "%{$query}%")
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Search in users
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('curso', 'LIKE', "%{$query}%")
            ->with('instituicao')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        return view('search.results', compact('query', 'projetos', 'publicacoes', 'users'));
    }
}
