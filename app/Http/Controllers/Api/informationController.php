<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\information_all_pool_place;
use App\Http\Resources\information_all_seller_place;
use App\Models\Admin\Category;

use \App\Http\Resources\fqa as fqa_res;

use App\Models\Admin\Whats_app_msg;
use App\Models\FQA;
use App\Models\Owner\Place as pool_place;
use App\Models\Seller\Place as seller_place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class informationController extends Controller
{
    public function filtering_data(Request $request){

        if ($request->isMethod('get')){
            return response()->json(["states"=>false,"msg"=>"TYPE OF THIS ROUTE IS POST"]);
        }
        else{
            $v1=Validator::make($request->all(),[
                "category_id"=>"required|integer|between:1,5",
                "region_id"=>"required",
            ]);
            if ($v1->fails()){
                return response()->json(["states"=>false,"msg"=>"Error in input data","errors"=>$v1->errors()]);
            }else{
                if (isset($request->area_id) && $request->area_id >0){
                    $data=seller_place::where("state","=","1")->where("category_id","=",$request->category_id)
                        ->where("region_id","=",$request->region_id)->get();


                    return response()->json(["state"=>true,"data"=>information_all_seller_place::collection($data)]);
                }else
                {

                    $data=seller_place::where("state","=","1")->where("category_id","=",$request->category_id)
                        ->where("region_id","=",$request->region_id)
                       ->get();


                    return response()->json(["state"=>true,"data"=>information_all_seller_place::collection($data)]);
                }
            }
        }

    }
    public function who_iam(Request $request){
        $validator = Validator::make($request->all(), [
            "user_favourites" => "required|array",
            "user_favourites.*"  => "required|integer|distinct|min:3",
        ]);
        if ($validator->fails()){
            return $validator->errors();
        }
       return $request['array'][1];
    }
    public function get_categories(){

        $categorys= Category::all();


        return response()->json(['state'=>true,"category"=>\App\Http\Resources\category::collection($categorys)]);

    }


    public function get_random_products(){

        $random=[];
        $categorys= Category::all();

        foreach($categorys as $category){
            if($category->active_product->count()>0){

                foreach($category->active_product()->orderBy("explorer","DESC")->take(3)->get() as $x=>$product){

                    array_push($random, new \App\Http\Resources\product($product));


                }


            }
        }

        return response()->json(['state'=>true,"randomly"=>\App\Http\Resources\product::collection($random)]);

    }



    public function get_place_of_category($id_category){
        $category=Category::findorfail($id_category);
        if ($category->hashcode=="7000"){

        }



        else if ($category->hashcode=="8000"){

            $data=pool_place::where("state","=","1")->get();


            return response()->json(["state"=>true,"data"=>information_all_pool_place::collection($data)]);

        }


        else if ($category->hashcode=="3000"){
            $data=seller_place::where("state","=","1")->where("category_id","=",$category->id)->get();


            return response()->json(["state"=>true,"data"=>information_all_seller_place::collection($data)]);

        }

        else if ($category->hashcode=="4000"){
            $data=seller_place::where("state","=","1")->where("category_id","=",$category->id)->get();


            return response()->json(["state"=>true,"data"=>information_all_seller_place::collection($data)]);

        }
        else if ($category->hashcode=="5000"){
            $data=seller_place::where("state","=","1")->where("category_id","=",$category->id)->get();

            return response()->json(["state"=>true,"data"=>information_all_seller_place::collection($data)]);

        }
        else if ($category->hashcode=="9000"){
            $data=seller_place::where("state","=","1")->where("category_id","=",$category->id)->get();

            return response()->json(["state"=>true,"data"=>information_all_seller_place::collection($data)]);

        }



        else{

            return response()->json(["state"=>false,"msg"=>"حدث خطا داخلي"]);
        }

}




     public function show_product($id_category){


     }


//|regex:/(97259)[0-9]/
     public function whats_msg(Request $request){
       $v=Validator::make($request->all(),[
           "msg"=>"required",
           "phone"=>"required|min:10|numeric",
       ]);
       if ($v->fails()){
           return response()->json(["state"=>false,"errors"=>$v->errors()]);
       }
       else{
        $whats_app=Whats_app_msg::create([
            "msg"=>$request->msg,
            "state"=>"0",
            "phone"=>"+".$request->phone

        ]);
        if ($whats_app){
            return response()->json(["state"=>true,"msg"=>"سيتم التواصل معك شكرا"]);
        }
     }}



     public function get_fqa(){
        $fqa=FQA::all();
        return response()->json(["state"=>true,"questions"=>fqa_res::collection($fqa)]);

     }
}
