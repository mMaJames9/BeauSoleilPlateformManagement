<?php

namespace Database\Seeders;

use App\Client;
use App\User;
use Illuminate\Database\Seeder;

class ClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all the roles attaching up to 3 random roles to each user
        $users = User::all();

        // Populate the pivot table
        Client::all()->each(function ($client) use ($users) {
            $client->users()->attach($users->pluck('id')->random());
        });
    }
}
