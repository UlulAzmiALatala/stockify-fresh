<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class SettingsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Cek apakah tabel settings ada sebelum melakukan query
        // Ini untuk mencegah error saat menjalankan migrate:fresh
        if (Schema::hasTable('settings')) {
            $settings = Setting::pluck('value', 'key');

            // Mengirim variabel $appName dan $appLogo ke view
            $view->with('appName', $settings['app_name'] ?? 'Stockify');
            $view->with('appLogo', $settings['app_logo'] ?? null);
        } else {
            // Memberikan nilai default jika tabel belum ada
            $view->with('appName', 'Stockify');
            $view->with('appLogo', null);
        }
    }
}
