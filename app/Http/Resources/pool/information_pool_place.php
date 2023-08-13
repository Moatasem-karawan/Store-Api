<?php

namespace App\Http\Resources\pool;

use App\Http\Resources\files;
use App\Http\Resources\periods;
use Illuminate\Http\Resources\Json\JsonResource;

class information_pool_place extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $is_saved=0;

        try{ if (auth()->user()){
            if ($this->is_person_save_this_place){

                $is_saved=1;
            }
            else{$is_saved=0;}
        }
        else{
            $is_saved=0;}}catch (\Exception $E){
            $is_saved=0;

        }
        $temp1=0;
        $temp2=0;


        if ($this->rating!=null){
            $temp2=$this->rating->rating/$this->rating->number_users;
            $temp1=floor($temp2);
        }
        return [
            "id"=>$this->id,
            "title"=>$this->title,
            "description"=>$this->description,
            "country"=>"Palestine-Gaza",
            "owner_by"=>$this->owner->name,
            "available_periods"=>periods::collection($this->the_periods),
            'rating'=>$temp1,
            "percent"=>$temp2,
            "is_save"=>$is_saved,
            "files"=>files::collection($this->files),
        ];
    }
}
