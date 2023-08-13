<?php

namespace App\Models\Gaza;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table="areas";
    protected $guarded=[];

    public function region(){
        return $this->belongsTo(Region::class,"region_id");

    }
}
