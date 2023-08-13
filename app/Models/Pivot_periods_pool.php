<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pivot_periods_pool extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="the_period_pools";
    public function the_period(){
        return $this->belongsTo(the_period::class,"the_period_id");
    }
}
