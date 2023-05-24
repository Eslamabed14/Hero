<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'name' => $this->name,
            'image' =>asset($this->image),
            'job' => $this->job,
            'linkedin' => $this->linkedin,
            'facebbok' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
       ];
    }
}
