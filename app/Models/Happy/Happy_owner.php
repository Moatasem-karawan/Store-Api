<?php

namespace App\Models\Happy;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Happy_owner extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table="happy_owner";
    protected $guarded=[];
    public function products(){
        return $this->hasMany(Product::class,"happy_seller_id");
    }
}
