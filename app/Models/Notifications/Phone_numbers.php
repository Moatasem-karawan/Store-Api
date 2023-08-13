<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone_numbers extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="phones_numbers";
}
