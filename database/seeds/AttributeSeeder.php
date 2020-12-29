<?php

use App\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $attributes = [
        [
            'en'  => ['name' => 'Brand'],
            'ar'  => ['name' => 'ماركة'],
        ],[
            'en'  => ['name' => 'material'],
            'ar'  => ['name' => 'مواد'],
        
        ],[
            'en'  => ['name' => 'weight'],
            'ar'  => ['name' => 'وزن'],
        
        ],[
            'en'  => ['name' => 'Diemnsions'],
            'ar'  => ['name' => 'الأبعاد'],
        
        ]
    ];
    foreach($attributes as $attribute){

        Attribute::create($attribute);
        
      }
    }
}
