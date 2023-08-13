<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;

use App\Models\Files;
use App\Models\Owner\Owner;
use App\Models\Owner\Place;

use App\Models\the_period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{

    public function index(){
        $owner_pace=Owner::find(Auth::guard("owner")->id())->owner_place;
        $ids=[];
        if($owner_pace!=null&&$owner_pace->the_periods!=null&&$owner_pace->the_periods->count()>0){
        foreach ($owner_pace->the_periods as $pool_period){
            array_push($ids,$pool_period->id);
        }
        }
        $remain_periods=the_period::wherenotin("id",$ids)->get();




        return view("owner.index",compact('owner_pace',"remain_periods"));
    }
    public function view_add_product(){
        if(Owner::find(Auth::guard("owner")->id())->owner_place){
            toastr()->warning("لايمكنك اضافة اكثر من مشروع");

            return redirect()->route("owner_index");
        }
        else{

        $periods=the_period::all();
        return view("owner.add_place",compact("periods"));}
    }

    public function store_product(Request $request){
        $all_request=$request->all();
        $v=Validator::make($all_request,[
            "files"=>"required",
            "title"=>"required|string",
            "description"=>"required|string",
            "my_period"=>"required",
            "my_price"=>"required",
            "region_id"=>"required|integer",
            "area_id"=>"required|integer",
        ]);
        if ($v->fails()){
            return response()->json(["state"=>false,"msg"=>$v->errors()]);
        }
        if(count($request->my_period)!=count($request->my_price)){
            return response()->json(["state"=>false,"msg"=>"خطا في ادخال الفترات"]);
        }

        $owner=Owner::find(Auth::guard("owner")->id());

        if($owner->owner_place==null){
            $cat=Category::where("hashcode","$request->category")->first();
        $place=Place::create(
            ["title"=>$request->title,
                "description"=>$request->description,
                "region_id"=>$request->region_id,
                "area_id"=>$request->area_id,
                "category_id"=>$owner->category_id,

                "owner_id"=>$owner->id]);
       foreach ($request->my_period as $x=>$period){
           DB::table("the_period_pools")->insert([
               "price"=>$request->my_price[$x],
               "the_period_id"=>$period,
               "place_id"=>$place->id
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
            }}}

        return response()->json(["state"=>true,"msg"=>"YOUR APPLICATION SEND"]);
    }
}
