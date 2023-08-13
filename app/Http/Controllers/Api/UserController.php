<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\orders\pool_orders as pool_orders_res;
use App\Http\Resources\orders\seller_orders as seller_orders_res ;
use App\Http\Resources\user_information;
use App\Models\Files;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function get_my_seller_orders(){
        $user=User::find(auth()->user()->id);
        $seller_orders=$user->seller_orders;
        return response()->json(["state"=>true,"data"=>seller_orders_res::collection($seller_orders)]);
    }
    public function get_my_pool_orders(){
        $user=User::find(auth()->user()->id);
        $pool_orders=$user->pool_orders;
        return response()->json(["state"=>true,"data"=>pool_orders_res::collection($pool_orders)]);
    }
    public function get_my_information(){

        $user=User::find(auth("user_api")->user()->id);

        return response()->json(["state"=>true,"data"=>new user_information ($user)]);
    }
    public function edit_user_information(Request $request){
        if (!isset($request->image)&&!isset($request->password)&&!isset($request->phone)&&!isset($request->email)&&!isset($request->name)){
            return response()->json(["state"=>false,"msg"=>"الرجاء تعديل قيمة واحدة على الاقل!"]);
        }

//        $v=Validator::make($request->all(),[
//            "email"=>"required|email|unique:users,email",
//            "phone"=>"required|string",
//
//            "name"=>"required|string"
//        ]);
//        if ($v->fails()){
//            return response()->json(["state"=>false,"msg"=>$v->errors()]);
//        }

            $user=User::find(auth()->user()->id);

            if (isset($request->image)){

                if($user->image!=null){
                    $user->image->delete();
                }
                $v2=Validator::make($request->all(),[
                    "image"=>"image|required",
                ]);
                if ($v2->fails()){
                    return response()->json(["state"=>false,"msg"=>$v2->errors()]);

                }
                $file=$request->file("image");
                $file_ex=$file->extension();
                $fileOriginalName=$file->getClientOriginalName();
                $un_file_name=uniqid().".".$file_ex;
                $un_file_name2=uniqid();
                $file->storeAs("/all_files",$un_file_name2.$un_file_name);

                Files::create([
                    "url"=>$un_file_name2.$un_file_name,
                    "client_name"=>$fileOriginalName,
                    "fileable_id"=>auth()->user()->id,
                    "fileable_type"=>"App\Models\User"
                ]);


            }
            if(isset($request->email)){
            $email_v=Validator::make($request->all(),[
            "email"=>"required|email|unique:users,email",
            ]);
              if ($email_v->fails()){
            return response()->json(["state"=>false,"msg"=>$email_v->errors()]);
              }

                $user->email=$request->email;}



            if(isset($request->phone)){$user->phone=$request->phone;}
           if(isset($request->name)){$user->name=$request->name;}

            if (isset($request->password)){
                $user->password=Hash::make($request->password);
            }



            $user->save();

            return response()->json(["state"=>true,"msg"=>"تم تعديل المعلومات "]);
        }



}
