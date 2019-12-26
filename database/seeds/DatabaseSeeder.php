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

        $user = factory(\App\Role::class)->create([
            'department_id' => \App\Department::all()->random(),
            'name' => 'User',
            'handle' => 'user',
        ]);

        $staff = factory(\App\Role::class)->create([
            'department_id' => \App\Department::all()->random(),
            'name' => 'Staff',
            'handle' => 'staff',
        ]);

        $admin = factory(\App\Role::class)->create([
            'department_id' => \App\Department::all()->random(),
            'name' => 'Admin',
            'handle' => 'admin',
        ]);

        $users = factory(\App\User::class, 50)->create([
            'role_id' => \App\Role::all()->random(),
        ]);

        $users->each(function ($item, $key) {

            $role = \App\Role::all()->random();

            \DB::table('role_user')
                ->insert([
                    'role_id' => $role->id,
                    'user_id' => $item->id,
                ]);
        });
    }
}
