<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whats_app_msg extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='whatsapp_msg';
}
