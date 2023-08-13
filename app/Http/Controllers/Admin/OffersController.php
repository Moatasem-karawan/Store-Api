<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Category;

use App\Models\Admin\codes\Pool_code;
use App\Models\Admin\codes\Seller_code;
use App\Models\Owner\offer_for_pool;
use App\Models\Owner\Place as pools_place;
use App\Models\Seller\Place as seller_place;
use App\Models\Seller\Seller_offers;
use App\Models\Seller\seller_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OffersController extends Controller
{
    public function view_the_pools_offers(){
        $the_pools_places=pools_place::all();


        return view("admin.add_by_admin.offers.all_pool_place_offers",compact('the_pools_places'));
    }



    public function add_temp_pools_offers($id_pool_place)
    {
        $the_pool_place = pools_place::find($id_pool_place);


        return view("admin.add_by_admin.offers.view_add_offer_pool", compact('the_pool_place'));
    }

        public function view_the_sellers_offers(){
        $the_sellers_places=seller_place::all();
        $all_cat=Category::whereNotIn("hashcode",["8000"])->get();


        return view("admin.add_by_admin.offers.all_seller_place_offers",compact('all_cat'));
    }
    public function view_add_offer_by_admin($id_seller_place){
        $the_sellers_place=seller_place::find($id_seller_place);


        return view("admin.add_by_admin.offers.view_add_offer_seller",compact('the_sellers_place','id_seller_place'));

    }
    public function ajax_get_product_price(Request $request){
        $product=seller_product::find($request->id_product);
        return response()->json(['state'=>true,"price"=>$product->price,"ex_price"=>$product->ex_price,"count_ex"=>$product->count_ex,"name_ex"=>$product->name_ex]);
    }

    public function ajax_get_period_price(Request $request){
        $last_price=pools_place::find($request->id_pool)->the_periods->where("id",$request->id_period)->first();

        return response()->json(['state'=>true,"price"=>$last_price->pivot->price]);
    }

    public function store_offer_by_admin(Request $request){
        $v=Validator::make($request->all(),[
            'product_id' => 'required|unique:offer_seller,product_seller_place_id',
            "new_price"=> 'required|integer',
        ]);
        if ($v->fails()){
            toastr()->error("هذا المنتج تم اضافة عروض سابقة له");
            return redirect()->back();
        }

        Seller_offers::create([
            "seller_place_id"=>$request->seller_place_id,
            "product_seller_place_id"=>$request->product_id,
            "new_price_product"=>$request->new_price,
            "name_ex"=>$request->name_ex,
            "count_ex"=>$request->count_ex,
            "ex_price"=>"لكل"." -".$request->count_ex."-".$request->name_ex,
            "state"=>"1",

        ]);
        toastr()->success("Done");
       return redirect()->back();

    }
    public function store_offer_pool_by_admin(Request $request){

        $v=Validator::make($request->all(),[
            'period_id' => 'required|integer',
            "new_price"=> 'required|integer',
        ]);
        if ($v->fails()){
            toastr()->error("خطا في المعلومات المدخلة");
            return redirect()->back();
        }
        offer_for_pool::create([
            "new_price"=>$request->new_price,
            "state"=>"1",
            "the_period_pool_id"=>$request->period_id,
            "pool_place_id"=>$request->pool_place_id,

        ]);
        toastr()->success("Done");
        return redirect()->back();
    }
    public function delete_seller_offer_by_admin($id_offer){
        Seller_offers::destroy($id_offer);
        toastr()->success("done");
        return redirect()->back();

    }
    public function delete_pool_offer_by_admin($id_offer){
        offer_for_pool::destroy($id_offer);
        toastr()->success("done");
        return redirect()->back();
    }
    public function code_offers_view(){

        $categorys=Category::all();

        return view('admin.add_by_admin.offers.view_all_offers_code',compact('categorys'));
    }
    public function store_code_offers(Request $request)
    {
      $v=Validator::make($request->all(),[
          'code'=>"required",
          'offer'=>'required',
          'category_id'=>'required',
          'places_id'=>'required'
      ]);
      if ($v->fails()){
          toastr()->error("Error");
          return redirect()->back();
      }

      else{


          $category=Category::findorfail($request->category_id);
          if ($category->hashcode=="8000"){


              $v2=Validator::make($request->all(),[
                  'code'=>"required|unique:pool_codes,code",
              ]);
              if ($v2->fails()){
                  toastr()->error("الكود موجود مسبقا");
                  return redirect()->back();
              }


              if ($request->places_id=="all"){
                  $request->places_id=null;
              }
              $code=Pool_code::create([
                  'code'=>"$request->code",
                  'offer'=>$request->offer,
                  "max_use"=>$request->max_use,
                  'category_id'=>$request->category_id,
                  'pool_place_id'=>$request->places_id
              ]);
              toastr()->success("success");
              return redirect()->back();
          }
          else{
              $v2=Validator::make($request->all(),[
                  'code'=>"required|unique:seller_codes,code",
              ]);
              if ($v2->fails()){
                  toastr()->error("الكود موجود مسبقا");
                  return redirect()->back();
              }

              if ($request->places_id=="all"){
                  $request->places_id=null;
              }
              $code=Seller_code::create([
                  'code'=>"$request->code",
                  'offer'=>$request->offer,
                  "max_use"=>$request->max_use,
                  'category_id'=>$request->category_id,
                  'seller_place_id'=>$request->places_id
              ]);
              toastr()->success("success");
              return redirect()->back();
          }

      }
    }

}
