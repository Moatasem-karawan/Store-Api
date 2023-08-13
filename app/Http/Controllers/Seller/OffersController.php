<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Admin\codes\Seller_code;
use App\Models\Seller\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OffersController extends Controller
{
   public function show_my_codes()
   {

       $place=Place::where("seller_id","=",Auth::guard("seller_owner")->id())->first();
       if (!$place){
           toastr()->warning("لم يتم اضافة مشروعك التجاري !!");
           return redirect()->back();
       }
       $codes=Seller_code::where("category_id","=",$place->category_id)->where("seller_place_id","=",$place->id)->orwhere("seller_place_id","=",null)->get();
       if (!$codes){
           $codes=[];
       }
       return view("seller.seller_codes",compact('codes'));
   }
   public function store_code_offers_by_seller(Request $request){
       $place=Place::where("seller_id","=",Auth::guard("seller_owner")->id())->first();


       $v=Validator::make($request->all(),[
           'code'=>"required",
           'offer'=>'required',

       ]);
       if ($v->fails()){
           toastr()->error("خطا");
           return redirect()->back();
       }else{
           $v2=Validator::make($request->all(),[
           'code'=>"required|unique:seller_codes,code",
       ]);
           if ($v2->fails()){
               toastr()->error("الكود موجود مسبقا");
               return redirect()->back();
           }else{$code=Seller_code::create([
               'code'=>"$request->code",
               'offer'=>$request->offer,
               "max_use"=>$request->max_use,
               'category_id'=>$place->category_id,
               'seller_place_id'=>$place->id
           ]);
           toastr()->success("تم اضافة كود الخصم");
           return redirect()->back();}


       }


   }
}
