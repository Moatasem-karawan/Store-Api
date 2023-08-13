<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyPoolController extends Controller
{
    public function new_period(Request $request){

        $owner_pace=Owner::find(Auth::guard("owner")->id())->owner_place;

            DB::table("the_period_pools")->insert([
                "price"=>$request->price_new_period,
                "the_period_id"=>$request->new_period,
                "place_id"=>$owner_pace->id
            ]);
            toastr()->success("Done");
            return redirect()->back();


    }
    public function delete_my_period($id_period){

        $owner_pace=Owner::find(Auth::guard("owner")->id())->owner_place;

        $owner_pace->the_periods->where("id",$id_period)->first()->pivot->delete();
        toastr()->success("Done");
        return redirect()->back();





    }
}
