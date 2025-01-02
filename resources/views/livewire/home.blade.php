
<div>    
    <section class="search-section">
        <div class="container">
            <h1 class="text-center mb-4">Millions of cheap flights. One simple search.</h1>
            <div class="bordered-form">
                <!-- Tabs -->
                <ul class="nav nav-tabs mb-4" id="searchTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="flights-tab" data-bs-toggle="tab" data-bs-target="#flights" type="button" role="tab">Flights</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cars-tab" data-bs-toggle="tab" data-bs-target="#cars" type="button" role="tab">Cars</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="hotels-tab" data-bs-toggle="tab" data-bs-target="#hotels" type="button" role="tab">Hotels</button>
                    </li>
                </ul>
                
                <!-- Tab Content -->
                <div class="tab-content" id="searchTabsContent">
                    <!-- Flights Form -->
                    <div class="tab-pane fade show active" id="flights" role="tabpanel">
                        <div class="row g-3">
                            <form wire:submit.prevent="searchFlights">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <input type="text" wire:model="origin" class="form-control" placeholder="From" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" wire:model="destination" class="form-control" placeholder="To" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" wire:model="departureDate" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary w-100" type="submit">Search Flights</button>
                                    </div>
                                </div>
                            </form>                                                        
                        </div>
                    </div>
                    
                    <!-- Cars Form -->
                    <div class="tab-pane fade" id="cars" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Pick-up Location">
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" placeholder="Pick-up Date">
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" placeholder="Return Date">
                            </div>
                            <div class="col-md-2 offset-md-10">
                                <button class="btn btn-primary btn-search w-100">Search Cars</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hotels Form -->
                    <div class="tab-pane fade" id="hotels" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Destination">
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" placeholder="Check-in Date">
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" placeholder="Check-out Date">
                            </div>
                            <div class="col-md-2 offset-md-10">
                                <button class="btn btn-primary btn-search w-100">Search Hotels</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container feature-buttons text-center mt-3">
        <div class="row gx-2">
            <div class="col-4">
                <button class="btn w-100">Hotels</button>
            </div>
            <div class="col-4">
                <button class="btn w-100">Car Rental</button>
            </div>
            <div class="col-4">
                <button class="btn w-100">Explore Everywhere</button>
            </div>
        </div>
    </div>       

    <section class="explore-section">
        <div class="container position-relative">
            <div class="position-relative">
                <img src="{{ asset('assets/images/1.webp') }}" alt="Explore Image" class="img-fluid w-100 rounded mb-4">
                
                <div class="position-absolute text-white p-4" style="top: 50%; left: 5%; transform: translateY(-50%);">
                    <h2>Explore every destination</h2>
                    <button class="btn btn-primary">Search Flights Everywhere</button>
                </div>
            </div>
        </div>
    </section>       

    <div class="container my-5">
        <h3 class="text-center mb-4">Booking flights with Moonwings</h3>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        How does Moonwings work?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">We compare flights from airlines worldwide to find you the best deals.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        Can I book hotels and car rentals too?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">Yes, we also help you find the best hotels and car rental deals.</div>
                </div>
            </div>
        </div>
    </div>
</div>