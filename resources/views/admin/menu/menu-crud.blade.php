<div class="container-fluid">
    @include('message')

    <div class="row">
        <!-- Menu Form -->
        <div class="col-lg-4 col-md-5 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $menuId ? 'Edit Menu' : 'Add Menu' }}</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="{{ $menuId ? 'update' : 'store' }}">
                        <!-- Menu Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Menu Name</label>
                            <input type="text" wire:model.defer="name" class="form-control" id="name" placeholder="Enter menu name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Menu Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <select wire:model.defer="location" class="form-select" id="location">
                                <option value="">Select Location</option>
                                <option value="header">Header</option>
                                <option value="footer">Footer</option>
                            </select>
                            @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Menu Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select wire:model.defer="status" class="form-select" id="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Form Buttons -->
                        <button type="submit" class="btn btn-success">{{ $menuId ? 'Update' : 'Save' }}</button>
                        <button type="button" wire:click="resetInputFields" class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- Menu Items Form -->
            @if($showMenuItemsForm)
            @php $menu_name = $menu->name; @endphp
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Add Menu Item for {{ $menu_name }}</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="addMenuItem">
                        <!-- Item Title -->
                        <div class="mb-3">
                            <label for="itemTitle" class="form-label">Item Title</label>
                            <input type="text" wire:model.defer="newItemTitle" class="form-control" id="itemTitle" placeholder="Enter item title">
                            @error('newItemTitle') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="mb-3" @if(!$addCustomUrl) style="display:none;" @endif>
                            <label for="itemUrl" class="form-label">Custom URL (<a href="javascript:;" wire:click="toggleCustomUrl">Add Page</a>)</label>
                            <input type="url" wire:model.defer="newItemUrl" class="form-control" id="itemUrl" placeholder="Enter custom URL">
                            @error('newItemUrl') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3" @if($addCustomUrl) style="display:none;" @endif>
                            <label for="itemPageId" class="form-label">Page (<a href="javascript:;" wire:click="toggleCustomUrl">Add Custom Link</a>)</label>
                            <select wire:model.defer="newItemPageId" class="form-select" id="itemPageId">
                                <option value="">Select Page</option>
                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                            @error('newItemPageId') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <!-- Item Target -->
                        <div class="mb-3">
                            <label for="itemTarget" class="form-label">Target</label>
                            <select wire:model.defer="newItemTarget" class="form-select" id="itemTarget">
                                <option value="">Select Target</option>
                                <option value="_self">Same Tab</option>
                                <option value="_blank">New Tab</option>
                            </select>
                            @error('newItemTarget') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Item Order -->
                        <div class="mb-3">
                            <label for="itemOrder" class="form-label">Item Order</label>
                            <input type="number" wire:model.defer="newItemOrder" class="form-control" id="itemOrder" placeholder="Enter item order">
                            @error('newItemOrder') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Form Buttons -->
                        <button type="submit" class="btn btn-success">Add Item</button>
                        <button type="button" wire:click="resetItemFields" class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>
            @endif
        </div>

        <!-- Menu List and Menu Items Table -->
        <div class="col-lg-8 col-md-7 mb-4">
            <!-- Menu List -->
            <div class="card">
                <div class="card-header">
                    <h4>Menus</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td>{{ ucfirst($menu->location) }}</td>
                                <td>{{ $menu->status ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <button wire:click="edit({{ $menu->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button onclick="confirm('Are you sure you want to delete this?') || event.stopImmediatePropagation()" wire:click="delete({{ $menu->id }})" class="btn btn-danger btn-sm">Delete</button>
                                    <button wire:click="selectMenu({{ $menu->id }})" class="btn btn-info btn-sm">Manage Items</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No menus found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $menus->links() }}
                </div>
            </div>

            <!-- Menu Items Table -->
            @if($showMenuItemsForm)
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Menu Items for {{ $menu_name }}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Page</th>
                                <th>URL</th>
                                <th>Order</th>
                                <th>Target</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menuItems as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->page_id ? $item->page->title : 'N/A' }}</td>
                                <td>{{ $item->url }}</td>
                                <td>{{ $item->order }}</td>
                                <td>{{ $item->target ? ($item->target == '_blank' ? 'New Tab' : 'Same Tab') : 'Same Tab' }}</td>
                                <td>
                                    <button onclick="confirm('Are you sure you want to remove this?') || event.stopImmediatePropagation()" wire:click="removeMenuItem({{ $item->id }})" class="btn btn-danger btn-sm">Remove</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No items found for this menu.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
