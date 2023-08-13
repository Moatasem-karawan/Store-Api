<?php

namespace App\Http\Resources\Save_by;

use App\Http\Resources\files;
use Illuminate\Http\Resources\Json\JsonResource;

class Save_by_seller_place extends JsonResource
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


        if ($this->seller->delivery_state=="1"){
            $delivery_state="يدعم الدفع عند الاستلام";
        }else{$delivery_state="لا يوفر الدفع عند الاستلام";}
        return [
            "id"=>$this->seller->id,
            "title"=>$this->seller->title_of_place,
            "description"=>$this->seller->description_of_place,
            "country"=>"Palestine-Gaza",
            "delivery_state"=>$delivery_state,
            "files"=>new files($this->seller->img),
            'rating'=>$temp,
            "percent"=>$temp2,
            "is_save"=>1,
            //"owner_by"=>$this->seller_man->name,
            //"time_work"=>$this->time_work,

        ];
    }
}
