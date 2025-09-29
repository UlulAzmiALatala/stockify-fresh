<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity; // <-- 1. Import Trait
use Spatie\Activitylog\LogOptions;           // <-- 2. Import LogOptions

class StockTransaction extends Model
{
    use HasFactory, LogsActivity; // <-- 3. Gunakan Trait

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'date',
        'status',
        'notes',
        'supplier_id', // Pastikan ini ada jika Anda menambahkannya
    ];

    /**
     * Konfigurasi log aktivitas untuk model StockTransaction.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // Hanya catat event 'created' (saat manajer membuat) dan 'updated' (saat staf konfirmasi)
            ->logOnly(['status'])
            // Hanya log jika kolom 'status' berubah (misal dari 'Selesai' ke 'Diterima')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Transaksi ini telah di-{$eventName}")
            ->useLogName('StockTransaction');
    }

    /**
     * Mendefinisikan relasi "many-to-one" ke model Product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Mendefinisikan relasi "many-to-one" ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan relasi "many-to-one" ke model Supplier.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
