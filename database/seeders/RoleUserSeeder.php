<?php

namespace Database\Seeders;

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all the roles attaching up to 3 random roles to each user
        $roles = Role::all()->sortByDesc("created_at");

        // Populate the pivot table
        User::all()->each(function ($user) use ($roles) {
            $user->roles()->attach($roles->pluck('id')->random());
        });
    }
}
