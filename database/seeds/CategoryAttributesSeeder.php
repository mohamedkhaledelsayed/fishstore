<?php

use App\CategoryAttribute;
use Illuminate\Database\Seeder;

class CategoryAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            CategoryAttribute::create([
               'category_id'=>1,
               'attribute_id'=>1
            ]);
        
     	
    }
}
