<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        $request->session()->regenerate();

        if ($vocabularyId = $request->session()->pull('intended_favorite')) {
            $user->favorites()->syncWithoutDetaching([$vocabularyId]);

            return redirect()
                ->route('vocabulary.show', $vocabularyId)
                ->with('status', 'Akun dibuat. Kosakata sudah masuk daftar favoritmu.');
        }

        return redirect()->route('catalog')->with('status', 'Selamat datang, '.$user->name.'!');
    }
}
