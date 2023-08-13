<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

use App\Models\Files;
use App\Models\Seller\Seller as Theseller;
use App\Models\Seller\seller_product;
use App\Models\Seller\sub_category_seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    public function delete_sub_category($id_sub_category){
        $cat=sub_category_seller::findorfail($id_sub_category);
        $seller=Theseller::find(Auth::guard("seller_owner")->id());

        if ($cat->seller_id==$seller->id){
            $cat->delete();
            toastr()->success("Done");
            return redirect()->back();
        }else return redirect()->back();
    }
    public function store_product(Request $request){
        $v=Validator::make($request->all(),[

            "title"=>"required|string",
            "description"=>"required|string",
            "price"=>"required|integer",
            "price_ex"=>"required|string",
            "count_ex"=>"required|integer",
            "file"=>"required|image"

        ]);
        if ($v->fails()){
            toastr()->error('خطا في المعلومات المدخلة');
            return redirect()->back();
        }
        $seller=Theseller::find(Auth::guard("seller_owner")->id());
        if($seller->place==null){
            toastr()->error('الرجاء اضافة مشروع خاص بك لاضافة منتجات');
            return redirect()->route("index_seller");

        }

        if($seller->place->state=="1"||$seller->place->state=="0"){

            $product=seller_product::create(
                [
                    "title"=>$request->title,
                    "description"=>$request->description,
                    "sub_category_seller"=>$request->sub_category_seller,
                    "price"=>$request->price,
                    "name_ex"=>$request->price_ex,
                    "count_ex"=>$request->count_ex,
                    'ex_price'=>"لكل"." ".$request->count_ex ." ". $request->price_ex,
                    "seller_id"=>Auth::guard("seller_owner")->id(),
                    "seller_place_id"=>Theseller::find(Auth::guard("seller_owner")->id())->place->id

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
        else{
            toastr()->warning('لايمكنك الاضافة حتى يتم قبل المشروع الخاص بك');
            return redirect()->route("index_seller");
        }





    }
    public function show_my_products(){
        $seller=Theseller::find(Auth::guard("seller_owner")->id());
        if($seller->place!=null){
        return view("seller.view_my_products",compact('seller'));}
        else{
            toastr()->warning("الرجاء اضافة المحل التجاري");
            return redirect()->back();}

    }
    public function delete_my_products($id_product){

        $id_seller=Auth::guard("seller_owner")->id();
        $product=seller_product::findorfail($id_product);
        if($product->seller_id==$id_seller){
            //File::delete(public_path("/all_files/".$product->img->url));
            $product->delete();
            toastr()->warning("تم الحذف");
            return redirect()->back();}
        else{
            toastr()->error("Error");
            return redirect()->back();}

    }
    public function add_sub_category(Request $request){

        $id_seller=Auth::guard("seller_owner")->id();
        $seller=Theseller::find($id_seller);
        if($seller->place==null){
            toastr()->error('الرجاء اضافة مشروع خاص بك لاضافة منتجات');
            return redirect()->route("index_seller");

        }



        $v=Validator::make($request->all(),[
            "title"=>"required|string",
        ]);
        if ($v->fails()){
            toastr()->error('خطا في المعلومات المدخلة');
            return redirect()->back();
        }
        else{

            sub_category_seller::create([
                "title"=>$request->title,
                "seller_id"=>$id_seller,
                "seller_place_id"=>$seller->place->id,
            ]);

        }
        toastr()->success("YES");
        return redirect()->back();
    }
}
