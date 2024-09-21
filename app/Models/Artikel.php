<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{

    use HasFactory;

    protected $table = 'articles';
    protected $fillable = ['title', 'content', 'author', 'published_at', 'status', 'banner', 'uploader'];

    protected $casts = [
        'published_at' => 'date',
    ];
}
