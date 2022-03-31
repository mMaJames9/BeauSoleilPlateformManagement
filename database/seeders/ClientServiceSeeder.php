<?php

namespace Database\Seeders;

use App\Client;
use App\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClientServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $clients = Client::all();

        foreach($clients as $client) {
            $services = Service::inRandomOrder()->take(rand(1,3))->pluck('id');

            foreach ($services as $service) {
                $client->services()->attach($services, ['num_ticket' =>
                    Str::random(6)
                ]);
            }
        }
    }
}
