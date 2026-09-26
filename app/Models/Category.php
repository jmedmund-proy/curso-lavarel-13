<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug'])]

class Category extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'slug'];
    // Clase Mutadores y accesores
    // Como se muestran los datos
    // function getTitleAttribute(?string $value): string {
    //     // return strtolower($value);
    //     // return strtoupper($this->attributes['title']);
    //     return ucfirst($value);
    // }
    // Como se insertan los datos
    // function setTitleAttribute(?string $value): void {
    //     $this->attributes['title'] = strtoupper($value);
    // }

    // Forma avanzada
    protected function title(): Attribute {
        return Attribute::make(
            get: fn (?string $value) => strtolower($value),
            set: fn (?string $value) => strtoupper($value),
        );
    }


    function posts() {
        return $this->hasMany(Post::class);
    }
}
