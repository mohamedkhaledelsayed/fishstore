<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    protected $guarded = [];
    protected $table = 'attribute_category';
    protected $hidden = ['created_at','updated_at'];

}
