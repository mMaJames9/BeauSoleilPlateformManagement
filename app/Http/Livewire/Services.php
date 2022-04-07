<?php

namespace App\Http\Livewire;

use App\Category;
use App\Facture;
use App\Service;
use Livewire\Component;

class Services extends Component
{
    public $services = [];
    public $categories = [];
    public $factureDetails = [];

    // public Facture $factureDetails;

    public function mount()
    {

        $this->services = Service::all();
        $this->categories = Category::all();

        $this->factureDetails = [
            ['service_id' => '', 'quantity' => 1, 'montantCalcule' => 0]
        ];

        // $this->factureDetails = $factureDetails;
    }

    public function addService()
    {
        $this->factureDetails[] = ['service_id' => '', 'quantity' => 1, 'montantCalcule' => 0];
    }

    public function removeService($index)
    {
        unset($this->factureDetails[$index]);
        $this->factureDetails = array_values($this->factureDetails);
    }

    // public function updated($key, $value)
    // {
    //     $this->saved = FALSE;

    //     $parts = explode(".", $key);

    //     if(count($parts) == 2 && $parts[0] = "serviceNames") {

    //         $servicePrice = $this->services->where('id', $value)->first()->price_service;
    //         $amountEachService = $servicePrice * $this->quantityServices[$parts[1]];

    //         if($servicePrice) {
    //             $this->servicePrices[$parts[1]] = $servicePrice;
    //             $this->amountEachServices[$parts[1]] = $amountEachService;
    //         }
    //     }
    // }

    public function render()
    {
        info($this->factureDetails);
        return view('livewire.services');
    }
}
