<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'advs' => $this->advs,
            'image' => asset($this->image),
            'price' => (float) $this->price,
            'ref1' => $this->ref1,
            'ref2' => $this->ref2,
            'ref3' => $this->ref3,
            'cat_id' => (integer) $this->cat_id,
        ];
    }
}
