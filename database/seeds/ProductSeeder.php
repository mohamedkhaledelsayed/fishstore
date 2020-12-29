<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){

            Product::create([
               'cat_id'=> 2,
              'price'=>rand(11,99),
              'offer_price'=>rand(11,99),
              'rating_avg'=>rand(11,99),
              'image_cover'=>'productes/asset-3.png',
              'en'  => ['name' => 'Product'.$i ,'descreption'=>'proudect is Good'],
              'ar'  => ['name' => 'منتج'.$i,'descreption'=>'هذا المنتج جيد'],
            ]);
          }
    }
}
