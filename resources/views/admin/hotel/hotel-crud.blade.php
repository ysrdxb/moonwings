<div class="container-fluid">
    @include('message')

    <div class="card">
        <div class="card-header">
            <h4>{{ $updateMode ? 'Edit Hotel' : 'Add New Hotel' }}</h4>
        </div>
        <div class="card-body">
            <!-- Bootstrap Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General Information</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="location-tab" data-bs-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="false">Location Information</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="details-tab" data-bs-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Details</a>
                </li>
                @if($updateMode)
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="amenities-tab" data-bs-toggle="tab" href="#amenities" role="tab" aria-controls="amenities" aria-selected="false">Amenities</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="rooms-tab" data-bs-toggle="tab" href="#rooms" role="tab" aria-controls="rooms" aria-selected="false">Rooms</a>
                </li>
                @endif
            </ul>
        
            <div class="tab-content" id="myTabContent">
                <!-- General Tab -->
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <div class="mb-3">
                        <label for="name">Hotel Name (EN)</label>
                        <input type="text" wire:model="name" class="form-control" placeholder="Enter hotel name in English" />
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea wire:model="description" class="form-control" placeholder="Enter description"></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image">Image</label>
                        <input type="file" wire:model="image" class="form-control" />
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gallery">Gallery</label>
                        <input type="file" wire:model="gallery" class="form-control" multiple />
                        @error('gallery.*') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" wire:model="meta_title" class="form-control" placeholder="Enter meta title" />
                        @error('meta_title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="meta_description">Meta Description</label>
                        <textarea wire:model="meta_description" class="form-control" placeholder="Enter meta description"></textarea>
                        @error('meta_description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        
                    <!-- Buttons Row -->
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-primary" wire:click.prevent="saveGeneralInformation" data-bs-toggle="tab" href="#location">Next</button>
                        <button type="button" wire:click.prevent="saveGeneralInformation" class="btn btn-success">{{ $updateMode ? 'Update Hotel' : 'Save Hotel' }}</button>
                    </div>
                </div>
                <!-- Location Tab -->
                <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" wire:model="address" class="form-control" placeholder="Enter hotel address" />
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location_id">Location</label>
                        <select wire:model="location_id" class="form-control">
                            <option value="">Select Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('location_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" wire:model="postal_code" class="form-control" placeholder="Enter postal code" />
                        @error('postal_code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="latitude">Latitude</label>
                        <input type="text" wire:model="latitude" class="form-control" placeholder="Enter latitude" />
                        @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="longitude">Longitude</label>
                        <input type="text" wire:model="longitude" class="form-control" placeholder="Enter longitude" />
                        @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        
                    <!-- Buttons Row -->
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-primary" wire:click.prevent="saveLocationInformation" data-bs-toggle="tab" href="#details">Next</button>
                        <button type="button" wire:click.prevent="saveLocationInformation" class="btn btn-success">{{ $updateMode ? 'Update Hotel' : 'Save Hotel' }}</button>
                    </div>
                </div>
        
                <!-- Details Tab -->
                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <div class="mb-3">
                        <label for="rating">Rating</label>
                        <input type="number" wire:model="rating" class="form-control" placeholder="Enter rating (0-5)" min="0" max="5" />
                        @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stars">Stars</label>
                        <input type="number" wire:model="stars" class="form-control" placeholder="Enter stars (1-5)" min="1" max="5" />
                        @error('stars') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" wire:model="phone" class="form-control" placeholder="Enter phone number" />
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" wire:model="email" class="form-control" placeholder="Enter email address" />
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="is_featured">Featured</label>
                        <input type="checkbox" wire:model="is_featured" />
                        @error('is_featured') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox" wire:model="status" />
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="checkin_time">Check-in Time</label>
                        <input type="time" wire:model="checkin_time" class="form-control" />
                        @error('checkin_time') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="checkout_time">Check-out Time</label>
                        <input type="time" wire:model="checkout_time" class="form-control" />
                        @error('checkout_time') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        
                    <!-- Buttons Row -->
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-primary" wire:click.prevent="saveDetails" data-bs-toggle="tab" href="#amenities">Next</button>
                        <button type="button" wire:click.prevent="saveDetails" class="btn btn-success">{{ $updateMode ? 'Update Hotel' : 'Save Hotel' }}</button>
                    </div>
                </div>
                @if($updateMode)
                    <!-- Amenities Tab -->
                    <div class="tab-pane fade" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
                        <div class="mb-3">
                            <label>Select Amenities</label>
                            <div class="form-check">
                                @foreach($amenities as $amenity)
                                    <div class="form-check">
                                        <input 
                                            type="checkbox" 
                                            wire:model="selectedAmenities" 
                                            value="{{ $amenity->id }}" 
                                            class="form-check-input" 
                                            id="amenity-{{ $amenity->id }}"
                                        />
                                        <label class="form-check-label" for="amenity-{{ $amenity->id }}">
                                            {{ $amenity->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('selectedAmenities.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="button" wire:click="saveAmenities" class="btn btn-primary">Save Amenities</button>
                    </div>


                    <!-- Rooms Tab -->
                    <div class="tab-pane fade" id="rooms" role="tabpanel" aria-labelledby="rooms-tab">
                        <div id="rooms-container">
                            @foreach($rooms as $index => $room)
                                <div class="mb-3 border p-3 rounded shadow-sm bg-white">
                                    <h5>Room {{ $index + 1 }}</h5>
                                    <div class="mb-3">
                                        <label for="rooms.{{ $index }}.room_type" class="form-label">Room Type</label>
                                        <select wire:model="rooms.{{ $index }}.room_type" class="form-select">
                                            <option value="">Select Room Type</option>
                                            <option value="Standard">Standard</option>
                                            <option value="Deluxe">Deluxe</option>
                                            <option value="Suite">Suite</option>
                                            <option value="Family">Family</option>
                                            <option value="Executive">Executive</option>
                                            <option value="Single">Single</option>
                                            <option value="Double">Double</option>
                                        </select>
                                        @error("rooms.$index.room_type") <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="rooms.{{ $index }}.capacity" class="form-label">Capacity</label>
                                        <input type="number" wire:model="rooms.{{ $index }}.capacity" class="form-control" min="1" />
                                        @error("rooms.$index.capacity") <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="rooms.{{ $index }}.price" class="form-label">Price</label>
                                        <input type="number" step="0.01" wire:model="rooms.{{ $index }}.price" class="form-control" min="0" />
                                        @error("rooms.$index.price") <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="rooms.{{ $index }}.facilities" class="form-label">Facilities</label>
                                        <input type="text" wire:model="rooms.{{ $index }}.facilities" class="form-control" placeholder="e.g., Wi-Fi, TV, Air Conditioning" />
                                        @error("rooms.$index.facilities") <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="rooms.{{ $index }}.is_available" class="form-label">Available</label>
                                        <input type="checkbox" wire:model="rooms.{{ $index }}.is_available" class="form-check-input" />
                                    </div>
                                    <button type="button" wire:click="removeRoom({{ $index }})" class="btn btn-danger">Remove Room</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" wire:click="addRoom" class="btn btn-primary">Add Room</button>

                        <!-- Buttons Row -->
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-primary" wire:click.prevent="saveRoom">Save Rooms</button>
                        </div>
                    </div>


                @endif
            </div>
        </div>
    </div>
</div>
