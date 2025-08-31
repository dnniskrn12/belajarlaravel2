<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        $user = auth()->user();

        if ($user->role_id == 1) { // admin
            return route('admin.dashboard');
        } elseif ($user->role_id == 2) { // superadmin
            return route('superadmin.dashboard');
        } elseif ($user->role_id == 3) { // pimpinan
            return route('pimpinan.dashboard');
        }

        return route('home');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_blocked) {
            Auth::logout();
            return redirect('/login')->withErrors(['email' => 'Akun Anda diblokir.']);
        }
    }
    protected function username()
    {
        return 'username';
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
