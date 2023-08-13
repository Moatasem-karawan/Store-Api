<?php

namespace App\Http\Resources\Save_by;

use App\Http\Resources\files;
use Illuminate\Http\Resources\Json\JsonResource;

class Save_by_pool_place extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        $temp=0;
        $temp2=0;


        if ($this->rating!=null){
            $temp2=$this->rating->rating/$this->rating->number_users;
            $temp=floor($temp2);
        }
        return [
            "id"=>$this->pool->id,
            "title"=>$this->pool->title,
            "description"=>$this->pool->description,
            "country"=>"Palestine-Gaza",
            'rating'=>$temp,
            "percent"=>$temp2,
            "owner_by"=>$this->pool->owner->name,
            "is_save"=>1,

            "files"=>files::collection($this->pool->files),
        ];
    }
}
