<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class information_all_pool_place extends JsonResource
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


        $temp=0;
        $temp2=0;


        if ($this->rating!=null){
            $temp2=$this->rating->rating/$this->rating->number_users;
            $temp=floor($temp2);
        }
        return [
            "id"=>$this->id,
            "title"=>$this->title,
            "description"=>$this->description,
            "country"=>"Palestine-Gaza",
            'rating'=>$temp,
            "percent"=>$temp2,
           // "hashcode"=>$this->category->hashcode,

            "owner_by"=>$this->owner->name,
            "is_saved"=>$is_saved,

            "files"=>files::collection($this->files),
        ];
    }
}
