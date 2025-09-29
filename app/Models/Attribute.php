<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity; // <-- 1. Import Trait
use Spatie\Activitylog\LogOptions;           // <-- 2. Import LogOptions

class Attribute extends Model
{
    use HasFactory, LogsActivity; // <-- 3. Gunakan Trait

    protected $fillable = ['name'];

    /**
     * Konfigurasi log aktivitas untuk model Attribute.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name']) // Hanya catat perubahan pada kolom 'name'
            ->setDescriptionForEvent(fn(string $eventName) => "Atribut ini telah di-{$eventName}")
            ->useLogName('Attribute');
    }

    /**
     * Relasi many-to-many ke model Product.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_attributes')
            ->withPivot('value')
            ->withTimestamps();
    }
}
