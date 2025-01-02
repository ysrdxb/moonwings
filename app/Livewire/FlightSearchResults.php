<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\AmadeusService;
use App\Models\Airline;

class FlightSearchResults extends Component
{
    public $origin;
    public $destination;
    public $departureDate;
    public $returnDate;
    public $results = [];
    public $selectedFlight;
    
    // Filters
    public $priceRange = 0;
    public $selectedStops = 'all';
    public $selectedAirlines = [];
    public $departureTime = '';
    public $sortOrder = 'price_asc';

    public $filteredResults = [];
    public $tripType = 'one-way';
    public $tripTypeChanged = false;
    public $airlines = [];
    
    public function mount($origin, $destination, $departureDate)
    {
        $this->origin = $origin;
        $this->destination = $destination;
        $this->departureDate = $departureDate;
        $this->airlines = Airline::whereNotNull('code')->where('code', '!=', '')->get();
        $this->fetchFlights();
    }

    public function fetchFlights()
    {
        $amadeus = new AmadeusService();
        $this->results = $amadeus->searchFlights($this->origin, $this->destination, $this->departureDate);
        $this->filteredResults = $this->results['data'];
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'tripType') {
            $this->handleTripTypeChange();
        }

        if (in_array($propertyName, ['origin', 'destination', 'departureDate'])) {
            $this->fetchFlights();
        }
    }

    public function handleTripTypeChange()
    {
        if ($this->tripType === 'one-way') {
            $this->returnDate = null;
        } elseif ($this->tripType === 'return') {
            if (empty($this->returnDate)) {
                $this->returnDate = date('Y-m-d', strtotime($this->departureDate . ' +1 day'));
            }
        }
    }

    public function applyFilters()
    {
        $this->filteredResults = $this->results['data'];

        // Filter by prce range
        if ($this->priceRange > 0) {
            $this->filteredResults = array_filter($this->filteredResults, function ($flight) {
                return $flight['price']['total'] <= $this->priceRange;
            });
        }

        // Filter by stops
        if ($this->selectedStops != 'all') {
            $this->filteredResults = array_filter($this->filteredResults, function ($flight) {
                $segments = $flight['itineraries'][0]['segments'];
                return count($segments) - 1 == $this->selectedStops;
            });
        }

        // Filter by airlines
        if (!empty($this->selectedAirlines)) {
            $this->filteredResults = array_filter($this->filteredResults, function ($flight) {
                $airlineCode = $flight['validatingAirlineCodes'][0] ?? null;
                return in_array(strtolower($airlineCode), $this->selectedAirlines);
            });
        }

        // Filter by departure time
        if ($this->departureTime) {
            $this->filteredResults = array_filter($this->filteredResults, function ($flight) {
                $departureTime = substr($flight['itineraries'][0]['segments'][0]['departure']['at'], 11, 5);
                return strpos($departureTime, $this->departureTime) !== false;
            });
        }

        // Sort by selected option
        usort($this->filteredResults, function ($a, $b) {
            if ($this->sortOrder == 'price_asc') {
                return $a['price']['total'] <=> $b['price']['total'];
            } elseif ($this->sortOrder == 'price_desc') {
                return $b['price']['total'] <=> $a['price']['total'];
            } elseif ($this->sortOrder == 'duration_asc') {
                return $this->calculateDuration($a) <=> $this->calculateDuration($b);
            } elseif ($this->sortOrder == 'duration_desc') {
                return $this->calculateDuration($b) <=> $this->calculateDuration($a);
            }
        });
    }

    public function calculateDuration($flight)
    {
        $totalDuration = $flight['itineraries'][0]['duration'];
        $interval = new \DateInterval($totalDuration);
        return ($interval->h * 60) + $interval->i;
    }

    public function selectFlight($flightId)
    {
        // Handle flight selection logic
    }

    public function resetFilters()
    {
        $this->priceRange = 0;
        $this->selectedStops = 'all';
        $this->selectedAirlines = [];
        $this->departureTime = '';
        $this->applyFilters();
    }    

    public function render()
    {
        $airlines = $this->airlines;
        return view('livewire.flight-search-results', compact('airlines'))->layout('layouts.app');
    }
}
