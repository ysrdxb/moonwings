<div class="container-fluid">
    @include('message')
    @section('page_title', 'Cities')

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Search cities...">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <select wire:model.live="countryFilter" class="form-control">
                        <option value="">All Countries</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">Add New City</a>
            </div>

            @if($cities->count())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Image</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <td>{{ $city->id }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->country->name }}</td>
                                    <td>
                                        @if($city->image)
                                            <img src="{{ asset('storage/'.$city->image) }}" width="100">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <button wire:click="delete({{ $city->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this city?') || event.stopImmediatePropagation()">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $cities->links() }}
                </div>
            @else
                <div class="alert alert-warning text-center">No cities found.</div>
            @endif
        </div>
    </div>
</div>
