<?php

namespace App\Http\Resources\Offers;

use App\Http\Resources\files;
use App\Models\Owner\offer_for_pool as Pooloffers_model;
use Illuminate\Http\Resources\Json\JsonResource;

class get_pool_place_of_offers extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $is_saved=0;

        try{
            if (auth()->user()){
            if ($this->is_person_save_this_place){

                $is_saved=1;
            }
            else{$is_saved=0;}
        }
        else{
            $is_saved=0;}}catch (\Exception $E){
            $is_saved=0;

        }
        $temp1=0;
        $temp2=0;


        if ($this->rating!=null){
            $temp2=$this->rating->rating/$this->rating->number_users;
            $temp1=floor($temp2);
        }
        $offer=$this->offer_periods->first();
        $temp=["title"=>$offer->period_pivot->the_period->title,"last_price"=>$offer->period_pivot->price,"new_price"=>$offer->new_price];

        $array_of_new_last_periods=[];
        return [
            "id_pool_place"=>$this->id,
            "title"=>$this->title,
            "country"=>"Palestine-Gaza",
            "offer"=>$temp,
            "hash_code"=>$this->owner->category->hashcode,
            //"last_price"=>$this->period_pivot->price,
            //"new_price"=>$this->new_price,
            "is_save"=>$is_saved,
            'rating'=>$temp1,
            "percent"=>$temp2,
            "files"=>files::collection($this->files),
        ];
    }
}
