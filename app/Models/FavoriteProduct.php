<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteProduct extends Model
{
    use HasFactory;
    protected  $guarded = [];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function AuthUserFavorite(){

        return $this->belongsTo(Product::class,'product_id')->where('user_id', auth()->guard('api')->user()->id);
    }

}
