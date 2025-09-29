<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// PERUBAHAN: Gunakan Pivot class agar lebih sesuai
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

// PERUBAHAN: Extends Pivot, bukan Model
class ProductAttribute extends Pivot
{
    use HasFactory, LogsActivity;

    // Menunjukkan bahwa ini bukan auto-incrementing
    public $incrementing = true;

    protected $table = 'product_attributes';

    protected $fillable = [
        'product_id',
        'attribute_id',
        'value' // Jika Anda punya kolom value di pivot
    ];

    /**
     * Konfigurasi log aktivitas untuk model ProductAttribute.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['product_id', 'attribute_id', 'value']) // Catat semua kolom
            // Deskripsi ini akan lebih informatif jika dilihat dari log Product
            ->setDescriptionForEvent(fn(string $eventName) => "Relasi atribut-produk ini telah di-{$eventName}")
            ->useLogName('ProductAttribute');
    }
}
