<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraphicCat extends Model
{
    use HasFactory;
    protected $guarded = [] ;

    public function graphics(){
        return $this->hasMany(Graphic::class ,'cat_id');
    }
}
