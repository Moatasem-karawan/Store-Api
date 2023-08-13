<?php

namespace App\Models\Admin\codes;


use App\Models\Admin\Category;
use App\Models\Seller\Place as seller_place;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller_code extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="seller_codes";

    public function seller_place()
    {
        return $this->belongsTo(seller_place::class,'seller_place_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
