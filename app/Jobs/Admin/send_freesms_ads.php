<?php

namespace App\Jobs\Admin;

use App\Models\Notifications\History_sms;
use App\Models\Notifications\Phone_numbers;
use App\Models\Notifications\Phones_ads;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class send_freesms_ads implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public  $the_ads;
    public function __construct($ads)
    {
        $this->the_ads=$ads;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        $count_recivers=$this->the_ads->count_receivers;
        $msg=$this->the_ads->message_of_ads;

        for($i=0;$i< $count_recivers;$i++){
            $phone=Phone_numbers::where("states","=","up")->where("remain_messages","<","100")->first();
            $to=Phones_ads::orderBy('count_rec_msg', 'asc')->first();
            if ($this->the_ads->count_receivers < $this->the_ads->software_count_receivers && $phone && $to){
            $this->connection_to_jawwal($phone,$to,$msg);}
            elseif($this->the_ads->count_receivers == $this->the_ads->software_count_receivers){
                $this->the_ads->software_finish=="yes";
                $this->the_ads->save();
            }
            else{  $this->the_ads->software_finish=="error";
                   $this->the_ads->save();}
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
//            success
            $phone->remain_messages=$phone->remain_messages-1;
            $to->count_rec_msg=$to->count_rec_msg+1;
            $this->the_ads->software_count_receivers=$this->the_ads->software_count_receivers+1;

            $phone->save();
            $to->save();
            $this->the_ads->software_count_receivers->save();

            $history_sms=History_sms::create([
                "body_of_api"=>$response->body(),
                "message"=>$message,
                "destinations"=>$to,
                "states_of_sms"=>"failed",

                "phones_number_id"=>$phone->id, //  used _number_for send
            ]);



        }else{
//            falid

            try{
                $history_sms=History_sms::create([
                    "body_of_api"=>$response->body(),
                    "message"=>$message,
                    "destinations"=>$to,
                    "states_of_sms"=>"failed",

                    "phones_number_id"=>$phone->id, //  used _number_for send
                ]);

            }catch (\Exception $e){
                $history_sms=History_sms::create([
                    "body_of_api"=>$response->body(),
                    "message"=>$message,
                    "destinations"=>$to,
                    "states_of_sms"=>"failed",

                    "phones_number_id"=>$phone->id, //  used _number_for send
                ]);
            }





        }
    }
}
