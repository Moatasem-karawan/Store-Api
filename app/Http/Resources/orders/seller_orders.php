<?php

namespace App\Http\Resources\orders;

use App\Http\Resources\files;
use Illuminate\Http\Resources\Json\JsonResource;

class seller_orders extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->state_order=="1"){
            $state="تم التوصيل";
        }else {$state="لم يتم التوصيل";}



        if ($this->accept_order=="0"){
            $accept="لم يتم القبول بعد";
        }
        elseif ($this->accept_order=="1"){
            $accept="مقبول ";
        }

        else{$accept="مرفوض";}




        if ($this->state_pay=="1"){
            $stat_pay=" jawwal pay تم الدفع";
        }elseif($this->state_pay=="2"){
            $stat_pay="الدفع بعد الاستلام";
        }
        else{$stat_pay="لم يتم الدفع بعد by jawwal pay";}




        return [
            "uuid_order"=>$this->order_uuid,
            "state_order"=>$state,
            "state_pay"=>$stat_pay,
            "from_seller"=>$this->product_seller->place["title_of_place"],

            "product"=>$this->product_seller["title"],
            "accept_order"=>$accept,

            "price_of_product"=>$this->price_order ?? "ERROR 404",

            "count_product"=>$this->count_product,


            "ex_price_order"=>$this->ex_price_order ?? "لكل قطعة",
            "image_place"=>new files($this->product_seller->place->img)?? "خطا داخلي يرجى مراجعة ابو الجود",

            "count"=>$this->count_product
        ];
    }
}
