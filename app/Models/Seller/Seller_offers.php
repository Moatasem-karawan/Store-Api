<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller_offers extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="offer_seller";
    public function product(){
        return $this->belongsTo(seller_product::class,"product_seller_place_id");
    }
}
