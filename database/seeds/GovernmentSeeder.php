<?php

use App\Government;
use Illuminate\Database\Seeder;

class GovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Governments=[    
            [
              
              'en'  => ['name' => 'Cairo'],
              'ar'  => ['name' => 'القاهرة'],
            ],[
              'en'  => ['name' => 'Alexandria'],
              'ar'  => ['name' => 'الأسكندرية'],
            ]
            ];

            foreach($Governments as $Government)
            Government::create( $Government);
        }
}
