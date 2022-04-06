<?php

namespace Database\Seeders;

use App\Client;
use App\Facture;
use App\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FactureServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $factures = Facture::all();

        foreach ($factures as $facture) {
            $services = Service::inRandomOrder()->take(rand(1,5))->pluck('id');
            foreach($services as $service) {
                $facture->services()->attach($service, ['quantity' => rand(1, 5)]);
            }
        }
    }
}
