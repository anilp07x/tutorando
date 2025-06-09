<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\PublicacaoController;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\Admin\InstituicaoController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    // Real statistics for the welcome page
    $stats = [
        'total_tutors' => \App\Models\User::where('role', 'tutor')->count(),
        'total_students' => \App\Models\User::where('role', 'tutorando')->count(),
        'total_projects' => \App\Models\Projeto::where('aprovado', true)->count(),
        'total_publications' => \App\Models\Publicacao::where('aprovado', true)->count(),
        
        // Statistics by academic areas (based on course field)
        'tech_tutors' => \App\Models\User::where('role', 'tutor')
            ->where(function($query) {
                $query->where('curso', 'like', '%informática%')
                      ->orWhere('curso', 'like', '%software%')
                      ->orWhere('curso', 'like', '%sistemas%')
                      ->orWhere('curso', 'like', '%tecnologia%')
                      ->orWhere('curso', 'like', '%computação%');
            })->count(),
        'tech_projects' => \App\Models\Projeto::where('aprovado', true)
            ->whereHas('user', function($query) {
                $query->where('curso', 'like', '%informática%')
                      ->orWhere('curso', 'like', '%software%')
                      ->orWhere('curso', 'like', '%sistemas%')
                      ->orWhere('curso', 'like', '%tecnologia%')
                      ->orWhere('curso', 'like', '%computação%');
            })->count(),
            
        'health_tutors' => \App\Models\User::where('role', 'tutor')
            ->where(function($query) {
                $query->where('curso', 'like', '%medicina%')
                      ->orWhere('curso', 'like', '%enfermagem%')
                      ->orWhere('curso', 'like', '%fisioterapia%')
                      ->orWhere('curso', 'like', '%farmácia%')
                      ->orWhere('curso', 'like', '%saúde%');
            })->count(),
        'health_projects' => \App\Models\Projeto::where('aprovado', true)
            ->whereHas('user', function($query) {
                $query->where('curso', 'like', '%medicina%')
                      ->orWhere('curso', 'like', '%enfermagem%')
                      ->orWhere('curso', 'like', '%fisioterapia%')
                      ->orWhere('curso', 'like', '%farmácia%')
                      ->orWhere('curso', 'like', '%saúde%');
            })->count(),
            
        'engineering_tutors' => \App\Models\User::where('role', 'tutor')
            ->where(function($query) {
                $query->where('curso', 'like', '%engenharia%')
                      ->orWhere('curso', 'like', '%civil%')
                      ->orWhere('curso', 'like', '%mecânica%')
                      ->orWhere('curso', 'like', '%elétrica%')
                      ->orWhere('curso', 'like', '%química%');
            })->count(),
        'engineering_projects' => \App\Models\Projeto::where('aprovado', true)
            ->whereHas('user', function($query) {
                $query->where('curso', 'like', '%engenharia%')
                      ->orWhere('curso', 'like', '%civil%')
                      ->orWhere('curso', 'like', '%mecânica%')
                      ->orWhere('curso', 'like', '%elétrica%')
                      ->orWhere('curso', 'like', '%química%');
            })->count(),
            
        'exact_tutors' => \App\Models\User::where('role', 'tutor')
            ->where(function($query) {
                $query->where('curso', 'like', '%matemática%')
                      ->orWhere('curso', 'like', '%física%')
                      ->orWhere('curso', 'like', '%química%')
                      ->orWhere('curso', 'like', '%estatística%')
                      ->orWhere('curso', 'like', '%exatas%');
            })->count(),
        'exact_projects' => \App\Models\Projeto::where('aprovado', true)
            ->whereHas('user', function($query) {
                $query->where('curso', 'like', '%matemática%')
                      ->orWhere('curso', 'like', '%física%')
                      ->orWhere('curso', 'like', '%química%')
                      ->orWhere('curso', 'like', '%estatística%')
                      ->orWhere('curso', 'like', '%exatas%');
            })->count(),
    ];
    
    return view('welcome', compact('stats'));
});

Route::get('/sobre', function () {
    return view('about');
})->name('about');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// Authentication routes (handled by auth.php)
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Search
    Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
    
    // Projects - All users can manage their own projects
    Route::resource('projetos', ProjetoController::class);
    Route::get('/projetos-publicos', [ProjetoController::class, 'all'])->name('projetos.all');
    
    // Publications - Only tutors can create and manage publications
    Route::resource('publicacoes', PublicacaoController::class)->middleware('tutor');
    Route::get('/publicacoes-publicas', [PublicacaoController::class, 'all'])->name('publicacoes.all');
    
    // Tutor browsing - Available for all authenticated users
    Route::get('/tutores', [TutorProfileController::class, 'index'])->name('tutores.index');
    Route::get('/tutores/{tutor}', [TutorProfileController::class, 'show'])->name('tutores.show');
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        // Test Route (remove after testing)
        Route::get('/test', [App\Http\Controllers\Admin\TestController::class, 'index'])->name('test');
        
        // Admin Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // Institutions
        Route::resource('instituicoes', App\Http\Controllers\Admin\InstituicaoController::class);
        
        // Users
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        
        // Projects management
        Route::get('/projetos', [App\Http\Controllers\Admin\ProjetoController::class, 'index'])->name('projetos.index');
        Route::get('/projetos/{projeto}', [App\Http\Controllers\Admin\ProjetoController::class, 'show'])->name('projetos.show');
        Route::patch('/projetos/{projeto}/approve', [App\Http\Controllers\Admin\ProjetoController::class, 'approve'])->name('projetos.approve');
        Route::patch('/projetos/{projeto}/reject', [App\Http\Controllers\Admin\ProjetoController::class, 'reject'])->name('projetos.reject');
        Route::delete('/projetos/{projeto}', [App\Http\Controllers\Admin\ProjetoController::class, 'destroy'])->name('projetos.destroy');
        Route::post('/projetos/bulk-action', [App\Http\Controllers\Admin\ProjetoController::class, 'bulkAction'])->name('projetos.bulk-action');
        
        // Publications management
        Route::get('/publicacoes', [App\Http\Controllers\Admin\PublicacaoController::class, 'index'])->name('publicacoes.index');
        Route::get('/publicacoes/{publicacao}', [App\Http\Controllers\Admin\PublicacaoController::class, 'show'])->name('publicacoes.show');
        Route::patch('/publicacoes/{publicacao}/approve', [App\Http\Controllers\Admin\PublicacaoController::class, 'approve'])->name('publicacoes.approve');
        Route::patch('/publicacoes/{publicacao}/reject', [App\Http\Controllers\Admin\PublicacaoController::class, 'reject'])->name('publicacoes.reject');
        Route::delete('/publicacoes/{publicacao}', [App\Http\Controllers\Admin\PublicacaoController::class, 'destroy'])->name('publicacoes.destroy');
        Route::post('/publicacoes/bulk-action', [App\Http\Controllers\Admin\PublicacaoController::class, 'bulkAction'])->name('publicacoes.bulk-action');
    });
});
