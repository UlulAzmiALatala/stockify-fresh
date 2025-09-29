<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity; // <-- 1. Import Trait
use Spatie\Activitylog\LogOptions;           // <-- 2. Import LogOptions

class Product extends Model
{
    use HasFactory, LogsActivity; // <-- 3. Gunakan Trait

    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'sku',
        'description',
        'purchase_price',
        'selling_price',
        'stock',
        'image',
        'minimum_stock',
        'attributes',
    ];

    /**
     * Konfigurasi log aktivitas untuk model Product.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // Catat perubahan pada kolom-kolom penting ini
            ->logOnly(['name', 'sku', 'purchase_price', 'selling_price', 'stock', 'minimum_stock'])
            ->setDescriptionForEvent(fn(string $eventName) => "Produk ini telah di-{$eventName}")
            ->useLogName('Product');
    }

    protected function casts(): array
    {
        return [
            'attributes' => 'array',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stockTransactions(): HasMany
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')
            ->withPivot('value') // Mengambil kolom 'value' dari tabel pivot
            ->withTimestamps();
    }
}
