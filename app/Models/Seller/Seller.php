<?php

namespace App\Models\Seller;

use App\Models\Admin\Category;
use App\Models\Notifications\Ads_sms_orders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Seller extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table="seller";
    protected $guarded=[];
    public function place(){
        return $this->hasOne(Place::class,"seller_id");
    }
    public function category(){
        return $this->belongsTo(Category::class,"category_id");
    }
    public function get_sms_ads_orders(){
        return $this->hasMany(Ads_sms_orders::class,"seller_id");
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
