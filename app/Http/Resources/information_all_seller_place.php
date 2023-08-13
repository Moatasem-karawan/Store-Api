<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class information_all_seller_place extends JsonResource
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
        $temp=0;
        $temp2=0;


        if ($this->rating!=null){
            $temp2=$this->rating->rating/$this->rating->number_users;
            $temp=floor($temp2);
        }


        if ($this->delivery_state=="1"){
            $delivery_state="يقبل الدفع عند الاستلام";
        }else{$delivery_state="لا يقبل الدفع عند الاستلام";}
        return [
            "id"=>$this->id,
            "title"=>$this->title_of_place,
            "description"=>$this->description_of_place,
            "country"=>"Palestine-Gaza",
            "delivery_state"=>$delivery_state,
            'rating'=>$temp,
            "percent"=>$temp2,
            "is_save"=>$is_saved,
            "region"=>$this->region->region,
            "area"=>$this->area->area,
           // "hashcode"=>$this->category_seller->hashcode,
            "files"=>new files($this->img),
            //"owner_by"=>$this->seller_man->name,

            //"time_work"=>$this->time_work,

        ];
    }
}
