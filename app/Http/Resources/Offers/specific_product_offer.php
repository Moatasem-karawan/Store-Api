<?php

namespace App\Http\Resources\Offers;

use App\Http\Resources\files;
use App\Models\Seller\Seller_offers;
use Illuminate\Http\Resources\Json\JsonResource;

class specific_product_offer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        $array_of_new_products=[];

        $offers_of_seller_place=Seller_offers::where("state","=","1")->where("seller_place_id",$this->id)->get();
        // $ids_of_offer=[];

        foreach ($offers_of_seller_place as $offer){
            array_push($array_of_new_products,["id_product"=>$offer->product->id,"title"=>$offer->product->title,"last_price"=>$offer->product->price,"new_price"=>$offer->new_price_product, "ex_price"=>$this->ex_price??"لكل قطعة","img_product"=>new files($offer->product->img)]);


            // array_push($ids_of_offer,$offer->product_seller_place_id);
        }
        if (count($array_of_new_products)==0){$array_of_new_products="لم يتم اضافة عروض تجارية";}



//        foreach ($this->products_seller->whereNotin("id",$ids_of_offer) as $product){
//            $temp=["id_product"=>$product->id,"title"=>$product->title,"last_price"=>$product->price,"new_price"=>"لايوجد عرض على هذا المنتج","img_product"=>new files($product->img)];
//            array_push($array_of_new_products,$temp);
//        }

        return [
           // "title_of_place"=>$this->title_of_place,
            //"description_of_place"=>$this->description_of_place,
            //"country"=>"Palestine-Gaza",
            //"owner"=>$this->seller_man->name,
            "products_offers"=>$array_of_new_products,
            //"img_place"=>new files($this->img),

        ];
    }
}
