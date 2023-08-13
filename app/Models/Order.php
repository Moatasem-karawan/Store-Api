<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table="orders";
    protected $guarded=[];
//    public function period(){
//        return $this->belongsTo(Period::class, 'period_id');
//    }

    public function img(){
        return $this->morphOne(Files::class, 'fileable');
    }


}
