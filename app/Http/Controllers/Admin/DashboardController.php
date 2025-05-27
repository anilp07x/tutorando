<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Projeto;
use App\Models\Publicacao;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_tutors' => User::where('role', 'tutor')->count(),
            'total_students' => User::where('role', 'tutorando')->count(),
            'total_projetos' => Projeto::count(),
            'projetos_aprovados' => Projeto::where('aprovado', true)->count(),
            'projetos_pendentes' => Projeto::where('aprovado', false)->count(),
            'total_publicacoes' => Publicacao::count(),
            'publicacoes_aprovadas' => Publicacao::where('aprovado', true)->count(),
            'publicacoes_pendentes' => Publicacao::where('aprovado', false)->count(),
            'total_instituicoes' => Instituicao::count(),
        ];

        // Dados para gráficos
        $chartData = [
            'users_per_month' => $this->getUsersPerMonth(),
            'projects_per_status' => $this->getProjectsPerStatus(),
            'publications_per_type' => $this->getPublicationsPerType(),
        ];

        return view('admin.dashboard', compact('stats', 'chartData'));
    }

    private function getUsersPerMonth()
    {
        $months = [];
        $counts = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            $counts[] = User::whereYear('created_at', $date->year)
                           ->whereMonth('created_at', $date->month)
                           ->count();
        }

        return [
            'labels' => $months,
            'data' => $counts
        ];
    }

    private function getProjectsPerStatus()
    {
        return [
            'labels' => ['Aprovados', 'Pendentes'],
            'data' => [
                Projeto::where('aprovado', true)->count(),
                Projeto::where('aprovado', false)->count()
            ]
        ];
    }

    private function getPublicationsPerType()
    {
        $types = ['livro', 'artigo', 'video', 'curso', 'outros'];
        $data = [];

        foreach ($types as $type) {
            $data[] = Publicacao::where('tipo', $type)->count();
        }

        return [
            'labels' => array_map('ucfirst', $types),
            'data' => $data
        ];
    }
}
