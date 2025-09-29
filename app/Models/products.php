<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price',
        'sale_price',
        'color',
        'brand_id',
        'product_code',
        'gender',
        'function',
        'stock',
        'description',
        'image',
        'is_active',
    ];
}
