<?php

use Illuminate\Database\Seeder;
use App\Notification;
class NotificationseederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::create([
            'title'=>'fishStore',
            'body'=>'Add new product successfully',
        ]);
        
    }
}
