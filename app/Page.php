<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Page extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded =  [];
    public $translatedAttributes = ['text'];
    protected $hidden = ['translations','created_at', 'updated_at'];
}
