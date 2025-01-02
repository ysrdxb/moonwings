<div class="container-fluid">
    @include('message')

    <div class="card">
        <div class="card-header">
            <h4>{{ $updateMode ? 'Edit Car' : 'Add Car' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                <div class="row">
                    <!-- Column 1: Car Details -->
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Car Details</h5>
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="model_id" class="form-label">Make & Model</label>
                                    <select wire:model.defer="model_id" class="form-select" id="model_id">
                                        <option value="">Select model</option>
                                        @foreach($models as $model)
                                            <option value="{{ $model->id }}">{{ $model->make->name . ' ' . $model->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('model_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="number" wire:model.defer="year" class="form-control" id="year" placeholder="Enter car year">
                                    @error('year') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="license_plate" class="form-label">License Plate</label>
                                    <input type="text" wire:model.defer="license_plate" class="form-control" id="license_plate" placeholder="Enter license plate">
                                    @error('license_plate') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <select wire:model.defer="color" class="form-select" id="color">
                                        <option value="">Select color</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                        @endforeach
                                    </select>
                                    @error('color') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                                                
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Pricing & Booking</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="transfer_mode" class="form-check-label">Available for Transfers</label>
                                    <input type="checkbox" wire:model.defer="transfer_mode" class="form-check-input" id="transfer_mode" {{ $transfer_mode ? 'checked' : '' }}>
                                </div>

                                <div class="mb-3">
                                    <label for="rental_mode" class="form-check-label">Available for Rental</label>
                                    <input type="checkbox" wire:model.defer="rental_mode" class="form-check-input" id="rental_mode" {{ $rental_mode ? 'checked' : '' }}>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select wire:model.defer="status" class="form-select" id="status">
                                        <option value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="pending">Pending</option>
                                        <option value="booked">Booked</option>
                                    </select>
                                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                </div> 
                            </div>                               
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Featured Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="is_featured" class="form-check-label">Featured</label>
                                    <input type="checkbox" wire:model.defer="is_featured" class="form-check-input" id="is_featured" {{ $is_featured ? 'checked' : '' }}>
                                </div>

                                <div class="mb-3">
                                    <label for="featured_from" class="form-label">Featured From</label>
                                    <input type="date" wire:model.defer="featured_from" class="form-control" id="featured_from">
                                    @error('featured_from') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="featured_to" class="form-label">Featured To</label>
                                    <input type="date" wire:model.defer="featured_to" class="form-control" id="featured_to">
                                    @error('featured_to') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Car Specifications -->
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Specifications</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select wire:model.defer="category_id" class="form-select" id="category_id">
                                        <option value="">Select category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="seating_capacity" class="form-label">Seating Capacity</label>
                                    <input type="number" wire:model.defer="seating_capacity" class="form-control" id="seating_capacity">
                                    @error('seating_capacity') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="transmission" class="form-label">Transmission</label>
                                    <select wire:model.defer="transmission" class="form-control" id="transmission">
                                        <option value="">Select Transmission Type</option>
                                        <option value="automatic">Automatic</option>
                                        <option value="manual">Manual</option>
                                        <option value="semi-automatic">Semi-Automatic</option>
                                        <option value="cvt">CVT (Continuously Variable Transmission)</option>
                                        <option value="dct">DCT (Dual-Clutch Transmission)</option>
                                    </select>
                                    @error('transmission') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>                                

                                <div class="mb-3">
                                    <label for="doors" class="form-label">Doors</label>
                                    <input type="number" wire:model.defer="doors" class="form-control" id="doors">
                                    @error('doors') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="baggage" class="form-label">Baggage Capacity</label>
                                    <input type="number" wire:model.defer="baggage" class="form-control" id="baggage">
                                    @error('baggage') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="fuel_type" class="form-label">Fuel Type</label>
                                    <select wire:model.defer="fuel_type" class="form-control" id="fuel_type">
                                        <option value="">Select Fuel Type</option>
                                        <option value="petrol">Petrol</option>
                                        <option value="diesel">Diesel</option>
                                        <option value="electric">Electric</option>
                                        <option value="hybrid">Hybrid</option>
                                    </select>
                                    @error('fuel_type') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>                                 
                            </div>
                        </div>
                    </div>

                    <!-- Column 3: Additional Details -->
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Additional Details</h5>
                            </div>
                            <div class="card-body">                               

                                <div class="mb-3">
                                    <label for="daily_rate" class="form-label">Daily Rate</label>
                                    <input type="number" step="0.01" wire:model.defer="daily_rate" class="form-control" id="daily_rate">
                                    @error('daily_rate') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hourly_rate" class="form-label">Hourly Rate</label>
                                    <input type="number" step="0.01" wire:model.defer="hourly_rate" class="form-control" id="hourly_rate">
                                    @error('hourly_rate') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="per_km_rate" class="form-label">Per KM Rate</label>
                                    <input type="number" step="0.01" wire:model.defer="per_km_rate" class="form-control" id="per_km_rate">
                                    @error('per_km_rate') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" wire:model.defer="meta_title" class="form-control" id="meta_title">
                                    @error('meta_title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <input type="text" wire:model.defer="meta_description" class="form-control" id="meta_description">
                                    @error('meta_description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Main Image</label>
                                    <input type="file" wire:model="image" class="form-control" id="image">
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="gallery" class="form-label">Gallery Images</label>
                                    <input type="file" wire:model="gallery" multiple class="form-control" id="gallery">
                                    @error('gallery.*') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="video_link" class="form-label">Video Link</label>
                                    <input type="url" wire:model.defer="video_link" class="form-control" id="video_link">
                                    @error('video_link') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        {{ $updateMode ? 'Update Car' : 'Add Car' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
