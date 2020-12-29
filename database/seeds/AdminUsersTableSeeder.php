<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = App\AdminUsers::create([
            'email'  =>  'admin@app.com',
            'username'  => 'admin',
            'name'  => 'admin',
            'password'  => bcrypt(123456),
        ]);
        $admin->attachRole('administrator');

        $user = App\AdminUsers::create([
            'email'  =>  'user@app.com',
            'username'  => 'user',
            'name'  => 'user',
            'password'  => bcrypt(123456),
        ]);
        $user->attachRole('user');
    }
}
