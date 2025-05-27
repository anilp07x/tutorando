<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\PublicacaoController;
use App\Http\Controllers\Admin\InstituicaoController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (handled by auth.php)
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
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
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        // Admin Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // Institutions
        Route::resource('instituicoes', InstituicaoController::class);
        
        // Users
        Route::resource('users', UserController::class);
        
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
