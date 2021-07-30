<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Districts extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->dis_name,
            'from' => $this->city_id
        ];
    }
}
