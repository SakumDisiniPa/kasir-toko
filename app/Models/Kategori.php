<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
    ];
}
