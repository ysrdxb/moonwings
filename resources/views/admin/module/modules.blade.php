<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-lg font-bold">Modules Management</h2>
                </div>
                <div class="card-body">
                    <!-- Show form toggle button -->
                    @if($showForm)
                        <button wire:click="toggleForm" class="btn btn-secondary mb-3">Back to Modules List</button>
                    @else
                        <button wire:click="toggleForm" class="btn btn-primary mb-3">Create Module</button>
                    @endif

                    <!-- Module creation form -->
                    @if($showForm)
                        <form wire:submit.prevent="saveModule">
                            <div class="mb-3">
                                <label for="name" class="form-label">Module Name</label>
                                <input wire:model="name" type="text" id="name" class="form-control">
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="api_key" class="form-label">API Key</label>
                                <input wire:model="api_key" type="text" id="api_key" class="form-control">
                                @error('api_key') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="api_secret" class="form-label">API Secret</label>
                                <input wire:model="api_secret" type="text" id="api_secret" class="form-control">
                                @error('api_secret') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="booking_type" class="form-label">Booking Type</label>
                                <select wire:model="booking_type" id="booking_type" class="form-select">
                                    <option value="onsite">Onsite</option>
                                    <option value="affiliate">Affiliate</option>
                                </select>
                                @error('booking_type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="currency_id" class="form-label">Currency</label>
                                <select wire:model="currency_id" id="currency_id" class="form-select">
                                    <option value="">Select Currency</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                    @endforeach
                                </select>
                                @error('currency_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select wire:model="status" id="status" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Save Module</button>
                        </form>
                    @else
                        <!-- List of modules -->
                        <h3 class="mt-6">Saved Modules</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Booking Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modules as $module)
                                    <tr>
                                        <td>{{ $module->name }}</td>
                                        <td>{{ $module->status }}</td>
                                        <td>{{ ucfirst($module->booking_type) }}</td>
                                        <td>
                                            <button wire:click="editModule({{ $module->id }})" class="btn btn-warning btn-sm">Edit</button>
                                            <button wire:click="deleteModule({{ $module->id }})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
