<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil nama role dari relasi
        $role = $user->role ? $user->role->name : null;

        switch ($role) {
            case 'admin':
                return view('dashboard.admin');
            case 'superadmin':
                return view('dashboard.superadmin');
            case 'pimpinan':
                return view('dashboard.pimpinan');
            default:
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Role tidak dikenali.');
        }
    }

}
