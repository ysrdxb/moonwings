<div class="container-fluid">
    @include('message')

    <div class="card">
        <div class="card-header">
            <h4>{{ $updateMode ? 'Edit City' : 'Add City' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" wire:model.defer="name" class="form-control" id="name" placeholder="Enter city name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-3">
                    <label for="country_id" class="form-label">Country</label>
                    <select wire:model.defer="country_id" class="form-control" id="country_id">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">City Image</label>
                    <input type="file" wire:model="image" class="form-control" id="image">
                    @if($image)
                        <img src="{{ $image->temporaryUrl() }}" width="100" class="mt-2">
                    @elseif($updateMode && $image)
                        <img src="{{ asset('storage/'.$image) }}" width="100" class="mt-2">
                    @endif
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-success">{{ $updateMode ? 'Update' : 'Save' }}</button>
                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
</div>
