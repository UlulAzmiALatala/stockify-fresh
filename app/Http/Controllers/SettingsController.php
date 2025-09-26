<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting; // Kita akan buat model ini nanti
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Menampilkan halaman form pengaturan.
     */
    public function index()
    {
        // Mengambil semua settings dan mengubahnya menjadi array asosiatif
        $settings = Setting::pluck('value', 'key');
        return view('app.pages.admin.settings.index', compact('settings'));
    }

    /**
     * Memperbarui data pengaturan.
     */
    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:1024', // Logo maks 1MB
        ]);

        // Update nama aplikasi
        Setting::updateOrCreate(
            ['key' => 'app_name'],
            ['value' => $request->app_name]
        );

        // Handle upload logo baru
        if ($request->hasFile('app_logo')) {
            $setting = Setting::firstWhere('key', 'app_logo');

            // Hapus logo lama jika ada
            if ($setting && $setting->value) {
                Storage::delete('public/' . $setting->value);
            }

            // Simpan logo baru
            $path = $request->file('app_logo')->store('logos', 'public');

            Setting::updateOrCreate(
                ['key' => 'app_logo'],
                ['value' => $path]
            );
        }

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
