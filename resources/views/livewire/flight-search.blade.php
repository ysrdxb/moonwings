<div>
    <h2 class="mb-4">Flight Search</h2>

    <form wire:submit.prevent="searchFlights" class="mb-4">
        <div class="row">
            <div class="col">
                <input type="text" wire:model="origin" placeholder="Origin (e.g., DXB)" class="form-control" required>
            </div>
            <div class="col">
                <input type="text" wire:model="destination" placeholder="Destination (e.g., KHI)" class="form-control" required>
            </div>
            <div class="col">
                <input type="date" wire:model="departureDate" class="form-control" required>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Search Flights</button>
            </div>
        </div>
    </form>

    @if (!empty($results['data']) && !$selectedFlight)
        <h4>Available Flights</h4>
        <div class="row">
            @php
                function formatDuration($duration) {
                    $interval = new DateInterval($duration);
                    $hours = $interval->h + ($interval->d * 24); // Convert days to hours if necessary
                    $minutes = $interval->i;
                    return "{$hours}h {$minutes}m";
                }
            @endphp
        
            @foreach ($results['data'] as $index => $flight)
                @php
                    $segments = $flight['itineraries'][0]['segments'];
                    $layovers = [];
                    $totalDuration = $flight['itineraries'][0]['duration'];
                @endphp
        
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm d-flex flex-row">
                        @php 
                            $airlineCode = $flight['validatingAirlineCodes'][0] ?? null;
                            $logoPath = public_path('airlines/' . strtolower($airlineCode) . '.png');
                            $logoUrl = file_exists($logoPath) ? asset('airlines/' . strtolower($airlineCode) . '.png') : asset('default_logo_url.png');
                            $airline = \App\Models\Airline::where('code', $airlineCode)->first();
                        @endphp
        
                        <div class="p-3">
                            <img src="{{ $logoUrl }}" style="max-width:70px" alt="{{ $airlineCode }}">
                        </div>
        
                        <div class="card-body">
                            <h5 class="card-title">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <span>{{ $airline->name }}</span>
                                        <span class="float-end">
                                            @foreach ($segments as $key => $segment)
                                                @if ($key > 0) → @endif
                                                {{ $segment['departure']['iataCode'] }} → {{ $segment['arrival']['iataCode'] }}
                                                @php
                                                    $layovers[] = formatDuration($segment['duration']);
                                                @endphp
                                            @endforeach
                                        </span>
                                    </div>
                                </div>                                
                            </h5>
        
                            <p class="card-text">
                                <strong>Departure:</strong> {{ $flight['itineraries'][0]['segments'][0]['departure']['at'] }}<br>
                                <strong>Arrival:</strong> {{ $flight['itineraries'][0]['segments'][0]['arrival']['at'] }}<br>
                                <strong>Duration:</strong> {{ formatDuration($totalDuration) }}<br>
                                <strong>Stops:</strong> {{ count($segments) - 1 }}<br>
                                <strong>Layovers:</strong> @foreach($layovers as $layover) {{ $layover }} @endforeach<br>
                                <strong>Price:</strong> {{ $flight['price']['total'] }} {{ $flight['price']['currency'] }}
                            </p>
        
                            <button wire:click="selectFlight({{ $index }})" class="btn btn-info float-end">Select Flight</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    @elseif ($selectedFlight)
        <h4>Selected Flight Details</h4>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $selectedFlight['itineraries'][0]['segments'][0]['departure']['iataCode'] }} → 
                    {{ $selectedFlight['itineraries'][0]['segments'][0]['arrival']['iataCode'] }}
                </h5>
                <p class="card-text">
                    <strong>Departure:</strong> {{ $selectedFlight['itineraries'][0]['segments'][0]['departure']['at'] }}<br>
                    <strong>Arrival:</strong> {{ $selectedFlight['itineraries'][0]['segments'][0]['arrival']['at'] }}<br>
                    <strong>Price:</strong> {{ $selectedFlight['price']['total'] }} {{ $selectedFlight['price']['currency'] }}
                </p>
                <button wire:click="bookFlight" class="btn btn-success">Book Now</button>
            </div>
        </div>
    @else
        <p class="text-muted">No flights found. Please try different search criteria.</p>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success mt-4">{{ session('message') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger mt-4">{{ session('error') }}</div>
    @endif
</div>
