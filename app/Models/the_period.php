<?php

namespace App\Models;

use App\Models\Owner\Owner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class the_period extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="the_period";
    public function pivot($id){
        return $this->hasOne(Pivot_periods_pool::class,"the_period_id")->where("place_id","=",$id);
    }
}
