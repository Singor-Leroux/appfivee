<?php

namespace App\Http\Controllers\Auth\LdapAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class LdapAuthController extends Controller
{
    /**
     * Afficher la vue de connexion
     * 
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Gérer une requête d'authentification
     * 
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password', 'remember');

        if (Auth::guard('ldap')->attempt($credentials, $request->filled('remember'))) {
            $user = User::where('username', $request->username)->first();
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            throw ValidationException::withMessages([
                'username' => __('Authentification échouée'),
            ]);
        }
        // $request->authenticate();
        // // return 'ok';
        // // Régénération pour éviter la fixation des sessions (https://en.wikipedia.org/wiki/Session_fixation)
        // $request->session()->regenerate();

        // // return redirect()->intended(RouteServiceProvider::HOME);
        // return redirect(route('dashboard'));
    }

    /**
     * Détruire la session
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}