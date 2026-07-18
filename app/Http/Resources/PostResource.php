<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            'contenido' => $this->contenido,
            'category_id' => $this->category_id,
            'fecha' => $this->created_at->format('d-m-Y'),
            // Incluye la relación solo si ha sido cargada (Eficiencia)
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
        
        // Cambiar nombres
        // return [
        //     'id' => $this->id,
        //     'titulo_post' => $this->title,
        //     'resumen' => $this->descripcion,
        //     'contenido' => $this->contenido,
        //     'fecha' => $this->created_at->format('d-m-Y'),
        //     // Incluye la relación solo si ha sido cargada (Eficiencia)
        //     'categoria' => new CategoryResource($this->whenLoaded('category')),
        // ];
    }
}
