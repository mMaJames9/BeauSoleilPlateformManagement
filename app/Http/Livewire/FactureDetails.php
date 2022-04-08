<?php

namespace App\Http\Livewire;

use App\Category;
use App\Service;
use Livewire\Component;

class FactureDetails extends Component
{
    public $services;
    public $categories = [];
    public $serviceNames = [];
    public $servicePrices = [''];
    public $totalPrice = [''];

    // public Facture $serviceNames;

    public function mount()
    {

        $this->services = Service::all();
        $this->categories = Category::all();
    }

    public function addService()
    {
        $this->servicePrices[] = 0;
    }

    public function removeService($index)
    {
        unset($this->servicePrices[$index]);
        $this->servicePrices = array_values($this->servicePrices);
    }

    public function updated($key, $value)
    {
        $this->saved = FALSE;

        $parts = explode(".", $key);

        if(count($parts) == 2 && $parts[0] = "serviceNames") {
            $servicePrice = $this->services->where('id', $value)->first()->price_service;

            if($servicePrice) {
                $this->servicePrices[$parts[1]] = $servicePrice;
            }
        }

        $this->totalPrice = 0;

        foreach($this->servicePrices as $servicePrice) {

            $this->totalPrice += $servicePrice;
        }

    }

    public function render()
    {
        return view('livewire.facture-details');
    }
}
