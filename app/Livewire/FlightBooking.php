<?php

namespace App\Livewire;

use Livewire\Component;

class FlightBooking extends Component
{
    public $flightId;

    public function mount($id)
    {
        $this->flightId = $id;
    }

    public function render()
    {
        return view('livewire.flight-booking', [
            'flight' => $this->getFlightDetails(),
        ])->layout('layouts.app');
    }

    protected function getFlightDetails()
    {
        // Mocked data; replace with real details fetch logic.
        return ['id' => $this->flightId, 'name' => 'Airline A', 'price' => 100];
    }
}

