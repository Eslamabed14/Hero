<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProCat extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function apps(){
        return $this->hasMany(Programming::class, 'cat_id');
    }
}

