<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [

            'views' =>(double) $this->views,
            'projects' =>(double) $this->projects,
            'customers' =>(double) $this->customers,
            'empolyees' =>(double) $this->employees,
            'email' => $this->email,
            'number' => $this->number,
        ];
    }
}
