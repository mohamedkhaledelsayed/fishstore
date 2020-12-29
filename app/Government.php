<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Government extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['name'];
    protected $guarded =  [];
    protected $hidden = ['translations','created_at', 'updated_at'];

    public function City()
    {
        return $this->belongsTo('App\City');
    }
}
