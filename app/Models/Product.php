<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        // 'title',
        // 'category',
        // 'price',
        'created_at',
        'user',
        'no_hp',
        'bidang_system',
        'kategori',
        'sub_kategori',
        'menu',
        'problem',
        'result',
        'prioritas',
        'status',
        //'handle_by',
        'image',
    ];
}
