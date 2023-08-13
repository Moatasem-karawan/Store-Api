<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Category;
use App\Models\Owner\Place as pools_place;


class Get_ordersController extends Controller
{
   public function sellers_orders($today=null){
//
//       if($today=="today"){
//
//           $orders=seller_place::all();
//           return view("admin.show_orders.sellers_orders",compact('orders'));
//       }else{

           $category=Category::whereNotIn("hashcode",["8000"])->get();


           return view("admin.show_orders.sellers_orders",compact('category'));

   }


   public function pool_reservation(){
       $pools=pools_place::all();
       return view("admin.show_orders.pools_orders",compact('pools'));
   }

}
