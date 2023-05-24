<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotionCat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function motions(){
        return $this->hasMany(Motion::class,'cat_id');
    }
}
