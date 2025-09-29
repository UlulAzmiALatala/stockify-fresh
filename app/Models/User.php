<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity; // <-- 1. Import Trait
use Spatie\Activitylog\LogOptions;           // <-- 2. Import LogOptions

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, LogsActivity; // <-- 3. Gunakan Trait

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Konfigurasi log aktivitas untuk model User.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // Catat perubahan pada nama, email, dan juga perubahan peran (roles)
            ->logOnly(['name', 'email'])
            ->logOnlyDirty() // Hanya log jika ada perubahan
            ->setDescriptionForEvent(fn(string $eventName) => "Pengguna ini telah di-{$eventName}")
            ->useLogName('User');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Mendefinisikan relasi "one-to-many" ke model StockTransaction.
     */
    public function stockTransactions(): HasMany
    {
        return $this->hasMany(StockTransaction::class);
    }
}
