<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Owner\Place as pool_place;
use App\Models\Rating;
use App\Models\Seller\Place as seller_place;
use App\Models\User;
use App\Models\Users_rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RatingController extends Controller
{
    public function make_rating_pool_place(Request $request){
        $v=Validator::make($request->all(),[
            "rating"=>"required|integer",
            "pool_place_id"=>"required|integer",

        ]);
        if ($v->fails()){
            return response()->json(["state"=>false,"error"=>$v->errors()]);
        }
        else{


        $rating = Rating::where("pool_place_id",$request->pool_place_id)->first();
        if ($rating){
            $user=User::find(auth()->user()->id);

            if($user->rating($rating->id)->count()!=0){
                return response()->json(["state"=>true,"msg"=>"تم تسجيل تقيمك مسبقا لهذا المكان شكرا !"]);
            }
            else{



                $last_rating = $rating->rating;
                $new_rating = $last_rating + $request->rating;
                $rating->rating = $new_rating;
                $new_count_users = $rating->number_users + 1;
                $rating->number_users = $new_count_users;
                $rating->save();
                Users_rating::create([
                    "user_id" => auth()->user()->id,
                    "rating_id" => $rating->id
                ]);
                return response()->json(["state" => true, "msg" => "شكرا لتقيمك لنا"]);
            }}


        else{


            $pool=pool_place::find($request->pool_place_id);
            if($pool){
                $rating=Rating::create(["number_users"=>"1","rating"=>$request->rating,"pool_place_id"=>$request->pool_place_id]);
                Users_rating::create([
                    "user_id"=>auth()->user()->id,
                    "rating_id"=>$rating->id
                ]);
                return response()->json(["state" => true, "msg" => "شكرا لتقيمك لنا"]);

            }
            else{return response()->json(["state"=>true,"msg"=>"this id pool not fount sorry"]);}

        }


    }}

    public function make_rating_seller_place(Request $request){
        $v=Validator::make($request->all(),[
            "rating"=>"required|integer",
            "seller_place_id"=>"required|integer",

        ]);
        if ($v->fails()){
            return response()->json(["state"=>false,"error"=>$v->errors()]);
        }
        else{


            $rating = Rating::where("seller_place_id",$request->seller_place_id)->first();

            if ($rating){
                $user=User::find(auth()->user()->id);

                if($user->rating($rating->id)->count()!=0){
                    return response()->json(["state"=>true,"msg"=>"تم تسجيل تقيمك مسبقا لهذا المكان شكرا !"]);
                }
                else{


                    $last_rating = $rating->rating;
                    $new_rating = $last_rating + $request->rating;
                    $rating->rating = $new_rating;
                    $new_count_users = $rating->number_users + 1;
                    $rating->number_users = $new_count_users;
                    $rating->save();
                    Users_rating::create([
                        "user_id" => auth()->user()->id,
                        "rating_id" => $rating->id
                    ]);
                    return response()->json(["state" => true, "msg" => "شكرا لتقيمك لنا"]);
                }}


            else{
                $seller=seller_place::find($request->seller_place_id);
                if($seller){

                    $rating=Rating::create(["number_users"=>"1","rating"=>$request->rating,"seller_place_id"=>$request->seller_place_id]);
                    Users_rating::create([
                        "user_id"=>auth()->user()->id,
                        "rating_id"=>$rating->id
                    ]);
                    return response()->json(["state" => true, "msg" => "شكرا لتقيمك لنا"]);

                }
                else{return response()->json(["state"=>true,"msg"=>"this id seller not fount sorry"]);}

            }


        }

    }
}
