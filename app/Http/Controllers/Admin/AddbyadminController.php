<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Days;
use App\Models\Files;
use App\Models\Owner\Owner;
use App\Models\Owner\Place as owner_place;

use App\Models\Seller\Place as seller_place;

use App\Models\Seller\Seller as the_seller;
use App\Models\Seller\seller_product;
use App\Models\Seller\sub_category_seller;
use App\Models\the_period;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AddbyadminController extends Controller
{


    public function add_sub_category(Request $request){




        $v=Validator::make($request->all(),[
            "title"=>"required|string",
            "seller_place_id"=>"required|integer"
        ]);
        if ($v->fails()){
            toastr()->error('خطا في المعلومات المدخلة');
            return redirect()->back();
        }
        else{
            $seller_place=seller_place::find($request->seller_place_id);

            sub_category_seller::create([
                "title"=>$request->title,
                "seller_id"=>$seller_place->seller_id ?? "201",
                "seller_place_id"=>$request->seller_place_id,
            ]);

        }
        toastr()->success("YES");
        return redirect()->back();
    }




    public function add_pool_view(){
        $periods=the_period::all();
        return view("admin.add_by_admin.add_pool",compact('periods'));
    }
    public function add_pool(Request $request){

        $all_request=$request->all();
      $v=Validator::make($all_request,[
          "files"=>"required",
          "title"=>"required|string",
          "description"=>"required|string",
          "name"=>"required|string",
          "phone"=>"required|integer",
          "my_period"=>"required",
          "my_price"=>"required",
      ]);
      if ($v->fails()){
          return response()->json(["state"=>false,"msg"=>$v->errors()]);
      }
        if(count($request->my_period)!=count($request->my_price)){
            return response()->json(["state"=>false,"msg"=>"خطا في ادخال الفترات"]);
        }
        /**unique**/

        $v1=Validator::make($all_request,[
            "email"=>"required|email|unique:owners,email",
        ]);
        if ($v1->fails()){

            return response()->json(["state"=>false,"msg"=>"11خطا في ادخال الفترات"]);
        }

        $v2=Validator::make($all_request,[
            "email"=>"required|email|unique:seller,email",
        ]);
        if ($v2->fails()){

            return response()->json(["state"=>false,"msg"=>"خطا في ادخال الفترات"]);
        }

        $v3=Validator::make($all_request,[
            "email"=>"required|email|unique:admins,email",
        ]);
        if ($v3->fails()){

            return response()->json(["state"=>false,"msg"=>"خطا في ادخال الفترات"]);
        }
        /**end unique**/






        $c_id=Category::where("hashcode","8000")->first();

        $owner=Owner::create([
            "name"=>$request->name,
            "phone"=>$request->phone,
            "email"=>$request->email,
            "password"=>Hash::make("123456"),
            "re_password"=>"123456",
            "category_id"=>$c_id->id,

        ]);
        $place=owner_place::create(
            ["title"=>$request->title,
                "description"=>$request->description,
                "state"=>"1",
                "category_id"=>$c_id->id,
                "owner_id"=>$owner->id]);
        foreach ($request->my_period as $x=>$period){
            DB::table("the_period_pools")->insert([
                "price"=>$request->my_price[$x],
                "the_period_id"=>$period,
                "place_id"=>$place->id,

            ]);
        }

        if (isset($request['files'])){
            foreach ($request['files']as $file){
                $names=explode("*",$file);
                Files::create([
                    "url"=>$names[0],
                    "client_name"=>$names[1],
                    "fileable_id"=>(int)$place->id,
                    "fileable_type"=>"App\Models\Owner\Place"
                ]);
            }}

        return response()->json(["state"=>true,"msg"=>"YOUR APPLICATION SEND"]);
    }
    public function add_seller_view(){
        $days=Days::all();
        $category=Category::whereNotIn("hashcode",["8000"])->get();
        return view("admin.add_by_admin.add_seller",compact("days",'category'));
    }
    public function store_seller_by_admin(Request $request){
        $all_request=$request->all();
        $v=Validator::make($all_request,[

            "title"=>"required|string",
            "description"=>"required|string",
            "name"=>"required|string",
            "category_id"=>"required|integer",
            "place_phone"=>"required",
            "from"=>"required|integer",
            "to"=>"required|integer",
            "days"=>"required",
            "file"=>"required|image"

        ]);
        if ($v->fails()){
            toastr()->error("خطا");
            return redirect()->back()->with(["errors"=>$v->errors()]);
        }
        $v1=Validator::make($all_request,[
            "email"=>"required|email|unique:owners,email",
        ]);
        if ($v1->fails()){

            return redirect()->back()->with(["errors"=>$v1->errors()]);
        }

        $v2=Validator::make($all_request,[
            "email"=>"required|email|unique:seller,email",
        ]);
        if ($v2->fails()){

            return redirect()->back()->with(["errors"=>$v2->errors()]);
        }

        $v3=Validator::make($all_request,[
            "email"=>"required|email|unique:admins,email",
        ]);
        if ($v3->fails()){

            return redirect()->back()->with(["errors"=>$v3->errors()]);
        }
        $c_id=$request->category_id;

        $s=the_seller::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make("123456"),
            "re_password"=>"123456",
            "category_id"=>$c_id
        ]);
        $place=seller_place::create(
            [
                "title_of_place"=>$request->title,
                "description_of_place"=>$request->description,
                "seller_id"=>$s->id,
                "state"=>"1",
                "time_work"=>"$request->from"."-"."$request->to",
                "place_phone"=>$request->place_phone,
                "category_id"=>$c_id


            ]);
        foreach ($request->days as $x=>$day){
            DB::table("the_seller_days")->insert([
                "seller_place_id"=>$place->id,
                "day_id"=>$day
            ]);
        }



        if (isset($request['file'])) {
            $file=$request->file("file");
            $file_ex=$file->extension();
            $fileOriginalName=$file->getClientOriginalName();
            $un_file_name=uniqid().".".$file_ex;
            $file->storeAs("/all_files","$un_file_name");

            Files::create([
                "url"=>$un_file_name,
                "client_name"=>$fileOriginalName,
                "fileable_id"=>(int)$place->id,
                "fileable_type"=>"App\Models\seller\place"
            ]);

        }
        toastr()->success("Done");
    return redirect()->back();}
    public function lest_seller_view(){
        $categorys=Category::whereNotIn("hashcode",["8000"])->get();
        return view("admin.add_by_admin.list_seller_place_foradd",compact("categorys"));
    }
    public function view_for_add_product($seller_place_id){
        $seller_place=seller_place::find($seller_place_id);

        return view("admin.add_by_admin.view_for_add_product",compact('seller_place_id','seller_place'));
    }
    public function store_product_by_admin(Request $request){

        $v=Validator::make($request->all(),[
           'sub_category'=>'required|integer',

            'price'=>'required',
            'description'=>'required',
            'title'=>'required',

            "ex_price"=>"required",
            "count_ex"=>"required",

            'file'=>'required',
        ]);
        if ($v->fails()){

            toastr()->error("خطا في المعلومات المعطاة");

            return redirect()->back();
        }
        $seller_place=seller_place::find($request->seller_place_id);

        $product=seller_product::create(
            [
                "title"=>$request->title,
                "description"=>$request->description,
                "price"=>$request->price,
                "seller_id"=>$seller_place->seller_man->id,
                "seller_place_id"=>$request->seller_place_id,
                "state"=>"1",
                "ex_price"=>"لكل".$request->count_ex.$request->ex_price,
                "name_ex"=>$request->ex_price,
                "count_ex"=>$request->count_ex,
                "sub_category_seller"=>$request->sub_category,

            ]);
        if (isset($request['file'])) {
            $file=$request->file("file");
            $file_ex=$file->extension();
            $fileOriginalName=$file->getClientOriginalName();
            $un_file_name=uniqid().".".$file_ex;
            $file->storeAs("/all_files","$un_file_name");
            Files::create([
                "url"=>$un_file_name,
                "client_name"=>$fileOriginalName,
                "fileable_id"=>(int)$product->id,
                "fileable_type"=>"App\Models\Seller\seller_product"
            ]);
        }
        toastr()->success("Add Done");
        return redirect()->back();
    }

}
