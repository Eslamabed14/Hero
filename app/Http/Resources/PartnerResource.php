<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


    public function toArray($request)
    {
        return [
            'id' => $this-> id,
            'name' => $this-> name,
            'image' => asset($this->image) 

        ];
    }
}
