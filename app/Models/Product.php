<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\ProductAttribute;

class Product extends Model
{
    use HasFactory, LogsActivity;

    /**
     * PERBAIKAN: Kolom 'attributes' yang konflik dihapus dari $fillable.
     */
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
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'sku', 'purchase_price', 'selling_price', 'stock', 'minimum_stock'])
            ->setDescriptionForEvent(fn(string $eventName) => "Produk ini telah di-{$eventName}")
            ->useLogName('Product');
    }

    /**
     * PERBAIKAN: Fungsi casts() yang lama dihapus untuk menghindari konflik.
     * Cast untuk password dan email_verified_at sudah ada di model User, tidak diperlukan di sini.
     */
    // protected function casts(): array ... (Fungsi ini dihapus)


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

    /**
     * Relasi 'attributes' sekarang akan berfungsi dengan benar.
     */
    public function productAttributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')
            ->withPivot('value')
            ->withTimestamps();
    }
}
