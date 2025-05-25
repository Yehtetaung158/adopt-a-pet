<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    public function breeds()
    {
        return $this->hasMany(Breed::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
