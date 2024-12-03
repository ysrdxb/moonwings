<div class="container-fluid">
    @include('message')

    <div class="card">
        <div class="card-header">
            <h4>{{ $updateMode ? 'Edit Car Category' : 'Add Car Category' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createOrUpdateCategory">
                <div class="mb-3">
                    <label for="name">Category Name</label>
                    <input type="text" wire:model="name" id="name" class="form-control" placeholder="Enter category name" />
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update Category' : 'Create Category' }}</button>
                <a href="{{ route('admin.car.category') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
