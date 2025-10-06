<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class brands extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
    ];

    public function getBrandNameAttribute()
    {
        return Str::of($this->name)->replace('-', ' ')->title()->value();
    }
}
