<?php

namespace App;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class ProductAttributesValues extends Model  implements TranslatableContract
{
    
    use Translatable;

    protected $guarded = [];
    protected $hidden = ['translations','id','product_id','attribute_id','created_at','updated_at'];
    public $translatedAttributes = ['name'];
    public function getDetails()
    {
        return $this->belongsToMany(Product::class,'product_attributes_values','attribute_id','product_id');
    }
    public function Attribute()
    {
        return $this->belongsToMany(Attribute::class,'product_attributes_values','product_id','attribute_id');
    }
}
