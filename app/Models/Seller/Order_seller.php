<?php

namespace App\Models\Seller;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_seller extends Model
{
    use HasFactory;
    protected $table="seller_orders";
    protected $guarded=[];
    public function product_seller(){
        return $this->belongsTo(seller_product::class, 'product_seller_place_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
