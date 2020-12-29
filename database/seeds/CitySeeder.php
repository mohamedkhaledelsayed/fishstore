<?php

use App\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities= [
            [
                'shipping'=>100,
                'gov_id'=>1,
                'en'  => ['name' => 'NasrCity'],
                'ar'  => ['name' => 'مدينة نصر'],
            ],[
                'shipping'=>100,
                'gov_id'=>1,
                'en'  => ['name' => 'Heliopolis'],
                'ar'  => ['name' => 'مصر الجديدة'],
            ],[
                'shipping'=>100,
                'gov_id'=>2,

                'en'  => ['name' => 'Maamoura'],
                'ar'  => ['name' => 'المعموره'],
            ],[
                'shipping'=>100,
                'gov_id'=>2,
                'en'  => ['name' => 'Al Ajmi'],
                'ar'  => ['name' => 'العجمى'],
            ]
            ];
            foreach($cities as $city)
            City::create( $city);
    }
}
