<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;


class Recipe extends Model
{
    use HasFactory, Favoriteable;



    function  category()
    {
        return $this->belongsTo(Category::class);
    }


    function isFavoritedByUser()
    {
        if (auth()->check()) {
            return  auth()->user()->hasFavorited($this);
        } else {
            return false;
        }
    }
}
