<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Happy\Happy_owner;
use App\Models\Owner\Owner;
use App\Models\Seller\Seller as seller_model;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

class AuthController extends Controller
{

    public function view_login (){
//        $client = new Client(['base_uri' => 'http://httpbin.org/']);
//
//        $promises = [
//            'image' => $client->getAsync('/'),
//            'png'   => $client->getAsync('/'),
//            'jpeg'  => $client->getAsync('/'),
//            'webp'  => $client->getAsync('/image/wedbp')
//        ];
//
//        $responses = Promise\Utils::unwrap($promises);
//        dd($responses);


        return view('admin.login');
    }
    public function do_login(Request $request){

        $login_data=["email"=>$request->email,"password"=>$request->password];

        if(Auth::guard("admin")->attempt($login_data)){

            return redirect()->intended(RouteServiceProvider::HOME);


        }elseif(Auth::guard("owner")->attempt($login_data)){

            return redirect()->intended(RouteServiceProvider::owner);
        }
        elseif(Auth::guard("happy_owner")->attempt($login_data)){

            redirect()->intended(RouteServiceProvider::happy_seller);

        }
        elseif(Auth::guard("seller_owner")->attempt($login_data)){
            return redirect()->intended(RouteServiceProvider::seller);
        }

        else{
            toastr()->error("ERROR PASSWORD OR EMAIL");

            return redirect()->back();}


    }


    public function register(){
        $category=Category::all();
        if ($category->count()==0){
            return redirect()->back();
        }
        return view('admin.register',compact('category'));

    }


    public function do_register(Request $request){
        $all_request=$request->all();

        $v1=Validator::make($all_request,[
            "name"=>"required",
            "phone"=>"required",
            "email"=>"required|email|unique:owners,email",
            "password"=>"required|min:6",
            "category"=>"required|integer"
        ]);
        if ($v1->fails()){

            return redirect()->back()->with(["errors"=>$v1->errors()]);
        }

        $v2=Validator::make($all_request,[
            "name"=>"required",
            "email"=>"required|email|unique:seller,email",
            "password"=>"required|min:6",
            "category"=>"required|integer"
        ]);
        if ($v2->fails()){

            return redirect()->back()->with(["errors"=>$v2->errors()]);
        }
        $v3=Validator::make($all_request,[
            "name"=>"required",
            "email"=>"required|email|unique:admins,email",
            "password"=>"required|min:6",
            "category"=>"required|integer"
        ]);
        if ($v3->fails()){

            return redirect()->back()->with(["errors"=>$v3->errors()]);
        }

        if ($request->category=="7000"){
            toastr()->error("غير متوفر حاليا");
            return redirect()->back();
            //$c_id=Category::where("hashcode","$request->category")->first();

            /**Happy_owner::create([
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Hash::make("$request->password"),
                "category_id"=>$c_id->id
            ]);
            return redirect()->route("login");**/
        }
        /**new**/
        else if ($request->category=="3000"){
            $c_id=Category::where("hashcode","$request->category")->first();
            $user=seller_model::create([

                "name"=>$request->name,
                "email"=>$request->email,
                "phone"=>$request->phone,
                "password"=>Hash::make("$request->password"),
                "re_password"=>$request->password,
                "category_id"=>$c_id->id
            ]);
            Auth::guard("seller_owner")->login($user);

            return redirect()->route("login");
        }


        else if ($request->category=="4000"){
            $c_id=Category::where("hashcode","$request->category")->first();
            $user=seller_model::create([

                "name"=>$request->name,
                "email"=>$request->email,
                "phone"=>$request->phone,
                "password"=>Hash::make("$request->password"),
                "re_password"=>$request->password,
                "category_id"=>$c_id->id
            ]);
            Auth::guard("seller_owner")->login($user);

            return redirect()->route("login");
        }





        else if ($request->category=="5000"){



            $c_id=Category::where("hashcode","$request->category")->first();
            $user=seller_model::create([


                "name"=>$request->name,
                "email"=>$request->email,
                "phone"=>$request->phone,
                "password"=>Hash::make("$request->password"),
                "re_password"=>$request->password,
                "category_id"=>$c_id->id
            ]);
            Auth::guard("seller_owner")->login($user);

            return redirect()->route("login");
        }
        //**new*/





        else if ($request->category=="8000"){



            $c_id=Category::where("hashcode","$request->category")->first();
            $o=Owner::create([
                "name"=>$request->name,
                "email"=>$request->email,
                "phone"=>$request->phone,
                "password"=>Hash::make("$request->password"),
                "re_password"=>$request->password,
                "category_id"=>$c_id->id
            ]);

            if($o){
                Auth::guard("owner")->login($o);
                return redirect()->route("login");



            }else{

            return redirect()->route("login");}
        }







        else if ($request->category=="9000"){




            $c_id=Category::where("hashcode","$request->category")->first();
            $user=seller_model::create([


                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Hash::make("$request->password"),
                "re_password"=>$request->password,
                "category_id"=>$c_id->id
            ]);
            Auth::guard("seller_owner")->login($user);

            return redirect()->route("login");
        }





        else{

            return redirect()->back();
        }
    }
    public function logout(){
        if(Auth::guard("admin")->check()){
            Auth::guard("admin")->logout();
            return redirect()->route("login");
        }


        elseif(Auth::guard("owner")->check()){
            Auth::guard("owner")->logout();
            return redirect()->route("login");
        }

       elseif(Auth::guard("seller_owner")->check()){
           Auth::guard("seller_owner")->logout();
           return redirect()->route("login");
       }

           elseif(Auth::guard("happy_owner")->check()){
               Auth::guard("happy_owner")->logout();
               return redirect()->route("login");

           }
        else{ return redirect()->route("login");}

    }

}

