<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vegetable extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'likes'];

    protected $casts = [
        'likes' => 'integer',
    ];
}
