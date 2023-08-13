<?php

namespace App\Http\Controllers\Api\orders;

use App\Http\Controllers\Controller;
use App\Models\Admin\codes\Seller_code;
use App\Models\Files;
use App\Models\Seller\Order_seller;
use App\Models\Seller\Place as seller_place;


use App\Models\Seller\Seller_offers;
use App\Models\Seller\seller_product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Seller_ordersController extends Controller
{
    public function make_seller_order(Request $request){
    $stat_day="0";
    $state_accept="1";
    $v=Validator::make($request->all(),[

        "location_description"=>"required",
        "count_product"=>"required|integer",
        "x"=>"required",
        "y"=>'required',
        "seller_place_id"=>"required|integer",
        "product_seller_place_id"=>"required|integer",

    ]);

    if($v->fails()){
        return response()->json(['states'=>false,'msg' => 'Lack Information',"error"=>$v->errors()]);
    }
    $seller=seller_place::findorfail($request->seller_place_id);





    if (isset($request->state_pay)&&$request->state_pay=="after-receipt"){


        if ($seller->delivery_state=="1"){
            $stat_pay="2";
            $state_accept="0";
        }
        else{return response()->json(['states'=>false,'msg' => "نعتذر نحن لا نوفر الدفع عند الاستلام"]);
        }

    }
    else{$stat_pay="0";}




    $today = Carbon::createFromFormat('d/m/Y', Carbon::now()->format("d/m/Y"))->format('l');

    $place_days_work_befor_prossing=$seller->days;

    foreach ($place_days_work_befor_prossing as $day){

        if ($day->day_en==$today){$stat_day="1";}
    }

    if($stat_day=="1"||$stat_day=="0"){
        $code_offer=0;
        if (isset($request->seller_code)){
            $v_code=Validator::make($request->all(),['seller_code'=>'required']);
            if ($v_code->fails()){return "error";}
            $code=Seller_code::where("code","=",$request->seller_code)->where('seller_place_id',"=",$seller->id)->first();
            if(!$code){
                return response()->json(['states'=>true,'msg' => "خطا لم يتم الحجز الكود غير صالح"]);
            }
            if($code && $code->max_use > $code->usage){
                $code->usage=$code->usage+1;
                $code->save();
                $code_offer=$code->offer;

                $product=$seller->products_seller->where("state","=","1")->where("id","=","$request->product_seller_place_id,")->first();
                if (!$product){ return response()->json(['states'=>true,'msg' => "حدث خطا داخلي"]); }
                $pay_price=$product->price - $product->price *$code_offer /100;

                $random_number=rand(5823,48156);
                $random_number2=rand(10,20);
                $order=Order_seller::create([

                    "location_description"=>"0",
                    "state_pay"=>$stat_pay,
                    "state_order"=>"0",
                    "count_product"=>$request->count_product,
                    "x"=>$request->x,
                    "y"=>$request->y,
                    "price_order"=>$pay_price*$request->count_product,
                    'name_ex'=>$product->name_ex,
                    'count_ex'=>$temp=$product->count_ex*$request->count_product,
                    'ex_price_order'=>$temp="الكمية المطلوبة :". $temp."-".$product->name_ex ."-". "ب"."-". $pay_price*$request->count_product."-"."شيكل",

                    "state_price_order"=>"تم الخصم بكود " . $request->seller_code,
                    "accept_order"=>$state_accept,
                    "user_id"=>auth()->user()->id,
                    "seller_place_id"=>$request->seller_place_id,
                    "product_seller_place_id"=>$request->product_seller_place_id,
                    //'code_offer_id'=>$code->id,

                ]);

                $order->order_uuid=$random_number.$order->id.$random_number2;
                $order->save();

                if($request->file('file')){
                    $v_image=Validator::make($request->all(),[
                        'file'=>"image|required"
                    ]);
                    if ($v_image->fails()){
                        $order->delete();
                        return response()->json(["state"=>false,"msg"=>"يجب ارفاق صورة - تم الغاء طلبك"]);

                    }
                    else{
                        $file=$request->file("file");
                        $file_ex=$file->extension();
                        $fileOriginalName=$file->getClientOriginalName();
                        $un_file_name=uniqid().time().".".$file_ex;
                        $file->storeAs("/all_files","$un_file_name");

                        Files::create([
                            "url"=>$un_file_name,
                            "client_name"=>$fileOriginalName,
                            "fileable_id"=>(int)$order->id,
                            "fileable_type"=>"App\Models\Seller\Order_seller"
                        ]);}
                }

                $last_explorer=$seller->explorer;
                $new_explorer=$last_explorer+1;
                $seller->explorer=$new_explorer;
                $seller->save();


                return response()->json(['states'=>true,'msg' => 'تم تسجيل الطلب ',"uuid_order"=>$order->order_uuid]);


            }

            elseif($code && $code->max_use == $code->usage){
                return response()->json(['states'=>true,'msg' => "خطا لم يتم الحجز هذا الكود منتهي الصلاحية"]);

            }

            else{
                return response()->json(['states'=>true,'msg' => "لم يتم الحجز حدث خطا داخلي"]);
            }
        }
        else{
            /**order with out code offer**/


            if(!$product=$seller->products_seller->where("state","=","1")->where("id","=","$request->product_seller_place_id")->first()){
                return response()->json(["state"=>false,"msg"=>'حدث خطا اثناء التسعير']);
            }

            $random_number=rand(5823,48156);
            $random_number2=rand(10,20);
            $order=Order_seller::create([

                "location_description"=>"0",
                "state_pay"=>$stat_pay,
                "state_order"=>"0",
                "count_product"=>$request->count_product,
                "x"=>$request->x,
                "y"=>$request->y,
                "price_order"=> $product->price*$request->count_product,

                'name_ex'=>$product->name_ex,
                'count_ex'=>$temp=$product->count_ex*$request->count_product,
                'ex_price_order'=>$temp="الكمية المطلوبة :". $temp."-".$product->name_ex ."-". "ب"."-". $product->price*$request->count_product."-"."شيكل",

                "state_price_order"=>"لم يتم الخصم-طلب بدون خصومات ",
                "accept_order"=>$state_accept,
                "user_id"=>auth()->user()->id,
                "seller_place_id"=>$request->seller_place_id,
                "product_seller_place_id"=>$request->product_seller_place_id,

            ]);

            $order->order_uuid=$random_number.$order->id.$random_number2;
            $order->save();

            if($request->file('file')){
                $v_image=Validator::make($request->all(),[
                    'file'=>"image|required"
                ]);
                if ($v_image->fails()){
                    $order->delete();
                    return response()->json(["state"=>false,"msg"=>"يجب ارفاق صورة - تم الغاء طلبك"]);

                }
                else{
                    $file=$request->file("file");
                    $file_ex=$file->extension();
                    $fileOriginalName=$file->getClientOriginalName();
                    $un_file_name=uniqid().time().".".$file_ex;
                    $file->storeAs("/all_files","$un_file_name");

                    Files::create([
                        "url"=>$un_file_name,
                        "client_name"=>$fileOriginalName,
                        "fileable_id"=>(int)$order->id,
                        "fileable_type"=>"App\Models\Seller\Order_seller"
                    ]);}
            }

            $last_explorer=$seller->explorer;
            $new_explorer=$last_explorer+1;
            $seller->explorer=$new_explorer;
            $seller->save();


            return response()->json(['states'=>true,'msg' => 'تم تسجيل الطلب ',"uuid_order"=>$order->order_uuid]);



            /** end order with out code offer**/



        }
    }
    else{return response()->json(["state"=>false,"msg"=>"نعتذر نحن لا نعمل اليوم"]);}
}


    public function make_offer_seller_order(Request $request){
        $stat_day="0";
        $state_accept="1";
        $v=Validator::make($request->all(),[

            "location_description"=>"required",
            "count_product"=>"required|integer",
            "x"=>"required",
            "y"=>'required',
            "seller_place_id"=>"required|integer",
            "product_seller_place_id"=>"required|integer",

        ]);

        if($v->fails()){
            return response()->json(['states'=>false,'msg' => 'Lack Information',"error"=>$v->errors()]);
        }
        $seller=seller_place::find($request->seller_place_id);
        if (!$seller){return response()->json(["state"=>true,"msg"=>"No place for this ID"]);}





        if (isset($request->state_pay)&&$request->state_pay=="after-receipt"){


            if ($seller->delivery_state=="1"){
                $stat_pay="2";
                $state_accept="0"; /**pending for accept**/
            }
            else{return response()->json(['states'=>false,'msg' => "نعتذر نحن لا نوفر التوصيل عند الاستلام"]);
            }

        }
        else{$stat_pay="0";}




        $today = Carbon::createFromFormat('d/m/Y', Carbon::now()->format("d/m/Y"))->format('l');

        $place_days_work_befor_prossing=$seller->days;

        foreach ($place_days_work_befor_prossing as $day){

            if ($day->day_en==$today){$stat_day="1";}
        }

        if($stat_day=="1"){

            $offer=Seller_offers::where("seller_place_id","=",$request->seller_place_id)->where("product_seller_place_id","=",$request->product_seller_place_id)->first();
           if (!$offer){ return response()->json(["state"=>true,"msg"=>"No offer for This ID"]);}


           $random_number=rand(5823,48156);
            $random_number2=rand(10,20);
            $order=Order_seller::create([

                "location_description"=>$request->location_description,
                "state_pay"=>$stat_pay,
                "state_order"=>"0",

                "state_price_order"=>"تم الخصم من العرض المقدم ".$offer->new_price_product." "."شيكل"." ".$offer->ex_price,
                'price_order'=>$offer->new_price_product*$request->count_product,
                'name_ex'=>$offer->name_ex,
                'count_ex'=>$temp=$offer->count_ex*$request->count_product,

                'ex_price_order'=>$temp="الكمية المطلوبة :". $temp."-".$offer->name_ex ."-". "ب"."-". $offer->new_price_product*$request->count_product."-"."شيكل",


                "count_product"=>$request->count_product,
                "x"=>$request->x,
                "y"=>$request->y,
                "accept_order"=>$state_accept,
                "user_id"=>auth()->user()->id,
                "seller_place_id"=>$request->seller_place_id,
                "product_seller_place_id"=>$request->product_seller_place_id,
                //'offer_seller_id'=>$offer->id

            ]);

            $order->order_uuid=$random_number.$order->id.$random_number2;
            $order->save();

            if($request->file('file')){
                $v_image=Validator::make($request->all(),[
                    'file'=>"image|required"
                ]);
                if ($v_image->fails()){
                    $order->delete();
                    return response()->json(["state"=>true,"msg"=>"يجب ارفاق صورة - تم الغاء طلبك"]);

                }
                else{
                    $file=$request->file("file");
                    $file_ex=$file->extension();
                    $fileOriginalName=$file->getClientOriginalName();
                    $un_file_name=uniqid().time().".".$file_ex;
                    $file->storeAs("/all_files","$un_file_name");

                    Files::create([
                        "url"=>$un_file_name,
                        "client_name"=>$fileOriginalName,
                        "fileable_id"=>(int)$order->id,
                        "fileable_type"=>"App\Models\Seller\Order_seller"
                    ]);}
            }

            $last_explorer=$seller->explorer;
            $new_explorer=$last_explorer+1;
            $seller->explorer=$new_explorer;
            $seller->save();

            return response()->json(["state"=>true,"msg"=>"تم تسجيل الطلب سيتم التوصيل في غضون نصف ساعة","order_uuid"=>$order->order_uuid]);
        }else{return response()->json(["state"=>false,"msg"=>"نعتذر نحن لا نعمل اليوم"]);
        }}

    public function delete_seller_order($id_seller_order)
    {
        $order=Order_seller::findorfail($id_seller_order);

        if ($order->user_id==auth()->user()->id){
            $order->delete();
            return response()->json(['states'=>true,'msg' => 'Delete Done']);
        }
        else{ return response()->json(['states'=>false,'msg' => 'ERROR USER ID']);
        }

    }




}
