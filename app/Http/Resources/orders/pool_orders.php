<?php

namespace App\Http\Resources\orders;

use App\Http\Resources\files;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class pool_orders extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $now=Carbon::now()->format('Y-m-d');
        $date1 = Carbon::createFromFormat('Y-m-d', $this->date_reservation);
        $date2 = Carbon::createFromFormat('Y-m-d', $now);
        $result = $date1->gte($date2);
        $days = now()->diffInDays(Carbon::parse($this->date_reservation));
        if($result){
            if ($days=="0"){
                $world="اليوم او غدا";

            }else{
                $world="باقي"."-".$days."-"."يوم";}
        }else{$world="انتهي ";}




        if($this->state_pay=="0"){
            $msg="هذا الحجز غير مدفوع لن يتم اخذة بعين الاعتبار";
        }
        else{$msg="حالة الطلب مدفوع";}
        return [
            "order_uuid"=>$this->order_uuid,
            "pay_price"=>$this->price_order ?? "ERROR 404",
            "period_title"=>$this->period->title,
            "state_pay"=>$msg,
            "number_of_persons"=>$this->number_of_persons,
            "pool"=>$this->pool->title,
            "owner_phone"=>$this->pool->owner->phone,
            "period"=>$this->period->title,
            "time"=>$this->period->time,
            "date_reservation"=>$this->date_reservation,
            "state_reservation"=>$world,
            "files"=>files::collection($this->pool->files),
        ];
    }
}
