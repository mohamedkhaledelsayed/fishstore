<?php

use App\ProductAttributesValues;
use Illuminate\Database\Seeder;

class ProductAttributesValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        
        $ProductAttributesValues=[
            [
            'en'  => ['name' => 'Fishstore'],
            'ar'  => ['name' => 'اسماك'],
            'product_id'=>1,
            'attribute_id'=>1
           ]
        ];
   
        foreach($ProductAttributesValues as $ProductAttributesValue){
            ProductAttributesValues::create($ProductAttributesValue);
        }
        
    }
}
