<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\App;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = User::find(Auth::user()->id);
        
        //get apps acceessibility for current user
        $user_apps = $user->apps->unique('slug')->select('id','name')->values();

        $request->session()->regenerate();
        
        if($user_apps->count() > 1 || $user_apps->count() == 0 ){

            return redirect()->intended(route('dashboard', absolute: false)); //diarahkan ke halaman etalase aplikasi
        }else{
            $data = $user_apps->first();
            $user_apps = $user?->apps->unique('slug')
            ->select('id','route_name')
            ->where('id', $data['id'])
            ->first();

            return redirect()->intended(route($user_apps['route_name'], ['app_id'=>$user_apps['id']])); //diarahkan ke dashboard aplikasi
            
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
