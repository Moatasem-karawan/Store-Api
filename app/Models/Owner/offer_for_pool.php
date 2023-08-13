<?php

namespace App\Models\Owner;

use App\Models\Pivot_periods_pool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offer_for_pool extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="offer_pool";
    public function pool(){
        return $this->belongsTo(Place::class,"pool_place_id");
    }
    public function period_pivot(){
        return $this->belongsTo(Pivot_periods_pool::class,"the_period_pool_id");
    }

}
