<?php

namespace App\Models\Admin;


use App\Models\Admin\codes\Pool_code;
use App\Models\Admin\codes\Seller_code;
use App\Models\Files;
use App\Models\Seller\Place as seller_place;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='categories';
    public function active_seller_place(){
        return $this->hasMany(seller_place::class,"category_id")->where("state","1");
    }
    public function seller_place(){
        return $this->hasMany(seller_place::class,"category_id");
    }

    public function seller_codes(){
        return $this->hasMany(Seller_code::class,"category_id");
    }
    public function pool_codes(){
        return $this->hasMany(Pool_code::class,"category_id");
    }
//
//    public function not_active_product(){
//        return $this->hasMany(Product::class,"category_id")->where("state","0");
//    }
//    public function expire_product(){
//        return $this->hasMany(Product::class,"category_id")->where("state","2");
//    }
    public function files()
    {
        return $this->morphOne(Files::class, 'fileable');
    }
}
