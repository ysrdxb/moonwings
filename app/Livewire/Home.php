<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $origin;
    public $destination;
    public $departureDate;

    public function searchFlights()
    {
        $this->validate([
            'origin' => 'required|string|max:3',
            'destination' => 'required|string|max:3',
            'departureDate' => 'required|date',
        ]);

        return redirect()->route('flight.search.results', [
            'origin' => $this->origin,
            'destination' => $this->destination,
            'departureDate' => $this->departureDate,
        ]);
    }

    public function render()
    {
        return view('livewire.home')->layout('layouts.app');
    }
}

