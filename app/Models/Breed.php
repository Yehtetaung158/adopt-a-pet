<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    /** @use HasFactory<\Database\Factories\BreedFactory> */
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function pets()
    {
        return $this->hasManyThrough(Pet::class, Category::class);
    }
}
