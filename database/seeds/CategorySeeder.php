<?php

use App\Category;
use Illuminate\Database\Seeder;
use PHPUnit\Util\PHP\DefaultPhpProcess;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories= [
        [
          'image'=>'categories/aquarium-1.png',
          'en'  => ['name' => 'Aquarums'],
          'ar'  => ['name' => 'أحواض السمك'],
        ],[
          'image'=>'categories/starfish.png',
          'en'  => ['name' => 'fish And Plants'],
          'ar'  => ['name' => 'الأسماك والنباتات'],
        ],[
          'image'=>'categories/XMLID_-1.png',
          'en'  => ['name' => 'Accessories'],
          'ar'  => ['name' => 'مستلزمات الاسماك'],
        ],[
          'image'=>'categories/aquarium-1.png',
          'en'  => ['name' => 'Food And Fertilizers'],
          'ar'  => ['name' => 'المواد الغذائية والأسمدة'],
        ]
        // ,[
        //   'image'=>'default.png',
        //   'en'  => ['name' => 'Aquarums'],
        //   'ar'  => ['name' => 'اصناف'],
        // ],[
        //   'image'=>'default.png',
        //   'en'  => ['name' => 'category'],
        //   'ar'  => ['name' => 'اصناف'],
        // ]
        ];
        foreach($categories as $category)
          Category::create( $category);
      }
      

          
    
}
