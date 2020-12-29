<?php

use App\ProductImage;
use Illuminate\Database\Seeder;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        for($i=0;$i<10;$i++){

           ProductImage::create([
                    'product_id'=>rand(1,9),
                    'image'=>'productes/s1.png',

            ]);
          }
    }
}
