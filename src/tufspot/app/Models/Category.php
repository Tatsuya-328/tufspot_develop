<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'name', 'description'
    ];

    const NAME = [
        'Academia' => 1,
        'Business' => 2,
        'Culture' => 3,
    ];
}
