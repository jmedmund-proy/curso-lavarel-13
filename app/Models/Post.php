<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'descripcion', 'contenido', 'image', 'posted', 'category_id'];

    function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
