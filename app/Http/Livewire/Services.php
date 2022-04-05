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
    public $createfactures = [];

    public function mount()
    {
        $this->services = Service::all();
        $this->categories = Category::all();

        $this->createfactures = [
            ['service_id' => '', 'quantity' => 1, 'price_service' => 0]
        ];
    }

    public function addService()
    {
        $this->createfactures[] = ['service_id' => '', 'quantity' => 1, 'price_service' => 0];
    }

    public function removeService($index)
    {
        unset($this->createfactures[$index]);
        $this->createfactures = array_values($this->createfactures);
    }


    public function render()
    {
        info($this->createfactures);
        return view('livewire.services');
    }
}
