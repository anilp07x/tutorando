<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TutorProfileController extends Controller
{
    /**
     * Display a public tutor profile.
     */
    public function show(User $tutor): View
    {
        // Verificar se o usuário é realmente um tutor
        if ($tutor->role !== 'tutor') {
            abort(404, 'Tutor não encontrado.');
        }
        
        // Buscar apenas projetos e publicações aprovados
        $projetos = $tutor->projetos()
            ->where('aprovado', true)
            ->latest()
            ->paginate(6, ['*'], 'projetos');
            
        $publicacoes = $tutor->publicacoes()
            ->where('aprovado', true)
            ->latest()
            ->paginate(6, ['*'], 'publicacoes');
        
        // Estatísticas do tutor
        $stats = [
            'total_projetos' => $tutor->projetos()->where('aprovado', true)->count(),
            'total_publicacoes' => $tutor->publicacoes()->where('aprovado', true)->count(),
            'membro_desde' => $tutor->created_at,
        ];
          return view('tutores.profile', [
            'tutor' => $tutor,
            'projetos' => $projetos,
            'publicacoes' => $publicacoes,
            'stats' => $stats,
        ]);
    }

    /**
     * List all tutors for browsing.
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $curso = $request->get('curso');
        
        $tutors = User::where('role', 'tutor')
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('curso', 'like', "%{$search}%");
                });
            })
            ->when($curso, function ($query, $curso) {
                return $query->where('curso', 'like', "%{$curso}%");
            })
            ->withCount([
                'projetos as projetos_count' => function($query) {
                    $query->where('aprovado', true);
                },
                'publicacoes as publicacoes_count' => function($query) {
                    $query->where('aprovado', true);
                }
            ])
            ->with('instituicao')
            ->paginate(12);
        
        // Buscar cursos únicos para o filtro
        $cursos = User::where('role', 'tutor')
            ->whereNotNull('curso')
            ->where('curso', '!=', '')
            ->distinct()
            ->pluck('curso')
            ->sort();
              return view('tutores.index', [
            'tutors' => $tutors,
            'cursos' => $cursos,
            'search' => $search,
            'curso' => $curso,
        ]);
    }
}
