<?php

namespace App\Models;

use App\Models\Seller\Place;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saveby_user_seller_place extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="saveby_user_seller_place";
    public function seller(){
        return $this->belongsTo(Place::class,"seller_place_id");
    }
}
