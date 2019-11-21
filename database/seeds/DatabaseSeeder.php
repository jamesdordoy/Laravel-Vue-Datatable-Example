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
        factory(\App\User::class, 50)->create();
        factory(\App\User::class)->create([
            'name' => 'James Dordoy',
            'email' => 'jamesdordoy@gmail.com',
            'password' => \Hash::make("admin"),
        ]);
    }
}
