<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;


class ProductImage extends Model
{
    protected $guarded =  [];

    protected $hidden = ['translations','id','product_id','created_at','updated_at'];

    public function productes()
    {
        return $this->hasMany('App\Product','product_id','id');
    }
   
}
