<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopingBasket extends Model
{
    use HasFactory;
    protected  $guarded =[];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function productBelngsto()
    {
        return $this->belongsto(Product::class,'product_id');
    }
}
