<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="files";
    public function fileable()
    {
        return $this->morphTo();
    }

}
