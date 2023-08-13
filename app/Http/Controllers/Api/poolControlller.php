<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\pool\information_pool_place;
use App\Models\Owner\Place as pool_place;
use Illuminate\Http\Request;

class poolControlller extends Controller
{
   public function show_pool_place_information($id_pool_place){
       $pool_place=pool_place::find($id_pool_place);
       return response()->json(["state"=>true,"data"=>new information_pool_place($pool_place)]);
   }
}
