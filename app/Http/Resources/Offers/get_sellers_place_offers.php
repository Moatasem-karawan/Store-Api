<?php

namespace App\Http\Resources\Offers;

use App\Http\Resources\files;
use App\Http\Resources\sller_place\sub_category_of_place;
use Illuminate\Http\Resources\Json\JsonResource;

class get_sellers_place_offers extends JsonResource
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
        $offer=$this->product_offers;
        //$temp=["title_product"=>$offer->product->title,"last_price"=>$offer->product->price,"new_price"=>$offer->new_price_product];
        return [
            "id_place"=>$this->id,
            "title"=>$this->title_of_place,
            "offer_product_count"=>$offer->count(),
            "country"=>"Palestine-Gaza",

            'rating'=>$temp,
            "percent"=>$temp2,
            "is_save"=>$is_saved,

            //'sub_category'=>sub_category_of_place::collection($this->sub_category_seller),
            //"days_work"=>days_resource::collection($this->days),
            "has_code"=>$this->seller_man->category->hashcode,
            "img_place"=>new files($this->img),

        ];
    }
}

