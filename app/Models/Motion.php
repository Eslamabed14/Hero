<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cat(){
        return $this->belongsTo(MotionCat::class,'cat_id');
    }
}
