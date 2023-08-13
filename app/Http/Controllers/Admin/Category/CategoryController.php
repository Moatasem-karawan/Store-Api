<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\get_pool_places;
use App\Http\Resources\Admin\get_seller_places;
use App\Models\Admin\Category;
use App\Models\Files;
use App\Models\Owner\Place as pool_place;
use App\Models\Seller\Place as seller_place;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view_of_all(){
        $categorys=Category::all();
        return view("admin.category.view_category",compact('categorys'));
    }
   public function store_category(Request $request){
        $category=Category::create(["title"=>$request->title,"description"=>$request->description,"explorer"=>"0"]);


       $files=$request->file("files");

       foreach ($files as $file){

           $file_ex=$file->extension();
           $fileOriginalName=$file->getClientOriginalName();
           $un_file_name=uniqid().".".$file_ex;

           $file->storeAs("/files",$un_file_name);

           Files::create([
               "url"=>$un_file_name,
               "client_name"=>$fileOriginalName,
               "fileable_id"=>(int)$category->id,
               "fileable_type"=>"App\Models\Admin\Category"
           ]);
       }


        return redirect()->back();

   }
   public function ajax_get_place_of_category(Request $request)
   {
       $category=Category::findorfail($request->id_category);

        if ($category->hashcode=="8000"){

           $data=pool_place::where("state","=","1")->get();


           return response()->json(["state"=>true,"data"=>get_pool_places::collection($data)]);

       }


       else if ($category->hashcode=="3000"){
           $data=seller_place::where("state","=","1")->where("category_id","=",$category->id)->get();


           return response()->json(["state"=>true,"data"=>get_seller_places::collection($data)]);

       }

       else if ($category->hashcode=="4000"){
           $data=seller_place::where("state","=","1")->where("category_id","=",$category->id)->get();


           return response()->json(["state"=>true,"data"=>get_seller_places::collection($data)]);

       }
       else if ($category->hashcode=="5000"){
           $data=seller_place::where("state","=","1")->where("category_id","=",$category->id)->get();

           return response()->json(["state"=>true,"data"=>get_seller_places::collection($data)]);

       }
       else if ($category->hashcode=="9000"){
           $data=seller_place::where("state","=","1")->where("category_id","=",$category->id)->get();

           return response()->json(["state"=>true,"data"=>get_seller_places::collection($data)]);

       }



       else{

           return response()->json(["state"=>false,"msg"=>"حدث خطا داخلي"]);
       }
   }

}
