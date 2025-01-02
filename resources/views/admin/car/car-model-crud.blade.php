<div class="container-fluid">
    @include('message')

    <div class="card">
        <div class="card-header">
            <h4>{{ $updateMode ? 'Edit Car Model' : 'Add Car Model' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createOrUpdateModel">
                <div class="mb-3">
                    <label for="name">Model Name</label>
                    <input type="text" wire:model="name" id="name" class="form-control" placeholder="Enter model name" />
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="make_id">Car Make</label>
                    <select wire:model="make_id" id="make_id" class="form-control">
                        <option value="">Select Make</option>
                        @foreach($makes as $make)
                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                        @endforeach
                    </select>
                    @error('make_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update Model' : 'Create Model' }}</button>
                <a href="{{ route('admin.car.model') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
