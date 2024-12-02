<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h4>{{ $updateMode ? 'Edit Language' : 'Add Language' }}</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                    <div class="mb-3">
                        <label for="name">Language Name</label>
                        <input type="text" wire:model.defer="name" class="form-control" id="name" placeholder="Enter language name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="code">Language Code</label>
                        <input type="text" wire:model.defer="code" class="form-control" id="code" placeholder="Enter language code">
                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="direction">Direction</label>
                        <select wire:model.defer="direction" class="form-control" id="direction">
                            <option value="">Select</option>
                            <option value="LTR">Left-to-Right (LTR)</option>
                            <option value="RTL">Right-to-Left (RTL)</option>
                        </select>
                        @error('direction') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select wire:model.defer="status" class="form-control" id="status">
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_default">Is Default</label>
                        <select wire:model.defer="is_default" class="form-control" id="is_default">
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('is_default') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-success">{{ $updateMode ? 'Update' : 'Save' }}</button>
                    <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div>
            @include('core::message')
            <div class="card">
                <div class="card-body">
                    @if($languages->count())
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Direction</th>
                                    <th>Status</th>
                                    <th>Is Default</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($languages as $language)
                                    <tr>
                                        <td>{{ $language->id }}</td>
                                        <td>{{ $language->name }}</td>
                                        <td>{{ $language->code }}</td>
                                        <td>{{ $language->direction }}</td>
                                        <td>
                                            <span class="badge bg-{{ $language->status ? 'success' : 'secondary' }}">
                                                {{ $language->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $language->is_default ? 'primary' : 'secondary' }}">
                                                {{ $language->is_default ? 'Default' : 'No' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button wire:click="edit({{ $language->id }})" class="btn btn-sm btn-primary">Edit</button>
                                            <button wire:click="delete({{ $language->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this language?') || event.stopImmediatePropagation()">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $languages->links() }}
                    @else
                        <p class="text-center">No languages found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
