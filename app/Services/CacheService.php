<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\Publicacao;
use App\Models\Projeto;
use App\Models\User;
use App\Models\Instituicao;

class CacheService
{
    /**
     * Cache duration in minutes
     */
    const CACHE_DURATION = 60; // 1 hour
    
    /**
     * Get dashboard statistics with caching
     *
     * @return array
     */
    public function getDashboardStats()
    {
        return Cache::remember('admin-dashboard-stats', self::CACHE_DURATION, function () {
            return [
                'users' => [
                    'total' => User::count(),
                    'admin' => User::where('role', 'admin')->count(),
                    'tutor' => User::where('role', 'tutor')->count(),
                    'aluno' => User::where('role', 'aluno')->count(),
                ],
                'publicacoes' => [
                    'total' => Publicacao::count(),
                    'aprovadas' => Publicacao::where('aprovado', true)->count(),
                    'pendentes' => Publicacao::where('aprovado', false)->count(),
                ],
                'projetos' => [
                    'total' => Projeto::count(),
                    'aprovados' => Projeto::where('aprovado', true)->count(),
                    'pendentes' => Projeto::where('aprovado', false)->count(),
                ],
                'instituicoes' => [
                    'total' => Instituicao::count(),
                    'tecnico' => Instituicao::where('tipo', 'tecnico')->count(),
                    'medio' => Instituicao::where('tipo', 'medio')->count(),
                    'superior' => Instituicao::where('tipo', 'superior')->count(),
                ],
            ];
        });
    }
    
    /**
     * Get cached publication by ID
     *
     * @param int $id
     * @return Publicacao|null
     */
    public function getPublicacao($id)
    {
        return Cache::remember('publicacao-'.$id, self::CACHE_DURATION, function () use ($id) {
            return Publicacao::with('user')->find($id);
        });
    }
    
    /**
     * Get cached project by ID
     *
     * @param int $id
     * @return Projeto|null
     */
    public function getProjeto($id)
    {
        return Cache::remember('projeto-'.$id, self::CACHE_DURATION, function () use ($id) {
            return Projeto::with('user')->find($id);
        });
    }
    
    /**
     * Get public publications with caching
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPublicPublicacoes($perPage = 12)
    {
        $page = request()->get('page', 1);
        $cacheKey = 'public-publicacoes-page-'.$page.'-'.$perPage;
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($perPage) {
            return Publicacao::where('aprovado', true)->latest()->paginate($perPage);
        });
    }
    
    /**
     * Get public projects with caching
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPublicProjetos($perPage = 12)
    {
        $page = request()->get('page', 1);
        $cacheKey = 'public-projetos-page-'.$page.'-'.$perPage;
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($perPage) {
            return Projeto::where('aprovado', true)->latest()->paginate($perPage);
        });
    }
    
    /**
     * Clear all application caches
     */
    public function clearAllCaches()
    {
        Cache::flush();
    }
}
