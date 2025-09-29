<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity; // <-- 1. Import Trait
use Spatie\Activitylog\LogOptions;           // <-- 2. Import LogOptions

class Category extends Model
{
    use HasFactory, LogsActivity; // <-- 3. Gunakan Trait

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Konfigurasi log aktivitas untuk model Category.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description']) // Catat perubahan pada kolom ini
            ->setDescriptionForEvent(fn(string $eventName) => "Kategori ini telah di-{$eventName}")
            ->useLogName('Category');
    }

    /**
     * Mendefinisikan relasi "one-to-many" ke model Product.
     * Satu Kategori bisa memiliki banyak Produk.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
