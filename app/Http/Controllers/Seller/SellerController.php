<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Days;
use App\Models\Files;
use App\Models\seller\Place;
use App\Models\Seller\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    public function index(){

        $seller=Seller::find(Auth::guard("seller_owner")->id());




        return view("seller.index",compact('seller'));
    }





    public function view_add_place(){
        $seller=Seller::find(Auth::guard("seller_owner")->id());
        if ($seller->place&&$seller->place->state=="1"){
            toastr()->success('لايمكنك اضافة اكثر من محل تجاري');

           return  redirect()->route("index_seller");
        }

        if ($seller->place&&$seller->place->state=="0"){
            toastr()->warning('تم تقديم طلب المشروع الخاص بك انتظر حتى تم قبوله');
            return redirect()->route("index_seller");
        }
        $days=Days::all();
        return view("seller.add_place",compact("days"));
    }




    public function store_place(Request $request){

        $v=Validator::make($request->all(),[
            "title"=>"required|string",
            "description"=>"required|string",
            "from"=>"required|integer",
            "to"=>"required|integer",
            "file"=>"required|image",
            "days"=>"required",
            "region_id"=>"required|integer",
            "area_id"=>"required|integer",


        ]);
        if ($v->fails()){
            return redirect()->back()->with(["errors"=>$v->errors()]);
        }

        if (!isset($request->_token)|| $seller=Seller::find(Auth::guard("seller_owner")->id())->place){
            return redirect()->route("index_seller");
        }


        $place=place::create(
            [
                "title_of_place"=>$request->title,
                "description_of_place"=>$request->description,
                "seller_id"=>Auth::guard("seller_owner")->id(),
                "state"=>"0",
                "time_work"=>"$request->from"."صباحا"."-"."$request->to"."مساء",
                "place_phone"=>"0599413265",
                "region_id"=>$request->region_id,
                "area_id"=>$request->area_id,
                "category_id"=>Seller::find(Auth::guard("seller_owner")->id())->category->id,

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

        return redirect()->route("index_seller");
    }
    public function change_state_place(Request $request){

        if ($request->state>="0"&&$request->state<="1"){
            $place=Seller::find(Auth::guard("seller_owner")->id())->place;
            $place->delivery_state=$request->state;
            $place->save();
        }

    }
    public function show_my_setting()
    {

        $seller=Seller::find(Auth::guard("seller_owner")->id());

        if (!$seller->place){
            toastr()->warning('الرجاء تسجيل مشروعك الخاص');
            return redirect()->route("index_seller");
        }
        $days=Days::all();
       return view("seller.settings",compact('seller',"days"));
    }


}
