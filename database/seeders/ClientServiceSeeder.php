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
        $services = Service::inRandomOrder()->take(rand(1,5))->pluck('id');

        foreach ($clients as $client) {
            foreach($services as $service) {
                $client->services()->attach($service, ['quantity' => rand(1, 5)]);
            }
        }
    }
}
