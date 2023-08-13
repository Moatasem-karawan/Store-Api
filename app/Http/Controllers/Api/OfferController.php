<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Offers\get_pool_place_of_offers as get_pool_place_of_offers_res;
use App\Http\Resources\Offers\get_sellers_place_offers;
use App\Http\Resources\Offers\Pooloffers as Pooloffers_res;
use App\Http\Resources\Offers\seller_place_offer;
use App\Models\Owner\offer_for_pool as Pooloffers_model;
use App\Models\Owner\Place as pool_place;
use App\Models\Seller\Place as seller_place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{

    public function get_pool_place_of_offers(){

        $all_pool_offers_ids =DB::table('offer_pool')->select('pool_place_id')->distinct()->get();
        $ids=[];
        foreach ($all_pool_offers_ids as $id_pool_offer){
            array_push($ids, $id_pool_offer->pool_place_id);
        }
        $pools=pool_place::find($ids);




        return response()->json(["state"=>true,"offers"=>get_pool_place_of_offers_res::collection($pools)]);
    }
    public function show_pool_place_of_offer($id_of_pool){

        $pool=pool_place::find($id_of_pool);
        return response()->json(["state"=>true,"place_information"=>new Pooloffers_res($pool)]);
    }

    /********************seller offers**********/
    public function get_seller_place_of_offers(){

        $all_sellers_offers_ids =DB::table('offer_seller')->select('seller_place_id')->distinct()->get();
        $ids=[];
        foreach ($all_sellers_offers_ids as $id_seller_offer){
            array_push($ids, $id_seller_offer->seller_place_id);
        }
        $sellers=seller_place::find($ids);




        return response()->json(["state"=>true,"offers"=>get_sellers_place_offers::collection($sellers)]);
    }
    /********************seller offers**********/
    public function show_seller_place_of_offer($id_of_seller){

        $seller=seller_place::find($id_of_seller);
        return response()->json(["state"=>true,"place_information"=>new seller_place_offer($seller)]);
    }
}
