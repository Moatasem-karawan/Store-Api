<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\user_information;
use App\Models\Seller\Seller as seller_model;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
{
    $this->middleware('auth:user_api', ['except' => ['login',"register","active_user_while_register"]]);
}
    public function login(Request $request)
    {
        $guard= strtolower($request->guard);
        $v=Validator::make($request->all(),[
            "guard"=>"required|string",

        ]);
        if($v->fails()){
            return response()->json(['states'=>false,'msg' => 'الرجاء تحديد صفة الدخول تاجر ام مستخدم']);
        }
        else{
        if ($guard=="user"){

            $v=Validator::make($request->all(),[

                "email"=>"required|email",
                "password"=>"required"
            ]);
            if($v->fails()){
                return response()->json(['states'=>false,'msg' => 'Lack Information',"error"=>$v->errors()]);
            }
            $credentials = request(['email', 'password']);

            if (! $token = auth("user_api")->attempt($credentials)) {
                return response()->json(['states'=>false,'error' =>  'خطا في كلمة السر او الايميل المستخدم']);
            }

            return $this->respondWithToken($token,"تم تسجيل الدخول بصفة مستخدم");

        }
       elseif($guard=="seller"){

           $v=Validator::make($request->all(),[

               "email"=>"required|email",
                "password"=>"required"
           ]);
           if($v->fails()){
               return response()->json(['states'=>false,'msg' => 'Lack Information',"error"=>$v->errors()]);
           }
           $credentials = request(['email', 'password']);

           if (! $token = auth("seller_api")->attempt($credentials)) {
               return response()->json(['states'=>false,'error' => 'خطا في كلمة السر او الايميل التاجر']);
           }

           return $this->respondWithToken($token,"تم تسجيل الدخول بصفة تاجر");
       }

        elseif($guard=="owner"){

            $v=Validator::make($request->all(),[
                "email"=>"required|email",
                "password"=>"required"
            ]);
            if($v->fails()){
                return response()->json(['states'=>false,'msg' => 'Lack Information',"error"=>$v->errors()]);
            }
            $credentials = request(['email', 'password']);

            if (! $token = auth("owner_api")->attempt($credentials)) {
                return response()->json(['states'=>false,'error' => 'خطا في كلمة السر او الايميل صاحب الشالية']);
            }

            return $this->respondWithToken($token,"تم تسجيل الدخول بصفة صاحب شالية");

    }else{return response()->json(['states'=>false,'msg' => 'INTERNAL ERROR']);}

    }}
    public function register(Request $request)
    {
        $all_request=$request->all();
        $guard= strtolower($request->guard);
        $v=Validator::make($all_request,[
            "guard"=>"required|string",

        ]);
        if($v->fails()){
            return response()->json(['states'=>false,'msg' => 'الرجاء تحديد صفتك تاجر ام مستخدم او صاحب شالية']);
        }
        else{
            if ($guard=="user"){

                $v = Validator::make($all_request, [
                    "name"=>"required",
                    "phone"=>"required|integer",
                    "email" =>"required|email|unique:users,email",
                    "password" =>"required",
                    "favourites"=>"required|array",
                    "favourites.*"=>"required|min:1|distinct|integer|between:1,3",
                ]);
                if ($v->fails()) {
                    return response()->json(["states"=>false,"error"=>$v->errors()]);

                }


                $user = User::create([
                    'name'=>$request->name,
                    "phone"=>$request->phone,
                    'email'=>$request->email,
                    "re_password"=>$request->password,
                    'password'=>Hash::make($request->password),
                    "active_user"=>"0",
                ]);
                $rand1=rand(100,200);
                $rand2=rand(200,300);
                $the_code=$rand1.$user->id.$rand2;
                $user->active_code=$the_code;
                $user->save();
                $user->user_favourites()->attach($request->favourites);

                $token=auth("user_api")->login($user);

                return $this->respondWithToken($token,"تم تسجيل الحساب بنجاح صفة الدخول مستخدم");


                // Mail::to($user)->send(new \App\Mail\testMail("$the_code"));


                //return  response()->json(['state'=>true,'msg' => 'تم ارسال كود تفعيل الحساب الى الايميل الخاص بك',"user_information"=>new user_information($user)]);

            }
            elseif ($guard=="seller"){
                $v2=Validator::make($all_request,[
                    "name"=>"required",
                    "email"=>"required|email|unique:seller,email",
                    "password"=>"required|min:6",
                    "category_id"=>"required|integer|between:1,5"
                ]);
                if ($v2->fails()){

                    return response()->json(["states"=>false,"errors"=>$v2->errors()]);
                }

                $seller=seller_model::create([


                    "name"=>$request->name,
                    "email"=>$request->email,
                    "phone"=>$request->phone,
                    "password"=>Hash::make("$request->password"),
                    "re_password"=>$request->password,
                    "category_id"=>$request->category_id
                ]);
                $token=auth("seller_api")->login($seller);
                return $this->respondWithToken($token,"تم تسجيل الحساب بنجاح صفة الدخول تاجر");
            }
            elseif($guard=="owner"){

            }else{ return response()->json(["states"=>false,"msg"=>"تم تحديد صفة تسجيل خطا"]);}
        }



    }
    public function me()
    {

        return response()->json(auth()->user());
    }

    protected function respondWithToken($token,$message)
    {
        return response()->json([
            "states"=>true,
            'access_token' => $token,
            "message"=>$message,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);}

    public function logout()
    {
        auth()->logout();

        return response()->json([ "states"=>true,'message' => 'Successfully logged out']);
    }
    public function active_user_while_register(Request $request){

       $v=Validator::make($request->all(),[
           "code"=>"required",
           "email"=>"required|email",
       ]);
       if ($v->fails()){

           return response()->json(["state"=>false,"msg"=>"نقص في المعلومات المطلوبة"]);
       }
       else{
        $code=$request->code;
        $user=User::where("email","=",$request->email)->where("active_code","=",$code)->first();
        if (!$user){
            return response()->json(["state"=>false,"msg"=>"خطا في كود التفعيل"]);}
        else if($user->active_user=="1"){return response()->json(["state"=>false,"msg"=>"هذا الحساب مفعل "]);}
        else if ($user->active_user=="0"){
            $user->active_user="1";
            $user->save();
            if (! $token = auth()->login($user)) {
                return response()->json(['states'=>false,'error' => 'Error 404' ]);
            }
            else{

            return $this->respondWithToken($token);}

//            return response()->json(["state"=>false,"msg"=>"تم تفعيل الحساب بنجاح"]);
        }
       else{return response()->json(["state"=>false,"msg"=>"خطا داخلي"]);}

       }
    }
}
