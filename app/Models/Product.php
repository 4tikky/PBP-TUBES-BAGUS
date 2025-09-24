<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
        'price',
        'stock',
        'category_id',
    ];

    /**
     * Relasi ke model Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}