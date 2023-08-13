<?php

namespace App\Models\Seller;


use App\Models\Admin\Category;
use App\Models\Days;
use App\Models\Files;

use App\Models\Gaza\Area;
use App\Models\Gaza\Region;
use App\Models\Rating;
use App\Models\Saveby_user_seller_place;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="seller_place";

    public function products_seller(){
        return $this->hasMany(seller_product::class,"seller_place_id");
    }



    public function sub_category_seller(){
        return $this->hasMany(sub_category_seller::class,"seller_place_id");
    }
    public function category_seller(){
        return $this->belongsTo(Category::class,"category_id");
    }



    public function img(){
        return $this->morphOne(Files::class, 'fileable');
    }


    public function seller_man(){
        return $this->belongsTo(Seller::class,"seller_id");
    }
    public function days(){
        return $this->belongsToMany(Days::class,"the_seller_days","seller_place_id","day_id");
    }
    public function product_offers(){
        return $this->hasMany(Seller_offers::class,"seller_place_id");
    }
    public function orders(){
        return $this->hasMany(Order_seller::class,"seller_place_id");
    }

    public function is_person_save_this_place(){
        return $this->hasOne(Saveby_user_seller_place::class,"seller_place_id")->where("user_id","=",auth()->user()->id);
    }

    public function rating(){
        return $this->hasOne(Rating::class, 'seller_place_id');
    }
    public function region(){
        return $this->belongsTo(Region::class, 'region_id');
    }
    public function area(){
        return $this->belongsTo(Area::class, 'area_id');
    }
}
