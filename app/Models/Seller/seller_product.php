<?php

namespace App\Models\Seller;

use App\Models\Files;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seller_product extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="product_seller_place";
    public function img(){
        return $this->morphOne(Files::class, 'fileable');
    }
    public function place(){
        return $this->belongsTo(Place::class, 'seller_place_id');
    }
    public function sub_category(){
        return $this->belongsTo(sub_category_seller::class, 'sub_category_seller');
    }
    public function provide_by_seller_place(){
        return $this->belongsTo(Place::class, 'seller_place_id');
    }
    public function orders_product(){
        return $this->hasMany(Order_seller::class,"product_seller_place_id");
    }
    public function offer_product(){
        return $this->hasMany(Seller_offers::class,"product_seller_place_id");
    }
}
