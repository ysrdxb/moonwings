<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h4>{{ $updateMode ? 'Edit Currency' : 'Add Currency' }}</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                    <div class="mb-3">
                        <label for="name">Currency Name</label>
                        <input type="text" wire:model.defer="name" class="form-control" id="name" placeholder="Enter currency name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="code">Currency Code</label>
                        <input type="text" wire:model.defer="code" class="form-control" id="code" placeholder="Enter currency code">
                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="symbol">Currency Symbol</label>
                        <input type="text" wire:model.defer="symbol" class="form-control" id="symbol" placeholder="Enter currency symbol">
                        @error('symbol') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="rate">Exchange Rate</label>
                        <input type="number" wire:model.defer="rate" class="form-control" id="rate" placeholder="Enter exchange rate">
                        @error('rate') <span class="text-danger">{{ $message }}</span> @enderror
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
                    @if($currencies->count())
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Symbol</th>
                                    <th>Exchange Rate</th>
                                    <th>Status</th>
                                    <th>Is Default</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($currencies as $currency)
                                    <tr>
                                        <td>{{ $currency->id }}</td>
                                        <td>{{ $currency->name }}</td>
                                        <td>{{ $currency->code }}</td>
                                        <td>{{ $currency->symbol }}</td>
                                        <td>{{ $currency->rate }}</td>
                                        <td>
                                            <span class="badge badge-{{ $currency->status ? 'success' : 'secondary' }}">
                                                {{ $currency->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $currency->is_default ? 'primary' : 'secondary' }}">
                                                {{ $currency->is_default ? 'Default' : 'No' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button wire:click="edit({{ $currency->id }})" class="btn btn-sm btn-primary">Edit</button>
                                            <button wire:click="delete({{ $currency->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this currency?') || event.stopImmediatePropagation()">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $currencies->links() }}
                    @else
                        <p class="text-center">No currencies found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
