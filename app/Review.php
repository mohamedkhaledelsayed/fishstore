<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded =  [];
    protected $hidden= ['id','created_at','updated_at','product_id','user_id'];

    public function productes()
    {
        return $this->belongsTo('App\Product');
    }
    // public function getRateAttribute () {
    //     $this->productes()->avg();
    // }
    public function user()
    {
        return $this->belongsTo('App\User');

    }


    

}
