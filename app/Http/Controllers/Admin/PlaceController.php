<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Category;

use App\Models\Owner\Place as pool_place;
use App\Models\Seller\Place as seller_place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function seller_place_pending_place(){

        $cat=Category::wherenotin("hashcode",["8000"])->get();


        return view("admin.Place.pending_seller_place",compact("cat"));
    }
    public function pool_place_pending_place(){

        $pool_place=pool_place::where("state","=",'0')->get();

        return view("admin.Place.pending_pool_place",compact("pool_place"));
    }

    public function show_all_place_two_type($id_category){
        $category=Category::findorfail($id_category);




        if ($category->hashcode=="8000"){
            $pool_place=pool_place::all();


            return view("admin.Place.view_all_pool_place",compact("category","pool_place"));
        }



        else if ($category->hashcode=="9000"){

            $seller_place=seller_place::where("category_id","=",$category->id)->get();


            return view("admin.Place.view_all_seller_place",compact("category","seller_place"));
        }



        else if ($category->hashcode=="5000"){

            $seller_place=seller_place::where("category_id","=",$category->id)->get();;

            return view("admin.Place.view_all_seller_place",compact("category","seller_place"));
        }
        else if ($category->hashcode=="4000"){

            $seller_place=seller_place::where("category_id","=",$category->id)->get();;

            return view("admin.Place.view_all_seller_place",compact("category","seller_place"));
        }
        else if ($category->hashcode=="3000"){

            $seller_place=seller_place::where("category_id","=",$category->id)->get();;

            return view("admin.Place.view_all_seller_place",compact("category","seller_place"));
        }
        else{
            toastr()->error("جدث خطا داخلي");
            return redirect()->back();
        }



    }
    public function accept_seller_place($id_seller_place){
        $seller_place=seller_place::find($id_seller_place);
        $seller_place->state="1";
        $seller_place->save();
        toastr()->success("تم القبول");
        return redirect()->back();

    }
    public function sleep_seller_place($id_seller_place){
    $product=seller_place::find($id_seller_place);
    $product->state="2";
    toastr()->warning('تم تعليق الطلب ');
    $product->save();
    return redirect()->back();
}

    public function accept_pool_place($id_pool_place){
        $product=pool_place::find($id_pool_place);
        $product->state="1";
        toastr()->success('تم قبول الطلب');
        $product->save();
        return redirect()->back();
    }
    public function sleep_pool_place($id_pool_place){
        $product=pool_place::find($id_pool_place);
        $product->state="2";
        toastr()->warning('sleeping..');
        $product->save();
        return redirect()->back();
    }

    public function show_pool_files($id_pool_place){
        $product=pool_place::find($id_pool_place);
        return view("admin.Place.show_pool_files",compact('product'));

    }
    public function delete_seller_pace($id_seller_place){
       $place= seller_place::findorfail($id_seller_place);

        if($place->state=="2"){
            $place->delete();
            toastr()->success("Delete");
            return redirect()->back();
        }
        else{
            toastr()->error("Error");
            return redirect()->back();
        }
    }
    public function delete_pool_pace($id_pool_place){

        $place=pool_place::findorfail($id_pool_place);
        if($place->state=="2"){
            $place->delete();
            toastr()->success("Delete");
            return redirect()->back();
        }
        else{
            toastr()->error("Error");
            return redirect()->back();
        }

    }

}
