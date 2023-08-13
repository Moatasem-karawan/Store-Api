<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Whats_app_msg;
use App\Models\FQA;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
   public function view_index(){
       $categorys=Category::all();
       $msgs=Whats_app_msg::where("state","0")->get();

       return view("admin.index",compact('categorys','msgs'));
   }
    public function fqa(){
       $fqa=FQA::all();
        return view("admin.FQA.list_questions",compact('fqa'));
    }
    public function store_fqa(Request $request){
       FQA::create([
           "question"=>$request->question,
           "answer"=>$request->answer,
       ]);

       return redirect()->back();

    }


}
