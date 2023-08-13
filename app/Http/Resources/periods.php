<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class periods extends JsonResource
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
            "period_id"=>$this->id,
            "title"=>$this->title,
            "time"=>$this->time,
            "price"=>$this->pivot->price,
        ];
    }
}
