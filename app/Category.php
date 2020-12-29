<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['name'];
    protected $guarded =  [];
    protected $hidden = ['translations','created_at', 'updated_at'];
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
    public function products()
    {
        return $this->hasMany('App\Product','cat_id','id');
    }
}
