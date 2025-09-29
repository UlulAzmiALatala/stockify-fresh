<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity; // <-- 1. Import Trait
use Spatie\Activitylog\LogOptions;           // <-- 2. Import LogOptions

class Supplier extends Model
{
    use HasFactory, LogsActivity; // <-- 3. Gunakan Trait

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    /**
     * Konfigurasi log aktivitas untuk model Supplier.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // Catat perubahan pada semua kolom yang bisa diisi
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) => "Supplier ini telah di-{$eventName}")
            ->useLogName('Supplier');
    }

    /**
     * Mendefinisikan relasi "one-to-many" ke model Product.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
