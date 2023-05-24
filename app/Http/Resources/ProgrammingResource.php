<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ProgrammingResource extends JsonResource
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
            'image' => asset($this->image),
            'price' => (float) $this->id,
            'ref1' => $this->ref1,
            'ref2' => $this->ref2,
            'ref3' => $this->ref3,
            'pages' => (float) $this->pages,
            'downloads' => (float) $this->downloads,
            'customers' => (float) $this->customers,
            'country' => (float) $this->country,
            'b_head' =>  $this->b_head,
            'b_body' =>  $this->b_body,
            'b_image' =>  asset($this->b_image),
            'c_name' =>  $this->c_name,
            'c_opinion' =>  $this->c_opinion,
            'c_logo' =>  asset($this->c_logo),
            'cat_id' => (integer) $this->cat_id  ,
        ];
    }
}
