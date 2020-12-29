<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded =  [];
    protected $hidden = ['updated_at'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
