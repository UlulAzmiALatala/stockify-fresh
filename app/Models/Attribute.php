<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Attribute extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name', 'type', 'options'];

    /**
     * Memberitahu Laravel bahwa kolom 'options' adalah array.
     * Ini sangat penting agar kita bisa menggunakannya di view.
     */
    protected $casts = [
        'options' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'type', 'options'])
            ->setDescriptionForEvent(fn(string $eventName) => "Atribut ini telah di-{$eventName}")
            ->useLogName('Attribute');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_attributes')
            ->withPivot('value')
            ->withTimestamps();
    }
}
