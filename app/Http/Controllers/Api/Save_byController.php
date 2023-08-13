<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Save_by\Save_by_pool_place as Save_by_pool_place_res;
use App\Http\Resources\Save_by\Save_by_seller_place as Save_by_seller_place_res;
use App\Models\Saveby_user_pool_place;
use App\Models\Saveby_user_seller_place;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Save_byController extends Controller
{
    public function save_pool_place(Request $request){

        $v=Validator::make($request->all(),[
            "pool_place_id"=>"required|integer",
        ]);
        if ($v->fails()){
            return response()->json(["state"=>false,"msg"=>$v->errors()]);
        }else{
            $the_post=User::find(auth()->user()->id)->my_save_pool->where("pool_place_id","=",$request->pool_place_id)->first();
            if ($the_post){   return response()->json(["state"=>true,"msg"=>"تم الحفظ مسبقا"]);}
            if (!$the_post){
            $save=Saveby_user_pool_place::create([
                "pool_place_id"=>$request->pool_place_id,
                "user_id"=>auth()->user()->id,
            ]);
            return response()->json(["state"=>true,"msg"=>"تم الحفظ بنجاح"]);
        }}

    }
    public function save_seller_place(Request $request){
        $v=Validator::make($request->all(),[
            "seller_place_id"=>"required|integer",
        ]);
        if ($v->fails()){
            return response()->json(["state"=>false,"msg"=>$v->errors()]);
        }else{
            $the_post=User::find(auth()->user()->id)->my_save_seller_place->where("seller_place_id","=",$request->seller_place_id)->first();
            if ($the_post){   return response()->json(["state"=>true,"msg"=>"تم الحفظ مسبقا"]);}
            if (!$the_post){


            $save=Saveby_user_seller_place::create([
                "seller_place_id"=>$request->seller_place_id,
                "user_id"=>auth()->user()->id,
            ]);
            return response()->json(["state"=>true,"msg"=>"تم الحفظ بنجاح"]);

        } }
    }
    public function get_save_pool_place(){
        $user=User::find(auth()->user()->id);


        return response()->json(["state"=>true,"your_save_post"=>Save_by_pool_place_res::collection($user->my_save_pool)]);
    }
    public function get_save_seller_place(){
        $user=User::find(auth()->user()->id);
        return response()->json(["state"=>true,"your_save_post"=>Save_by_seller_place_res::collection($user->my_save_seller_place)]);
    }

    public function delete_save_pool_place(Request $request){
        $v=Validator::make($request->all(),[
            "pool_place_id"=>"required|integer",
        ]);
        if ($v->fails()){
            return response()->json(["state"=>false,"msg"=>$v->errors()]);
        }else{
            $place=Saveby_user_pool_place::where("pool_place_id","=",$request->pool_place_id)
                ->where("user_id","=",auth()->user()->id)->delete();
            if (!$place){return response()->json(["state"=>false,"msg"=>"Internal Error ID NOT CORRECT"]);}
            return response()->json(["state"=>true,"msg"=>"DELETE DONE"]);
        }
    }


    public function delete_save_seller_place(Request $request){
        $v=Validator::make($request->all(),[
            "seller_place_id"=>"required|integer",
        ]);
        if ($v->fails()){
            return response()->json(["state"=>false,"msg"=>$v->errors()]);
        }else{
            $place=Saveby_user_seller_place::where("seller_place_id","=",$request->seller_place_id)
                ->where("user_id","=",auth()->user()->id)->delete();
            if (!$place){return response()->json(["state"=>false,"msg"=>"Internal Error ID NOT CORRECT"]);}

            return response()->json(["state"=>true,"msg"=>"DELETE DONE"]);
        }

    }
}
