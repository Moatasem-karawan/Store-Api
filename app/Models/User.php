<?php

namespace App\Models;

use App\Models\Owner\Pool_orders;
use App\Models\Seller\Order_seller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

   public function seller_orders(){
       return $this->hasMany(Order_seller::class,"user_id");
   }
    public function pool_orders(){
        return $this->hasMany(Pool_orders::class,"user_id");
    }
    public function image(){
        return $this->morphOne(Files::class, 'fileable');
    }
    public function my_save_pool(){
        return $this->hasMany(Saveby_user_pool_place::class, 'user_id');
    }
    public function my_save_seller_place(){
        return $this->hasMany(Saveby_user_seller_place::class, 'user_id');
    }
    public function user_favourites(){

        return $this->belongsToMany(Favourites::class,"users_favourites")->withPivot("user_id","favourites_id");

    }


//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//        'phone'
//    ];
protected $guarded=[];
   public function rating($id_rating){
       return $this->hasOne(Users_rating::class,"user_id")->where("rating_id","=",$id_rating)->get();
   }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
