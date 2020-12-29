<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $guarded =  [];
    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    public function Product()
    {
        return $this->belongsTo('App\Product');

    }
}
