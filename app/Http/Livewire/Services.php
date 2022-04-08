<?php

namespace App\Http\Livewire;

use App\Category;
use App\Facture;
use App\Service;
use Livewire\Component;

class Services extends Component
{
    public $totalPrices = [];
    public $servicesName = [];
    public $services;

    // public Facture $totalPrices;

    public function mount()
    {

        $this->services = Service::all();
        $this-> categories = Category::all();

        $this->totalPrices [] = '';
        $this->servicesName [] = '';
    }

    public function updated($key, $value)
    {
        $this->saved = FALSE;

        $parts = explode(".", $key);

        if(count($parts) == 2 && $parts[0] = "servicesName") {

            $TotalPrice = $this->services->where('id', $value)->first()->price_service;
            // $amountEachService = $TotalPrice * $this->quantityServices[$parts[0]];

            if($TotalPrice) {
                $this->totalPrices[] = $TotalPrice;
                // $this->amountEachServices[$parts[0]] = $amountEachService;
            }
        }
    }

    public function checkout()
    {
        $facture = Facture::with('service')->where('client_id')->get();
        $services = Service::select('id', 'price_service')->whereIn('id', $facture->pluck('service_id'))->get();
    }

    public function render()
    {
        info($this->totalPrices);
        return view('livewire.services');
    }
}
