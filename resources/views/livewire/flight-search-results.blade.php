<div>
    <div class="container mt-3">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Filters</h5>
                        <form wire:submit.prevent="applyFilters">
                            <!-- Origin -->
                            <div class="mb-3">
                                <label for="origin" class="form-label">Origin</label>
                                <input type="text" id="origin" class="form-control" wire:model="origin" placeholder="Enter Origin">
                            </div>
                        
                            <!-- Destination -->
                            <div class="mb-3">
                                <label for="destination" class="form-label">Destination</label>
                                <input type="text" id="destination" class="form-control" wire:model="destination" placeholder="Enter Destination">
                            </div>
                        
                            <!-- Departure Date -->
                            <div class="mb-3">
                                <label for="departureDate" class="form-label">Departure Date</label>
                                <input type="date" id="departureDate" class="form-control" wire:model="departureDate">
                            </div>
                        
                            <!-- Trip Type (One-way or Return) -->
                            <div class="mb-3">
                                <label for="tripType" class="form-label">Trip Type</label>
                                <select id="tripType" class="form-select" wire:model.live="tripType">
                                    <option value="one-way">One-way</option>
                                    <option value="return">Return</option>
                                </select>
                            </div>
                        
                            <!-- Return Date (Visible only when "Return" is selected) -->
                            @if($tripType === 'return')
                                <div class="mb-3">
                                    <label for="returnDate" class="form-label">Return Date</label>
                                    <input type="date" id="returnDate" class="form-control" wire:model="returnDate">
                                </div>
                            @endif
                        
                            <!-- Price Filter -->
                            <div class="filter-group mb-4">
                                <label for="priceFilter" class="form-label">Price Range</label>
                                <input type="range" class="form-range" id="priceFilter" min="0" max="1000" step="50" wire:model="priceRange">
                                <div>Selected Range: <strong>{{ $priceRange }}</strong></div>
                            </div>
                        
                            <!-- Stops Filter -->
                            <div class="mb-3">
                                <label for="stopFilter" class="form-label">Stops</label>
                                <select id="stopFilter" class="form-select" wire:model="selectedStops">
                                    <option value="all">All Stops</option>
                                    <option value="0">Non-stop</option>
                                    <option value="1">1 Stop</option>
                                    <option value="2">2 Stops</option>
                                </select>
                            </div>
                        
                            <!-- Airline Filter -->
                            <div class="mb-3">
                                <label for="airlineFilter" class="form-label">Airlines</label>
                                <select id="airlineFilter" class="form-select" multiple wire:model="selectedAirlines">
                                    @foreach($airlines as $airline)
                                        <option value="{{ $airline->code }}">{{ $airline->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <!-- Departure Time Filter -->
                            <div class="mb-3">
                                <label for="departureTimeFilter" class="form-label">Departure Time</label>
                                <input type="time" id="departureTimeFilter" class="form-control" wire:model="departureTime">
                            </div>
                        
                            <button type="button" class="btn btn-outline-secondary" wire:click="resetFilters">Reset Filters</button>
                            <!-- Apply Filters Button -->
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </form>
                        
                    </div>
                </div>
            </div>

            <!-- Flight Results -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <span class="fw-bold">Showing {{ count($filteredResults) }} results</span>
                    </div>
                    <div>
                        <!-- Sorting Options -->
                        <select class="form-select d-inline-block w-auto" id="sortByPrice" wire:model="sortOrder">
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="duration_asc">Duration: Shortest First</option>
                            <option value="duration_desc">Duration: Longest First</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    @foreach ($filteredResults as $index => $flight)
                        @php
                            $airlineCode = $flight['validatingAirlineCodes'][0] ?? null;
                            $logoPath = public_path('airlines/' . strtolower($airlineCode) . '.png');
                            $logoUrl = fetchAirlineLogo($airlineCode);
                            $airline = \App\Models\Airline::where('code', $airlineCode)->first();
                        @endphp                    
                        <div class="col-md-12 mb-4">
                            <div class="card shadow-sm d-flex flex-row">
                                <div class="p-3">
                                    <img src="{{ $logoUrl }}" style="max-width:70px" alt="Airline Logo">
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">
                                        <div class="row">
                                            <div class="col-md-12 d-flex justify-content-between">
                                                <span>{{ $flight['validatingAirlineCodes'][0] }}</span>
                                                <span class="float-end">
                                                    @foreach ($flight['itineraries'][0]['segments'] as $segment)
                                                        @if ($loop->index > 0) → @endif
                                                        {{ $segment['departure']['iataCode'] }} → {{ $segment['arrival']['iataCode'] }}
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    </h5>

                                    <p class="card-text">
                                        <strong>Departure:</strong> {{ $flight['itineraries'][0]['segments'][0]['departure']['at'] }}<br>
                                        <strong>Arrival:</strong> {{ $flight['itineraries'][0]['segments'][0]['arrival']['at'] }}<br>
                                        <strong>Duration:</strong> {{ formatDuration($flight['itineraries'][0]['duration']) }}<br>
                                        <strong>Stops:</strong> {{ count($flight['itineraries'][0]['segments']) - 1 }}<br>
                                        <strong>Price:</strong> {{ $flight['price']['total'] }} {{ $flight['price']['currency'] }}
                                    </p>

                                    <button wire:click="selectFlight({{ $index }})" class="btn btn-primary float-end">Select Flight</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>


    @if (session()->has('message'))
        <div class="alert alert-success mt-4">{{ session('message') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger mt-4">{{ session('error') }}</div>
    @endif
</div>
