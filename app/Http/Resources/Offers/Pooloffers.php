<?php

namespace App\Http\Resources\Offers;

use App\Http\Resources\files;
use App\Models\Owner\offer_for_pool as Pooloffers_model;
use Illuminate\Http\Resources\Json\JsonResource;

class Pooloffers extends JsonResource
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

        try{ if (auth()->user()){
            if ($this->is_person_save_this_place){

                $is_saved=1;
            }
            else{$is_saved=0;}
        }
        else{
            $is_saved=0;}}catch (\Exception $E){
            $is_saved=0;

        }
        $array_of_new_last_periods=[];
        $offer_of_place_pool=Pooloffers_model::where("state","=","1")->where("pool_place_id",$this->id)->get();
        $ids_of_offer=[];
        foreach ($offer_of_place_pool as $offer){
            array_push($array_of_new_last_periods,["id_period"=>$offer->period_pivot->id,"title"=>$offer->period_pivot->the_period->title,"last_price"=>$offer->period_pivot->price,"new_price"=>$offer->new_price,]);


            array_push($ids_of_offer,$offer->the_period_pool_id);
        }


        foreach ($this->the_periods->whereNotin("id",$ids_of_offer) as $period){
            $temp=["id_period"=>$period->id,"title"=>$period->title,"last_price"=>$period->pivot->price,"new_price"=>"لايوجد عرض على هذة الفترة"];
            array_push($array_of_new_last_periods,$temp);
        }
        $temp=0;
        $temp2=0;


        if ($this->rating!=null){
            $temp2=$this->rating->rating/$this->rating->number_users;
            $temp=floor($temp2);
        }

        return [
            "title_of_place"=>$this->title,
            "description_of_place"=>$this->description,
            "owner"=>$this->owner->name,
            "country"=>"Palestine-Gaza",
            "periods"=>$array_of_new_last_periods,
            'rating'=>$temp,
            "percent"=>$temp2,
            "is_save"=>$is_saved,
            "files"=>files::collection($this->files),

        ];
    }
}
