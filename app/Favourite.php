<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Favourite extends Model
{
    protected $guarded =  [];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
