<div class="container-fluid">
    @include('message')

    <div class="card">
        <div class="card-header">
            <h4>{{ $updateMode ? 'Edit User' : 'Add User' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" wire:model.defer="firstname" class="form-control" id="firstname" placeholder="Enter first name">
                    @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" wire:model.defer="lastname" class="form-control" id="lastname" placeholder="Enter last name">
                    @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" wire:model.defer="username" class="form-control" id="username" placeholder="Enter username">
                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" wire:model.defer="email" class="form-control" id="email" placeholder="Enter email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" wire:model.defer="password" class="form-control" id="password" placeholder="Enter password">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select wire:model.defer="status" class="form-control" id="status">
                        <option value="active">Active</option>
                        <option value="pending">Pending</option>
                        <option value="blocked">Blocked</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select wire:model.defer="role" class="form-control" id="role">
                        <option value="admin">Admin</option>
                        <option value="customer">Customer</option>
                        <option value="supplier">Supplier</option>
                        <option value="agent">Agent</option>
                    </select>
                    @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="country_id" class="form-label">Country</label>
                    <select wire:model.defer="country_id" class="form-control" id="country_id">
                        <!-- Populate options from countries table -->
                    </select>
                    @error('country_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="city_id" class="form-label">City</label>
                    <select wire:model.defer="city_id" class="form-control" id="city_id">
                        <!-- Populate options from cities table -->
                    </select>
                    @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="language_id" class="form-label">Language</label>
                    <select wire:model.defer="language_id" class="form-control" id="language_id">
                        <!-- Populate options from languages table -->
                    </select>
                    @error('language_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea wire:model.defer="address" class="form-control" id="address" placeholder="Enter address"></textarea>
                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-success">{{ $updateMode ? 'Update' : 'Save' }}</button>
                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
</div>
