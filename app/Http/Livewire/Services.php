<?php

namespace App\Http\Livewire;

use App\Category;
use App\Service;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class Services extends Component
{
    public $services = [];
    public $categories = [];
    public $createTickets = [];

    public function mount()
    {
        $this->services = Service::all();
        $this->categories = Category::all();

        $this->createTickets = [
            ['service_id' => '', 'quantity' => 1, 'price_service' => 0]
        ];
    }

    public function addService()
    {
        $this->createTickets[] = ['service_id' => '', 'quantity' => 1, 'price_service' => 0];
    }

    public function removeService($index)
    {
        unset($this->createTickets[$index]);
        $this->createTickets = array_values($this->createTickets);
    }


    public function render()
    {
        info($this->createTickets);
        return view('livewire.services');
    }
}
