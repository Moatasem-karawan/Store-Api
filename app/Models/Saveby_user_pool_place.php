<?php

namespace App\Models;

use App\Models\Owner\Place;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saveby_user_pool_place extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="saveby_user_pool_place";
    public function pool(){
        return $this->belongsTo(Place::class,"pool_place_id");
    }
}
