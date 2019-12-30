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
        $customerService = factory(\App\Department::class)->create([
            'name' => 'Customer Service',
            'handle' => 'customer-service',
        ]);

        $technology = factory(\App\Department::class)->create([
            'name' => 'Technology',
            'handle' => 'technology',
        ]);

        $management = factory(\App\Department::class)->create([
            'name' => 'Management',
            'handle' => 'management',
        ]);

        $depA = \App\Department::all()->random();
        $depB =\App\Department::all()->random();
        $depC = \App\Department::all()->random();

        $user = factory(\App\Role::class)->create([
            'department_id' => $depA,
            'name' => 'User',
            'handle' => 'user',
        ]);

        $staff = factory(\App\Role::class)->create([
            'department_id' => $depB,
            'name' => 'Staff',
            'handle' => 'staff',
        ]);

        $admin = factory(\App\Role::class)->create([
            'department_id' => $depC,
            'name' => 'Admin',
            'handle' => 'admin',
        ]);

        $workzones = factory(\App\WorkZone::class, 3)->create();

        $users = factory(\App\User::class, 50)->create([
            'work_zone_id' => $workzones->random()->id,
        ])->each(function($user) {
            factory(\App\TelephoneNumber::class, 2)->create([
                'user_id'  => $user->id,
            ]);
            factory(\App\TelephoneNumber::class, 2)->create([
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
