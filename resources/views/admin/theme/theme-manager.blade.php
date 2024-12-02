<div>
    <div class="container-fluid">
        @include('core::message')
    
        <div class="row">
            <div class="col-lg-4 col-md-5 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $updateMode ? 'Edit Theme' : 'Add New Theme' }}</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Theme Name</label>
                                <input type="text" wire:model.defer="name" class="form-control" id="name" placeholder="Enter theme name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="folder_name" class="form-label">Folder Name</label>
                                @if($updateMode)
                                    <input type="text" readonly wire:model="folder_name" class="form-control">
                                @else
                                    <select wire:model="folder_name" class="form-control" id="folder_name">
                                        <option value="">Select Folder</option>
                                        @foreach($availableThemes as $theme)
                                            <option value="{{ $theme }}">{{ $theme }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @error('folder_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="header_menu_id" class="form-label">Header Menu</label>
                                <select wire:model="header_menu_id" class="form-control" id="header_menu_id">
                                    <option value="">Select Header Menu</option>
                                    @foreach($menus as $id => $menuName)
                                        <option value="{{ $id }}">{{ $menuName }}</option>
                                    @endforeach
                                </select>
                                @error('header_menu_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>                            
                            <div class="mb-3">
                                <label for="footer_menu_id" class="form-label">Footer Menu</label>
                                <select wire:model="footer_menu_id" class="form-control" id="footer_menu_id">
                                    <option value="">Select Footer Menu</option>
                                    @foreach($menus as $id => $menuName)
                                        <option value="{{ $id }}">{{ $menuName }}</option>
                                    @endforeach
                                </select>
                                @error('footer_menu_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" wire:model="is_default" class="form-check-input" id="is_default">
                                <label class="form-check-label" for="is_default">Set as Default</label>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update' : 'Save' }}</button>
                            <button type="button" class="btn btn-secondary" wire:click="cancel">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Manage Themes</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Folder Name</th>
                                    <th>Header Menu</th>
                                    <th>Footer Menu</th>
                                    <th>Default</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($themes as $theme)
                                    <tr>
                                        <td>{{ $theme->id }}</td>
                                        <td>{{ $theme->name }}</td>
                                        <td>{{ $theme->folder_name }}</td>
                                        <td>{{ $menus[$theme->footer_menu_id] ?? 'N/A' }}</td>
                                        <td>{{ $menus[$theme->header_menu_id] ?? 'N/A' }}</td>
                                        <td>{{ $theme->is_default ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <button wire:click="edit({{ $theme->id }})" class="btn btn-warning btn-sm">Edit</button>
                                            <button wire:click="delete({{ $theme->id }})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $themes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@script
<script>
    Livewire.on('showModal', modalId => {
        const modalElement = document.querySelector(modalId);
        if (modalElement) {
            const modalInstance = new bootstrap.Modal(modalElement);
            modalInstance.show();
        } else {
            console.error(`Modal with ID ${modalId} not found.`);
        }
    });

    Livewire.on('hideModal', modalId => {
        const modalElement = document.querySelector(modalId);
        if (modalElement) {
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
        } else {
            console.error(`Modal with ID ${modalId} not found.`);
        }
    });

    function confirmDelete(productId) {
        Livewire.dispatch('confirmDelete', productId);
    }
</script>
@endscript
