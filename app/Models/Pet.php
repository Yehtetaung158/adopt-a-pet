<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    /** @use HasFactory<\Database\Factories\PetFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'breed',
        'birth_date',
        'description',
        'status',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'pet_id', 'user_id')
            ->withTimestamps();
    }

    public function isFavBy(User $user)
    {
        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }
}
