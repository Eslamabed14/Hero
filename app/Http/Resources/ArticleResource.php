<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            
            'id'     => $this-> id,

            'title'  => $this-> title,

            'image'  => asset( $this-> id ),

            'desc'   => $this-> desc,

            'banner' => asset( $this-> id ),
        ];
    }
}
