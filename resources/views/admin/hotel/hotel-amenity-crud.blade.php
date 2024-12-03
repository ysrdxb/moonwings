<div class="container-fluid">
    @include('message')

    <div class="card">
        <div class="card-header">
            <h4>{{ $updateMode ? 'Edit Hotel Amenity' : 'Add Hotel Amenity' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createOrUpdateAmenity">
                <div class="mb-3">
                    <label for="name">Amenity Name</label>
                    <input type="text" wire:model="name" id="name" class="form-control" placeholder="Enter amenity name" />
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update Amenity' : 'Create Amenity' }}</button>
                <a href="{{ route('admin.hotel.amenity') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
