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


    public function mount(Facture $factureDetails )
    {

        $this->services = Service::all();
        $this->categories = Category::all();

        $this->factureDetails = $factureDetails;

        $this->factureDetails = [
            ['service_id' => '', 'quantity' => 1, 'price_service' => 0, 'montantCalcule' => '0']
        ];
    }

    public function addService()
    {
        $this->factureDetails[] = ['service_id' => '', 'quantity' => 1, 'price_service' => 0];
    }

    public function removeService($index)
    {
        unset($this->factureDetails[$index]);
        $this->factureDetails = array_values($this->factureDetails);
    }

    public function updated($key, $value)
    {
        if (in_array($key, ['facture.price_service', 'facture.quantity']))
        {
            $this->factureDetails->montantCalcule = $this->factureDetails->quantity * $this->factureDetails->price_service;
        }
    }


    public function render()
    {
        info($this->factureDetails);
        return view('livewire.services');
    }
}
