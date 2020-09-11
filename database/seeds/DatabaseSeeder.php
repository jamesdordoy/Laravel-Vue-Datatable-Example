<?php

use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Database\Factories\DepartmentFactory;
use Database\Factories\RoleFactory;
use Database\Factories\WorkZoneFactory;
use Database\Factories\PhoneNumberFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $customerService = DepartmentFactory::new()->create([
            'name' => 'Customer Service',
            'handle' => 'customer-service',
        ]);

        $technology = DepartmentFactory::new()->create([
            'name' => 'Technology',
            'handle' => 'technology',
        ]);

        $management = DepartmentFactory::new()->create([
            'name' => 'Management',
            'handle' => 'management',
        ]);

        $depA = \App\Department::all()->random();
        $depB =\App\Department::all()->random();
        $depC = \App\Department::all()->random();

        $user = RoleFactory::new()->create([
            'department_id' => $depA,
            'name' => 'User',
            'handle' => 'user',
        ]);

        $staff = RoleFactory::new()->create([
            'department_id' => $depB,
            'name' => 'User',
            'handle' => 'user',
        ]);

        $admin = RoleFactory::new()->create([
            'department_id' => $depC,
            'name' => 'User',
            'handle' => 'user',
        ]);

        $workzones = WorkZoneFactory::new()->count(3)->create();

        $me = UserFactory::new()->create([
            'work_zone_id' => $workzones->random()->id,
            "email" => "jamesdordoy@gmail.com",
            "name" => "James",
            "password" => \Hash::make("password"),
        ]);

        $users = UserFactory::new()->count(200)->create([
            'work_zone_id' => $workzones->random()->id,
        ])->each(function($user) {
            PhoneNumberFactory::new()->count(2)->create([
                'user_id'  => $user->id,
            ]);

            PhoneNumberFactory::new()->count(2)->create([
                'user_id' => \App\User::all()->random()->id,
            ]);
        });

        $users->each(function ($item, $key) {

            $roleA = \App\Role::all()->random();
            $roleB = \App\Role::all()->random();

            \DB::table('department_user')
                ->insert([
                    'department_id' => $roleA->id,
                    'user_id' => $item->id,
                ]);

            \DB::table('department_user')
                ->insert([
                    'department_id' => $roleB->id,
                    'user_id' => $item->id,
                ]);
        });
    }
}
