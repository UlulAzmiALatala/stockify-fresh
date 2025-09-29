<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Menampilkan halaman laporan aktivitas pengguna.
     */
    public function index(Request $request)
    {
        $query = Activity::with('causer')->latest(); // Eager load relasi 'causer' (user yang menyebabkan aktivitas)

        // Filter berdasarkan deskripsi aktivitas
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        $activities = $query->paginate(20)->appends($request->query());

        return view('app.pages.admin.reports.activity-log', compact('activities'));
    }
}
