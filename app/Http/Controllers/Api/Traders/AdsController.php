<?php

namespace App\Http\Controllers\Api\Traders;

use App\Http\Controllers\Controller;
use App\Http\Resources\Traders\sms_ads_orders;
use App\Models\Notifications\Ads_sms_orders;
use App\Models\Seller\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdsController extends Controller
{
   public function sms_ads(Request $request){
       if ($request->isMethod("get")){
           return response()->json(["states"=>false,"msg"=>"Type of this route is post"]);
       }else{
       $v=Validator::make($request->all(),[

           "message_of_ads"=>"required|string",
           "count_receivers"=>"required|integer",


       ]);
       if ($v->fails()){
           return response()->json(["states"=>false,"msg"=>"lack information","error"=>$v->errors()]);

       }
       else{
           $auth_seller=auth("seller_api")->user();
           $seller=Seller::findorfail($auth_seller->id);
           if (!$seller->place){
               return response()->json(["states"=>false,"msg"=>"انت لايوجد لك مشروع تجاري لا يمكنك طلب هذه الخدمة"]);
           }else{
               $ads_exist=Ads_sms_orders::where("seller_id","=",$auth_seller->id)->latest()->first();

               if ($ads_exist && $ads_exist->states=="pending"){

                   return response()->json(["states"=>true,"msg"=>" طلبك قيد الانتظار"]);
               }

               $ads=Ads_sms_orders::create([
                   "message_of_ads"=>$request->message_of_ads,
                   "count_receivers"=>$request->count_receivers,
                   "seller_id"=>$auth_seller->id,
                   "seller_place_id"=>$seller->place->id,
                   'category_id'=>$seller->place->category_id
               ]);
           }
           return response()->json(["states"=>true,"msg"=>"تم تسجيل طلبك سوف تصلك رسالة على الهاتف عند قبول الطلب "]);
       }
   }}
   public function sms_ads_orders (Request $request){
       if ($request->isMethod("post")){
           return "REJECT TYPE OF THIS ROUTE IS GET ";
       }
       else{
           $auth_seller=auth("seller_api")->user();
           $seller=Seller::findorfail($auth_seller->id);
           $data=$seller->get_sms_ads_orders;
           if (!$seller->get_sms_ads_orders){
               $data=[];
           }
           return response()->json(["states"=>true,"data"=>sms_ads_orders::collection($data)]);
       }

   }
}
