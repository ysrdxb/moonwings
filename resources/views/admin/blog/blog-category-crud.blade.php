<div class="container-fluid">
    @include('message')

    <div class="card">
        <div class="card-header">
            <h4>{{ $updateMode ? 'Edit Blog Category' : 'Add Blog Category' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" wire:model.defer="name" class="form-control" id="name" placeholder="Enter name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>                        
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control" id="slug" placeholder="Enter slug">
                    @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                </div>                      
                <button type="submit" class="btn btn-success">{{ $updateMode ? 'Update' : 'Save' }}</button>
                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
            </form>
            
        </div>
    </div>
</div>
