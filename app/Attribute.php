<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\CategoryAttribute;
class Attribute extends Model implements TranslatableContract
{
    use Translatable;
    public $timestamps = false;
    protected $hidden = ['translations','id','pivot','created_at','updated_at'];
    public $translatedAttributes = ['name'];
    protected $guarded = [];
    public function categories()
    {
        return $this->BelongsToMany(Category::class);

    }

    public function categoryAttributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }

    public function attributesValues()
    {
        return $this->hasMany(ProductAttributesValues::class);
    }
    public function attributesValue()
    {
        return $this->hasOne(ProductAttributesValues::class);
    }
    public function implodeAttributesValuesName()
    {
        return $this->attributesValues()->get();
    }
  

    public function products()
    {

        return $this->belongsToMany(Product::class,'attributeproduct_attributes_values', 'attribute_id', 'product_id');

    }
}
