<?php

namespace Database\Seeders;

use App\Client;
use App\Facture;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Client::factory()->count(15)->create()->each(function ($client)
        {
            // Create 5 services for each category
            $factures = Facture::factory()->count(3)->create();
            $client->factures()->saveMany($factures);
        });
    }
}
