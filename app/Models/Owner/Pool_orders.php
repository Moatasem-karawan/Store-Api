<?php

namespace App\Models\Owner;

use App\Models\the_period;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool_orders extends Model
{
    use HasFactory;
    protected $table="pool_orders";
    protected $guarded=[];
    public function pool(){
        return $this->belongsTo(Place::class,"pool_place_id");
    }
    public function period(){
    return $this->belongsTo(the_period::class,"the_period_id");
}

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

}
