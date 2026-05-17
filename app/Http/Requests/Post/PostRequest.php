<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    function prepareForValidation(){
        if(!$this->slug){
            $this->merge([
                'slug' => str($this->title)->slug()
            ]);
        }
        
        return parent::prepareForValidation();
    }
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:500',
            'slug' => 'required|min:5|max:500|unique:posts,slug,' . $this->route('post')?->id,
            'contenido' => 'required|min:7',
            'category_id' => 'required|integer',
            'descripcion' => 'required|min:7',
            'posted' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:10240'
        ];
    }
}