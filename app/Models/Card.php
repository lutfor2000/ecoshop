<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Card extends Model
{
    use HasFactory;
    protected $guarded = [];
    function producttocart(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
