<?php

namespace App\Models\Owner;



use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Owner extends Authenticatable

{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table="owners";
    protected $guarded=[];
    public function owner_place(){
        return $this->hasOne(Place::class,"owner_id");
    }
    public function category(){
        return $this->belongsTo(Category::class,"category_id");
    }
}
