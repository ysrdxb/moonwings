<div class="container-fluid">
    @include('message')

    <div class="card">
        <div class="card-header">
            <h4>{{ $updateMode ? 'Edit Car Make' : 'Add Car Make' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createOrUpdateMake">
                <div class="mb-3">
                    <label for="name">Make Name</label>
                    <input type="text" wire:model="name" id="name" class="form-control" placeholder="Enter make name" />
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update Make' : 'Create Make' }}</button>
                <a href="{{ route('admin.car.make') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
