<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner\Owner;
use App\Models\Owner\Pool_orders;
use App\Models\Pivot_periods_pool;
use Carbon\Carbon;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
//    public function out_reservation_view(){
//        $owner=Owner::find(Auth::guard("owner")->id());
//        $pool_periods=$owner->owner_place->the_periods;
//        return view("owner.out_side_reservation",compact('pool_periods'));
//
//    }
    public function store_out_reservation(Request $request){

        $stat_reservation="0";
        $v=Validator::make($request->all(),[
            "date_reservation"=>"required|date",
            "the_period_id"=>"required|integer",
            "number_of_persons"=>"required",

        ]);

        if($v->fails()){
            return response()->json(['state'=>false,'msg' => 'خطا في البيانات المعطاة']);
        }
        $now=Carbon::now()->format('Y-m-d');
        $date1 = Carbon::createFromFormat('Y-m-d', $request->date_reservation);
        $date2 = Carbon::createFromFormat('Y-m-d', $now);
        $result = $date1->gte($date2);

        if (!$result){


            return response()->json(['state'=>false,'msg' => 'تم اختيار تاريخ في الماضي الرجاء اختيار تاريخ صحيح']);
        }

        $owner=Owner::find(Auth::guard("owner")->id());
        $poolplace=$owner->owner_place;


        if ($poolplace->reservation->where("date_reservation","=","$request->date_reservation")->count()==0)
        {
            $stat_reservation="1";
        }

        elseif ($poolplace->reservation->where("date_reservation","=","$request->date_reservation")->count()<=1)
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

            if(!$period=Pivot_periods_pool::where("the_period_id","=","$request->the_period_id")->where("place_id","=","$poolplace->id")->first()){
                return response()->json(["state"=>false,"msg"=>'حدث خطا اثناء التسعير']);
            }

            $order=Pool_orders::create([
                "number_of_persons"=>$request->number_of_persons,
                "state_pay"=>"2",
                "state_pool_order"=>"1",

                "price_order"=>$period->price,
                "state_price_order"=>"حجز بدون خصومات",

                "user_id"=>null,
                "pool_place_id"=>$poolplace->id,
                "date_reservation"=>$request->date_reservation,
                "the_period_id"=>$request->the_period_id
            ]);
            $random_number=rand(5823,48156);
            $random_number2=rand(10,20);

            $order->order_uuid=$random_number.$order->id.$random_number2;
            $order->save();


            return response()->json(['state'=>true,'msg' => 'تم الحجز ',"uuid_order"=>$order->order_uuid]);

        }else{
            return response()->json(['state'=>false,'msg' => 'الشالية محجوز في هذه الفتره']);
        }

    }
}
