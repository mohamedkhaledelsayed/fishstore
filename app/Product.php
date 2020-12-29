<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Favourite;

class Product extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = ['id'];
    public $translatedAttributes = ['name', 'descreption'];
    protected $hidden = ['translations','created_at', 'updated_at'];
     public $appends = ['AvgRate'];
    public function allAttributes()
    {
        return $this->attributesValues();
    }

    public function update_attributes($request)
    {
        $this->attributesValues()->detach();
        foreach($request->category_attributes as $attribute_id => $attributes) {
            $this->attributes()->create($attributes);
        }
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttributesValues::class,'product_id','id');
    }
    public function attributesValues()
    {
        return $this->belongsToMany(Attribute::class,'product_attributes_values','product_id','attribute_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function category()
    {
        return $this->hasOne(category::class);
    }
    public function Reviwes()
    {
        return $this->hasMany(Review::class);
    }
    public function favourites()
    {
        return  $this->hasMany(Favourite::class);
    }
    public function carts()
    {
        return  $this->hasMany(Cart::class);
    }
    public function notifications()
    {
        return  $this->hasMany(Notification::class);
    }
   
    public function getIsUserFavouriteAttribute()
    {
 
        if(auth('api') && $user = auth('api')->user()) {
            
            $isFavourite =  $this->favourites()->where('user_id',$user->id)
            ->first();
            
            return $isFavourite ?  $isFavourite= 1 : 0;
        }

        return 0;
    }
   

    public function getCurrentPriceAttribute()
    {
        if ($this->offer_price) {
            $price=$this->offer_price;
         }else{
             $price=$this->price;
         }
        return $price;    
    }
        
    public function getAvgRateAttribute() {
        return $this->Reviwes()->pluck('rating')->avg();
    }
       
    
}
