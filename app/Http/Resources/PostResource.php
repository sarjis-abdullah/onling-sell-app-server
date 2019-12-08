<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'contact' => $this->contact,
            'address' => $this->address,
            'numberOfBed' => $this->numberOfBed,
            'numberOfBath' => $this->numberOfBath,
            'size' => $this->size,
            'slug' => $this->slug,
            'price' => $this->price,
        ];
    }
}
