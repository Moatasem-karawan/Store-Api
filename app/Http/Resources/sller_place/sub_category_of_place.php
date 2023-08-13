<?php

namespace App\Http\Resources\sller_place;

use Illuminate\Http\Resources\Json\JsonResource;

class sub_category_of_place extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            "id"=>$this->id,
            "title"=>$this->title,
        ];
    }
}
