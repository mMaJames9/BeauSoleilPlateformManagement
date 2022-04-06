<?php

namespace Database\Seeders;

use App\Client;
use App\Facture;
use Illuminate\Database\Seeder;

class Factureseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // facture::factory()->count(34)->create();

        // foreach (facture::all() as $facture) {
        //     $clients = Client::inRandomOrder()->take(rand(1,10))->pluck('id');
        //     foreach ($clients as $client) {
        //         $facture->clients()->save($client);
        //     }
        // }
    }
}
