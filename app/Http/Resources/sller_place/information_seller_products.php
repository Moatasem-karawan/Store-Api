<?php

namespace App\Http\Resources\sller_place;

use App\Http\Resources\files;
use Illuminate\Http\Resources\Json\JsonResource;

class information_seller_products extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id_product"=>$this->id,
            "title"=>$this->title,
            "description"=>$this->description,
            "price"=>$this->price,
            "ex_price"=>$this->ex_price??"لكل 1 قطعة",
            "ex_description"=>["count_ex"=>$this->count_ex ?? "1","name_ex"=>$this->name_ex ?? "قطعة"],
            "img"=>new files($this->img),
        ];
    }
}
