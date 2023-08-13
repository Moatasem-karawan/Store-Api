<?php

namespace App\Http\Livewire\admin;

use App\Models\Notifications\Phone_numbers;
use Livewire\Component;

class notifications extends Component
{
    /**update**/
    public $phone,$device_id,$phone_token,$count_msg;
    public $states;

    public $update_mode=false;
    public $id_phone_for_update=null;
    /**end update**/

     /**add new**/

    public $phone_new,$device_id_new,$phone_token_new,$count_msg_new;
    public $states_new;
     /**end new**/



    public function render()
    {
        return view('livewire.admin.notifications',[
            "phones"=>Phone_numbers::all(),
        ]);
    }
    public function store_phone(){


            $phone=Phone_numbers::create([
                "phone"=>$this->phone,
                "device_id"=>$this->device_id,
                "token"=>$this->phone_token,
                "states"=>$this->states,
                "remain_messages"=>$this->count_msg,

            ]);


        $this->phone_token=$this->device_id=$this->phone=$this->count_msg=null;






        }
        public function show_phone_number_information($id_phone){
            $this->update_mode=true;
            $this->id_phone_for_update=$id_phone;

            $phone=Phone_numbers::find($id_phone);
            $this->phone=$phone->phone;
            $this->device_id=$phone->device_id;
            $this->phone_token=$phone->token;
            $this->states=$phone->states;
            $this->count_msg=$phone->remain_messages;



        }
        public function save_update_information(){
            $phone=Phone_numbers::find($this->id_phone_for_update);
            $phone->phone =$this->phone;
            $phone->device_id=$this->device_id;
            $phone->token=$this->phone_token;
            $phone->states=$this->states;
            $phone->remain_messages=$this->count_msg;
            $phone->save();
            $this->phone_token=$this->device_id=$this->phone=$this->count_msg=$this->id_phone_for_update=null;

            $this->update_mode=false;
        }

    public function delete_free_number($id){

        $phone=Phone_numbers::find($id);
        $phone->delete();



    }
}
