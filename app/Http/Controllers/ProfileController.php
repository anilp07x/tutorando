<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile (view only).
     */
    public function show(Request $request): View
    {
        $user = $request->user();
        
        // Get user statistics
        $stats = [];
        
        if ($user->role === 'tutor' || $user->role === 'tutorando') {
            $stats = [
                'total_projetos' => $user->projetos()->count(),
                'projetos_aprovados' => $user->projetos()->where('aprovado', true)->count(),
                'projetos_pendentes' => $user->projetos()->where('aprovado', false)->count(),
            ];
            
            if ($user->role === 'tutor') {
                $stats['total_publicacoes'] = $user->publicacoes()->count();
                $stats['publicacoes_aprovadas'] = $user->publicacoes()->where('aprovado', true)->count();
                $stats['publicacoes_pendentes'] = $user->publicacoes()->where('aprovado', false)->count();
            }
        }
        
        return view('profile.show', [
            'user' => $user,
            'stats' => $stats,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
