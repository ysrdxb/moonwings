<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h4>{{ $updateMode ? 'Edit Location' : 'Add Location' }}</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                    <div class="mb-3">
                        <label for="name">Location Name</label>
                        <input type="text" wire:model.defer="name" class="form-control" id="name" placeholder="Enter location name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="latitude">Latitude</label>
                        <input type="text" wire:model.defer="latitude" class="form-control" id="latitude" placeholder="Enter latitude">
                        @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="longitude">Longitude</label>
                        <input type="text" wire:model.defer="longitude" class="form-control" id="longitude" placeholder="Enter longitude">
                        @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3" wire:ignore>
                        <label for="country_id">Country {{ $country_id }}</label>
                        <select wire:model.defer="country_id" class="form-control select2" id="country_id" style="width: 100%">
                            <option value="">Select Country</option>
                        </select>
                        @error('country_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-3" wire:ignore>
                        <label for="city_id">City (Optional)</label>
                        <select wire:model.defer="city_id" class="form-control select2" id="city_id" style="width: 100%">
                            <option value="">Select City</option>
                        </select>
                        @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select wire:model.defer="status" class="form-control" id="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
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
                    @if($locations->count())
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($locations as $location)
                                    <tr>
                                        <td>{{ $location->id }}</td>
                                        <td>{{ $location->name }}</td>
                                        <td>{{ $location->country->name }}</td>
                                        <td>{{ optional($location->city)->name }}</td>
                                        <td>{{ $location->latitude }}</td>
                                        <td>{{ $location->longitude }}</td>
                                        <td>
                                            <span class="badge bg-{{ $location->status ? 'success' : 'secondary' }}">
                                                {{ $location->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button wire:click="edit({{ $location->id }})" class="btn btn-sm btn-primary">Edit</button>
                                            <button wire:click="delete({{ $location->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this location?') || event.stopImmediatePropagation()">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $locations->links() }}
                    @else
                        <p class="text-center">No locations found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        function initSelect2() {
            $('#country_id').select2({
                placeholder: 'Select a Country',
                allowClear: true,
                minimumInputLength: 3,
                ajax: {
                    delay: 250,
                    transport: function (params, success, failure) {
                        @this.call('searchCountries', params.data.term)
                            .then(success)
                            .catch(failure);
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    }
                }
            }).on('change', function () {
                @this.set('country_id', $(this).val());
            });

            $('#city_id').select2({
                placeholder: 'Select a City',
                allowClear: true,
                minimumInputLength: 3,
                ajax: {
                    delay: 250,
                    transport: function (params, success, failure) {
                        @this.call('searchCities', params.data.term)
                            .then(success)
                            .catch(failure);
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    }
                }
            }).on('change', function () {
                @this.set('city_id', $(this).val());
            });
        }

        initSelect2();

        Livewire.on('editMode', (event) => {
            const { selectedCountry, selectedCity } = event[0];

            if (selectedCountry) {
                const select2Country = $('#country_id');
                select2Country.empty().append(new Option(selectedCountry.name, selectedCountry.id, true, true));
                select2Country.trigger('change');
            }

            if (selectedCity) {
                const select2City = $('#city_id');
                select2City.empty().append(new Option(selectedCity.name, selectedCity.id, true, true));
                select2City.trigger('change');
            }
        });
    });
</script>
@endpush
