<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttribute extends Pivot
{
    // Tidak perlu $incrementing = true lagi
    // Tidak perlu trait HasFactory atau LogsActivity di sini untuk menyederhanakan

    public $timestamps = true; // Pastikan created_at & updated_at di-handle

    protected $table = 'product_attributes';

    protected $fillable = [
        'product_id',
        'attribute_id',
        'value'
    ];
}
