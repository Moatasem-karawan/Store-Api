<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category_seller extends Model
{
    use HasFactory;
    protected $table='sub_category_seller';
    protected $guarded=[];
    public function products(){
        return $this->hasMany(seller_product::class,"sub_category_seller");
    }
}
