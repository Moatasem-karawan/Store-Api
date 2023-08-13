<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class files extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "url"=>url("public/all_files/".$this->url),
        ];
    }
}
