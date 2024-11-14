<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_admin extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
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
        'image',
    ];
}
