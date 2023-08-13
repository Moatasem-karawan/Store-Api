<?php

namespace App\Http\Resources\Offers;

use App\Http\Resources\days_resource;
use App\Http\Resources\files;
use App\Models\Seller\Seller_offers;
use Illuminate\Http\Resources\Json\JsonResource;

class seller_place_offer extends JsonResource
{

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

        $array_of_new_products=[];

        $offers_of_seller_place=Seller_offers::where("state","=","1")->where("seller_place_id",$this->id)->get();
       // $ids_of_offer=[];

        foreach ($offers_of_seller_place as $offer){
            array_push($array_of_new_products,["id_product"=>$offer->product->id,"title"=>$offer->product->title,"last_price"=>$offer->product->price ,"ex_price_of_last_price"=>$offer->product->ex_price,"new_price"=>$offer->new_price_product,"ex_price_of_new_price"=>$offer->ex_price ??"لكل 1 قطعة","ex_description"=>["count_ex"=>$offer->count_ex ?? "1","name_ex"=>$offer->name_ex ?? "قطعة"],"img_product"=>new files($offer->product->img)]);


           // array_push($ids_of_offer,$offer->product_seller_place_id);
        }
        if (count($array_of_new_products)==0){$array_of_new_products="لم يتم اضافة عروض تجارية";}



//        foreach ($this->products_seller->whereNotin("id",$ids_of_offer) as $product){
//            $temp=["id_product"=>$product->id,"title"=>$product->title,"last_price"=>$product->price,"new_price"=>"لايوجد عرض على هذا المنتج","img_product"=>new files($product->img)];
//            array_push($array_of_new_products,$temp);
//        }

        return [
            "id"=>$this->id,
            "title_of_place"=>$this->title_of_place,
            "description_of_place"=>$this->description_of_place,
            "country"=>"Palestine-Gaza",
            "owner"=>$this->seller_man->name,
            "time_work"=>$this->time_work,
            'rating'=>$temp,
            "percent"=>$temp2,
            "is_save"=>$is_saved,
            "delivery_state"=>$delivery_state,
            "products_offers"=>$array_of_new_products,
            "days_work"=>days_resource::collection($this->days),
            "has_code"=>$this->seller_man->category->hashcode,
            "img_place"=>new files($this->img),

        ];
    }
}