<?php

namespace App\Models\Gaza;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $table="regions";
    protected $guarded=[];


    public function areas(){
        return $this->hasMany(Area::class,"region_id");
    }
}
