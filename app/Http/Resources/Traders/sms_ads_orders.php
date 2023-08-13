<?php

namespace App\Http\Resources\Traders;

use Illuminate\Http\Resources\Json\JsonResource;

class sms_ads_orders extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->states=="pending"){
            $this->states="قيد الانتظار";

        }elseif($this->states=="accept"){
            $this->states="تم قبول الاعلان -تم الارسال";

        }elseif($this->states=="reject"){
            $this->states="مرفوض";

        }else{

        }
        return [
            "message"=>$this->message_of_ads,
            "states_of_ads_order"=>$this->states
        ];
    }
}
