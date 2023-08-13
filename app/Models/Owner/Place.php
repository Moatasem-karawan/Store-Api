<?php

namespace App\Models\Owner;

use App\Models\Admin\Category;
use App\Models\Admin\codes\Pool_code;
use App\Models\Files;

use App\Models\Pivot_periods_pool;
use App\Models\Rating;
use App\Models\Saveby_user_pool_place;
use App\Models\the_period;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="pool_place";
    public function files()
    {
        return $this->morphMany(Files::class, 'fileable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }


    public function the_periods()
    {
        return $this->belongsToMany(the_period::class,"the_period_pools")->withPivot("place_id","the_period_id","price");

    }
    public function reservation()
    {
        return $this->hasMany(Pool_orders::class,"pool_place_id");

    }
    public function offer_codes()
    {
        return $this->hasMany(Pool_code::class,"pool_place_id");

    }
    public function offer_periods()
    {
        return $this->hasMany(offer_for_pool::class,"pool_place_id");

    }
    public function rating(){
        return $this->hasOne(Rating::class, 'pool_place_id');
    }
    public function is_person_save_this_place(){
        return $this->hasOne(Saveby_user_pool_place::class,"pool_place_id")->where("user_id","=",auth()->user()->id);
    }




}
