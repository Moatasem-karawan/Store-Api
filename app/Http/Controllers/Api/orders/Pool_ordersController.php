<?php

namespace App\Http\Controllers\Api\orders;

use App\Http\Controllers\Controller;
use App\Models\Admin\codes\Pool_code;
use App\Models\Owner\Place as pool_place;
use App\Models\Owner\Pool_orders;
use App\Models\Pivot_periods_pool;
use App\Models\the_period;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Pool_ordersController extends Controller
{
    public function make_pool_order(Request $request){
        $stat_reservation="0";
        $v=Validator::make($request->all(),[
            "date_reservation"=>"required|date",
            "the_period_id"=>"required",
            "number_of_persons"=>"required",
            "pool_place_id"=>"required|numeric",

        ]);

        if($v->fails()){
            return response()->json(['states'=>false,'msg' => 'Lack Information',"error"=>$v->errors()]);
        }
        $now=Carbon::now()->format('Y-m-d');
        $date1 = Carbon::createFromFormat('Y-m-d', $request->date_reservation);
        $date2 = Carbon::createFromFormat('Y-m-d', $now);
        $result = $date1->gte($date2);

        if (!$result){


            return response()->json(['states'=>true,'msg' => 'تم اختيار تاريخ في الماضي الرجاء اختيار تاريخ صحيح']);
        }

        $poolplace=pool_place::find($request->pool_place_id);




        if ($poolplace->reservation->where("date_reservation","=","$request->date_reservation")->count()==0)
        {
            $stat_reservation="1";
        }

        elseif ($poolplace->reservation->where("date_reservation","=","$request->date_reservation")->count()<=1 && $request->date_reservation!="1")
        {
            if ($request->the_period_id!="1"){
                $all_period=[];
                $data=$poolplace->reservation->where("date_reservation","=","$request->date_reservation");
                foreach ($data as $resrvate){
                    array_push($all_period,$resrvate->the_period_id);
                }

                $stat_reservation="1";
                foreach ($all_period as $per){
                    if($per==$request->the_period_id){
                        $stat_reservation="0";
                    }
                }
                foreach ($all_period as $per){
                    if($per=="1"){
                        $stat_reservation="0";
                    }
                }}else {$stat_reservation="0";}

        }
        else{   $stat_reservation="0";
        }






        if ($stat_reservation=="1"){
            $code_offer=0;
            if (isset($request->pool_code)){
                $code=Pool_code::where("code","=",$request->pool_code)->where('pool_place_id',"=",$poolplace->id)->first();
                   if(!$code){
                    return response()->json(['states'=>true,'msg' => "خطا لم يتم الحجز الكود غير صالح"]);
                }
                if($code && $code->max_use > $code->usage){
                    $code->usage=$code->usage+1;
                    $code->save();
                    $code_offer=$code->offer;

                    $period=Pivot_periods_pool::where("the_period_id","=","$request->the_period_id")->where("place_id","=","$request->pool_place_id")->first();
                        $pay_price=$period->price - $period->price *$code_offer /100;



                    $order=Pool_orders::create([
                        "number_of_persons"=>$request->number_of_persons,
                        "state_pay"=>"0",
                        "state_pool_order"=>"0",

                        "price_order"=>$pay_price,
                        "state_price_order"=>"تم الحجز بواسطو كود خصم",

                        "user_id"=>auth()->user()->id,
                        "pool_place_id"=>$request->pool_place_id,
                        "date_reservation"=>$request->date_reservation,
                        "the_period_id"=>$request->the_period_id
                    ]);
                    $random_number=rand(5823,48156);
                    $random_number2=rand(10,20);

                    $order->order_uuid=$random_number.$order->id.$random_number2;
                    $order->save();

                    return response()->json(['states'=>true,'msg' => 'تم الحجز ',"uuid_order"=>$order->order_uuid]);


                }

                elseif($code && $code->max_use == $code->usage){
                    return response()->json(['states'=>true,'msg' => "خطا لم يتم الحجز هذا الكود منتهي الصلاحية"]);

                }

                else{
                    return response()->json(['states'=>true,'msg' => "لم يتم الحجز حدث خطا داخلي"]);
                }
            }
            else{

                if(!$period=Pivot_periods_pool::where("the_period_id","=","$request->the_period_id")->where("place_id","=","$request->pool_place_id")->first()){
                    return response()->json(["state"=>false,"msg"=>'حدث خطا اثناء التسعير']);
                }

            $order=Pool_orders::create([
                "number_of_persons"=>$request->number_of_persons,
                "state_pay"=>"0",
                "state_pool_order"=>"0",

                "price_order"=>$period->price,
                "state_price_order"=>"حجز بدون خصومات",

                "user_id"=>auth()->user()->id,
                "pool_place_id"=>$request->pool_place_id,
                "date_reservation"=>$request->date_reservation,
                "the_period_id"=>$request->the_period_id
            ]);
            $random_number=rand(5823,48156);
            $random_number2=rand(10,20);

            $order->order_uuid=$random_number.$order->id.$random_number2;
            $order->save();

            return response()->json(['states'=>true,'msg' => 'تم الحجز ',"uuid_order"=>$order->order_uuid]);

        }
        }
        else{
            return response()->json(['states'=>false,'msg' => 'الشالية محجوز في هذه الفتره']);
        }


    }

    public function make_pool_order_offer(Request $request){
        $stat_reservation="0";
        $v=Validator::make($request->all(),[
            "date_reservation"=>"required|date",
            "the_period_id"=>"required",
            "number_of_persons"=>"required",
            "pool_place_id"=>"required|numeric",

        ]);

        if($v->fails()){
            return response()->json(['states'=>false,'msg' => 'Lack Information',"error"=>$v->errors()]);
        }
        $now=Carbon::now()->format('Y-m-d');
        $date1 = Carbon::createFromFormat('Y-m-d', $request->date_reservation);
        $date2 = Carbon::createFromFormat('Y-m-d', $now);
        $result = $date1->gte($date2);

        if (!$result){


            return response()->json(['states'=>true,'msg' => 'تم اختيار تاريخ في الماضي الرجاء اختيار تاريخ صحيح']);
        }

        $poolplace=pool_place::find($request->pool_place_id);


       if ($poolplace->reservation->where("date_reservation","=","$request->date_reservation")->count()==0)
        {
        $stat_reservation="1";
              }

       elseif ($poolplace->reservation->where("date_reservation","=","$request->date_reservation")->count()<=1 && $request->date_reservation!="1"){
           if ($request->the_period_id!="1"){
               $all_period=[];
               $data=$poolplace->reservation->where("date_reservation","=","$request->date_reservation");
               foreach ($data as $resrvate){
                   array_push($all_period,$resrvate->the_period_id);
               }

               $stat_reservation="1";
               foreach ($all_period as $per){
                   if($per==$request->the_period_id){
                       $stat_reservation="0";
                   }
               }
               foreach ($all_period as $per){
                   if($per=="1"){
                       $stat_reservation="0";
                   }
               }}else {$stat_reservation="0";}

    }
    else{   $stat_reservation="0";}
        $offer_period=$poolplace->offer_periods->where("the_period_pool_id","=",$request->the_period_id)->first();

        if (!$offer_period){
            return response()->json(['states'=>true,'msg' => 'عذرا هذا الشاليه لم يقدم عرض على هذه الفترة']);

        }
        else{


        if ($stat_reservation=="1"){


                $order=Pool_orders::create([
                    "number_of_persons"=>$request->number_of_persons,
                    "state_pay"=>"0",
                    "state_pool_order"=>"0",

                    "price_order"=>$offer_period->new_price,
                    "state_price_order"=>"تم الحجز بواسطة عرض مميز تم تقديمه مسبقا",

                    "user_id"=>auth()->user()->id,
                    "pool_place_id"=>$request->pool_place_id,
                    "date_reservation"=>$request->date_reservation,
                    "the_period_id"=>$request->the_period_id
                ]);
                $random_number=rand(5823,48156);
                $random_number2=rand(10,20);

                $order->order_uuid=$random_number.$order->id.$random_number2;
                $order->save();

                return response()->json(['states'=>true,'msg' => 'تم الحجز ',"uuid_order"=>$order->order_uuid]);


        }
        else{
            return response()->json(['states'=>false,'msg' => 'الشالية محجوز في هذه الفتره']);
        }}


    }


    public function delete_pool_order($id_pool_order)
    {

        $order=Pool_orders::findorfail($id_pool_order);


        if ($order->user_id==auth()->user()->id){
            $order->delete();
            return response()->json(['states'=>true,'msg' => 'Delete Done']);
        }
        else{ return response()->json(['states'=>false,'msg' => 'ERROR USER ID']);
        }

    }
}
