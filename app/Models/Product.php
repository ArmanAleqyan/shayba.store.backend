<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected  $guarded =[];

    public function category(){
        return $this->belongsTo(category::class,'category_id');
    }
    public function taste(){
        return $this->belongsTo(taste::class,'taste_id');
    }
    public function made_in(){
        return $this->belongsTo(SubCategory::class,'made_in_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function photo(){
        return $this->hasMany(ProductPhoto::class,'product_id');
    }


    public function basket()
    {
        return $this->hasOne(ShopingBasket::class)->where('user_id', auth()->user()->id);
    }

    public function AuthUserFavorite()
    {
        return $this->hasOne(FavoriteProduct::class)->where('user_id', auth()->guard('api')->user()->id);
    }

}
