<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    function prepareForValidation(){
        if(!$this->slug){
            $this->merge([
                'slug' => str($this->title)->slug()
            ]);
        }
        
        return parent::prepareForValidation();
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas comunes para Categorías.
     * El slug ignora el ID actual si existe (operador ?->).
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:500',
            'slug' => 'required|min:5|max:500|unique:categories,slug,' . $this->route('category')?->id,
        ];
    }
}