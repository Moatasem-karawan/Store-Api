<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller\Order_seller;
use App\Models\Seller\Place as seller_place;
use App\Models\Seller\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Orders_sellerController extends Controller
{
    public function order_done($id_order){
        $order=Order_seller::findorfail($id_order);

        $id_seller=Auth::guard("seller_owner")->id();
        $seller=Seller::find($id_seller);


        if($seller->place!=null&&$seller->place->id==$order->seller_place_id){
            $order->state_order="1";
            $order->save();
            toastr()->success("نجاح");
            return redirect()->back();
        }
        else {toastr()->error("خطا داخلي");
        return redirect()->back();}
    }

    public function order_backed_off($id_order){
        $order=Order_seller::findorfail($id_order);

        $id_seller=Auth::guard("seller_owner")->id();
        $seller=Seller::find($id_seller);


        if($seller->place!=null&&$seller->place->id==$order->seller_place_id){
            $order->state_order="0";
            $order->save();
            toastr()->warning("تراجع");
            return redirect()->back();
        }
        else {toastr()->error("خطا داخلي");
            return redirect()->back();}
    }
}
