<?php

namespace App\Http\Livewire;

use App\Category;
use App\Service;
use Livewire\Component;

class FactureDetails extends Component
{
    public $services;
    public $categories = [];
    public $factureDetails = [];
    public $servicePrice = [];

    // public Facture $factureDetails;

    public function mount()
    {
        $this->servicePrice = [];

        $this->services = Service::all()->sortByDesc("created_at");
        $this->categories = Category::all()->sortByDesc("created_at");

        $this->factureDetails = [
            ['service_id' => '', 'price_service' => 0, 'quantity' => 1, 'amountEachService' => 0]
        ];

        // $this->factureDetails = $factureDetails;
    }

    public function addService()
    {
        $this->factureDetails[] = ['service_id' => '', 'price_service' => 0, 'quantity' => 1, 'amountEachService' => 0];
    }

    public function removeService($index)
    {
        unset($this->factureDetails[$index]);
        $this->factureDetails = array_values($this->factureDetails);
    }

    public function updated($key, $value)
    {
        $this->saved = FALSE;

        $parts = explode(".", $key);

        if(count($parts) == 3 && $parts[0] = "service_id") {
            $servicePrice = $this->services->where('id', $value)->first()->price_service;

            if($servicePrice) {
                // $this->factureDetails.{{$index}}.price_service = $servicePrice;
                // $this->factureDetails.{{$index}}.amountEachService = $amountEachService;
                // $amountEachService = $servicePrice * $this->factureDetails[$parts[2]];
                // $this->servicePrice[$parts[1]] = $servicePrice;
            }
        }
    }

    public function render()
    {
        return view('livewire.facture-details');
    }
}
