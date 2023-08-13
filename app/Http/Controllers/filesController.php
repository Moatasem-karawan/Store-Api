<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class filesController extends Controller
{
    public function upload_files_from_owner(Request $request){

        $v=Validator::make($request->all(),[
            "avatar"=>"required|image"
        ]);
        if (!$v->fails()){



            $file=$request->file("avatar");
            $file_ex=$file->extension();
            $fileOriginalName=$file->getClientOriginalName();
            $un_file_name=uniqid().".".$file_ex;
            $file->storeAs("/all_files","$un_file_name");


            return $un_file_name."*".$fileOriginalName;}
        else {dd("stop");}
    }
}
