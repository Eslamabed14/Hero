<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MotionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray( $request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->when($this->image , asset($this->image)),
            'desc' => $this->desc,
            'link' => $this->link,
            'cat_id' => (integer) $this->cat_id
        ];
    }
}
