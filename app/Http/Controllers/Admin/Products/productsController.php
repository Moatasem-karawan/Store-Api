<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;

use App\Models\Admin\Category;

use App\Models\Owner\Place as pool_place;
use App\Models\Seller\Place as seller_place;
use App\Models\Seller\seller_product;
use Illuminate\Http\Request;

class productsController extends Controller
{
    public function get_explorer_products($id_category){
//        $category=Category::find($id_category);
//        $products=Category::find($id_category)->active_product()->orderBy("explorer",'DESC')->get();
//        return view("admin.seller_product.list_them",compact('products','category'));
        dd("Asd");

    }
    public function pending_product_seller(){
        $seller_products=seller_product::where("state","0")->get();

       return view("admin.seller_product.list_them",compact('seller_products'));
    }

    public function accept_seller_order($id_seller_product){
        $product=seller_product::find($id_seller_product);
        $product->state="1";
        toastr()->success('تم قبول الطلب');
        $product->save();
        return redirect()->back();
    }




    public function show_seller_product($id_seller_place){
        $seller_place=seller_place::find($id_seller_place);
       // dd($seller_place->products_seller->toArray());
        return view("admin.seller_product.show_all_product_of_seller",compact('seller_place'));

    }



}

