<?php

namespace App\Http\Resources\sller_place;

use App\Http\Resources\days_resource;
use App\Http\Resources\files;
use Illuminate\Http\Resources\Json\JsonResource;

class information_seller_place extends JsonResource
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
            "owner_by"=>$this->seller_man->name,
            "delivery_state"=>$delivery_state,
            "time_work"=>$this->time_work,
            'rating'=>$temp,
            "percent"=>$temp2,
            "is_save"=>$is_saved,
            "img_place"=>new files($this->img),
            "region"=>$this->region->region ?? "Error",
            "area"=>$this->area->area ?? "Error",
            'sub_category'=>sub_category_of_place::collection($this->sub_category_seller),
            "days_work"=>days_resource::collection($this->days),
          //  "all_products"=>information_seller_products::collection($this->products_seller->where("state","=","1")),
        ];
    }
}
