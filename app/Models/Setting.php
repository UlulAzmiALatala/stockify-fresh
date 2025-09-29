<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity; // <-- 1. Import Trait
use Spatie\Activitylog\LogOptions;           // <-- 2. Import LogOptions

class Setting extends Model
{
    use HasFactory, LogsActivity; // <-- 3. Gunakan Trait

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Konfigurasi log aktivitas untuk model Setting.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['value']) // Hanya catat perubahan pada kolom 'value'
            ->setDescriptionForEvent(fn(string $eventName) => "Pengaturan '{$this->key}' telah di-{$eventName}")
            ->useLogName('Setting');
    }
}
