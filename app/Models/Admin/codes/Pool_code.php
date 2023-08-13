<?php

namespace App\Models\Admin\codes;


use App\Models\Owner\Place as pool_place ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool_code extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="pool_codes";

    public function pool_place()
    {
        return $this->belongsTo(pool_place::class,'pool_place_id');
    }

}
