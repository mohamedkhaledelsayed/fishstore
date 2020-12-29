<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(CategorySeeder::class);
          $this->call(ProductSeeder::class);
          $this->call(ProductImagesSeeder::class);
          $this->call(AttributeSeeder::class);
          $this->call(CategoryAttributesSeeder::class);
          $this->call(ProductAttributesValuesSeeder::class);
          $this->call(PageSeeder::class);
          $this->call(GovernmentSeeder::class);
          $this->call(CitySeeder::class);
          $this->call(LaratrustSeeder::class);
          $this->call(AdminUsersTableSeeder::class);
         //  $this->call(NotificationseederTable::class);

    }
}
