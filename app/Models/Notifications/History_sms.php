<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_sms extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table="history_sms";
}
