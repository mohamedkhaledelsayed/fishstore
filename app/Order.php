<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderDetails;
class Order extends Model
{
    protected $guarded =  [];

    public function ordersdetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
    public function government()
    {
        
        return $this->belongsTo('App\Government');
    }
    public function City()
    {
        return $this->belongsTo('App\City');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

}
