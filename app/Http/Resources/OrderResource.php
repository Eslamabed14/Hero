<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray( $request)
    {
        return [
            'id'    => $this -> id,
            'name'  => $this -> name,
            'email' => $this -> email,
            'phone' => $this -> phone,
            'desc ' => $this -> desc,
            'field' => $this -> field,
        ];
    }
}
