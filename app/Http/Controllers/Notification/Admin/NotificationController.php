<?php

namespace App\Http\Controllers\Notification\Admin;

use App\Http\Controllers\Controller;

use App\Jobs\Admin\send_freesms_ads;
use App\Models\Admin\Category;
use App\Models\Notifications\Ads_sms_orders;
use App\Models\Notifications\History_sms;
use App\Models\Notifications\Phone_numbers;
use App\Models\Notifications\Phones_ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function accept_sms_ads_order($id_ads){

        $to=Phones_ads::orderBy('count_rec_msg','asc')->first();

        $ads=Ads_sms_orders::find($id_ads);


        $ads->states="accept";
        $ads->save();
        send_freesms_ads::dispatch($ads);

    }
    public function get_sms_ads(){
        $ads=Ads_sms_orders::all();
        return view("admin.Notifications.orders_sms_ads",compact('ads'));

    }
    public function index(){

        $phones=Phone_numbers::where("states","=","up")->get();
        return view("admin.Notifications.setting_sms",compact('phones'));
    }

    public function view_send_sms_notification(){

        $phones=Phone_numbers::where("states","=","up")->get();
        $phones_ads=Phones_ads::all();

        return view("admin.Notifications.send_sms_notification",compact('phones','phones_ads'));
    }

    public function store_free_number(Request $request){

        $Validate=Validator::make($request->all(),[
            "phone"=>"required|min:10|max:10",
            "device_id"=>"required",
            "count_msg"=>"required|integer",
            "token"=>"required",
            "states"=>"required|string"
        ]);
        if ($Validate->fails()){

            return redirect()->back();
        }else{
             $phone=Phone_numbers::create([
                 "phone"=>$request->phone,
                 "device_id"=>$request->device_id,
                 "states"=>$request->states,
                 "remain_messages"=>$request->count_msg,
                 "token"=>$request->token,
            ]);

             return redirect()->back();
        }

    }
    public function send_free_sms(Request $request){

        if (! $request->hasValidSignature()) {
           return "reject";
        }
        else{
        $Validate=Validator::make($request->all(),[

            "to"=>"required|min:10|max:10",
            "selected_number"=>"required|integer",
            "message"=>"required|string"
        ]);
        if ($Validate->fails()){


            toastr()->error("REJECT");

           return redirect()->back();
        }else{
            

            $phone=Phone_numbers::find($request->selected_number);
            $to=substr($request->to, 1);

            $message=$request->message;
            if ($phone && $phone->states=="up"){

            $event=$this->connection_to_jawwal($phone,$to,$message);
            if ($event==100){toastr()->success("Success");
                return redirect()->back();}
            else {return redirect()->back();}
            }
            else
            {toastr()->success("REJECT");
                return redirect()->back();}


        }

    }}

    public function accept_free_sms_ads(Request $request,$id_ads){

        $ads=Ads_sms_orders::findorfail($id_ads);
       if ($ads!="pending"){

               send_freesms_ads::dispatch($ads->count_receivers,$ads->message_of_ads);
       }
       else{
           toastr()->warning("reject");
           return redirect()->back();
       }

    }

public function store_new_random_number(Request $request){
        $accepted_numbers=0;
        if ($pos = strpos($request->new_random_numbers, "-")){
            $all_new_numbers=explode("-",$request->new_random_numbers);
            foreach ($all_new_numbers as $phone_number){
                $item=Phones_ads::create([
                    "phone"=>$phone_number,
                    "count_rec_msg"=>"0",

                ]);
            }
            return "fount";
        }else{
            $all_new_numbers=explode("-",$request->new_random_numbers);
            return "not fount";

        }


}

 public function connection_to_jawwal($phone,$to,$message){


     $response = Http::withHeaders([
         "Authorization"=>$phone->token,

         "Channel"=>"Website",
         "Content-Type"=>"application/json",
         "Lang"=>"AR",
         "Origin"=>"https://myaccount.jawwal.ps",
         "Referer"=>"https://myaccount.jawwal.ps/",
         "Sec-Fetch-Mode"=>"cors",
         "User-Agent"=>"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36",



     ])->post('https://hisabiapi.jawwal.ps/api/SmsFree/SendFreeSMS', [
         "Destmsisdn"=> $to,
         "MsgText"=> $message,
         "deviceId"=> $phone->device_id,
         "lang"=> "EN"
     ]);

     if(isset($response->body()["asxasx"])){


         dd($response->body()["asxasx"]);
     }else{

         try{
             $history_sms=History_sms::create([
                 "description"=>$response->body(),
                 "destinations"=>$to,
                 "states_of_sms"=>"failed",
                 "phones_number_id"=>$phone->id,
             ]);
             return "100";
         }catch (\Exception $e){
             $history_sms=History_sms::create([
                 "description"=>"حدث خطا اثناء ارسال الرسالة ولم يتم تسجيل الخطا",
                 "destinations"=>$to,
                 "states_of_sms"=>"failed",
                 "phones_number_id"=>$phone->id,
             ]);
             return "100";
         }





     }
 }

}
