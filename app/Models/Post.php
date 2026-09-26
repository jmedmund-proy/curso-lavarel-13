<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

#[Fillable(['title', 'slug', 'descripcion', 'contenido', 'image', 'posted', 'category_id', 'user_id'])]

class Post extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'slug', 'descripcion', 'contenido', 
        // 'image', 'posted', 'category_id', 'user_id'];
    // Incluye categoria como relacion para index si no esta con With en el controlador
    protected $with = ['category'];

    function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    function tags(){
        // return $this->belongsToMany(Tag::class);
        return $this->morphToMany(Tag::class, 'taggable');
    }

    function getImageURL(){
        if($this->image == ''){
            return URL::asset("images/default.jpg");
        }
            return URL::asset("images/post/".$this->image);
    }
}
