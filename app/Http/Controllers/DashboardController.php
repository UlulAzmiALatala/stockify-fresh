<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard berdasarkan peran pengguna yang login.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return view('app.pages.admin.dashboard');
        }

        if ($user->hasRole('manager')) {
            return view('app.pages.manager.dashboard');
        }

        if ($user->hasRole('staff')) {
            return view('app.pages.staff.dashboard');
        }

        // Jika tidak memiliki peran yang sesuai, kembalikan ke halaman default atau login
        return redirect()->route('login');
    }
}