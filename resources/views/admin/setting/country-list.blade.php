<div class="container-fluid">
    @include('message')
    @section('page_title', 'Countries')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Search countries...">
                    </div>
                </div>
                <a href="{{ route('admin.countries.create') }}" class="btn btn-primary">Add New Country</a>
            </div>

            @if($countries->count())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $country)
                                <tr>
                                    <td>{{ $country->id }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.countries.edit', $country->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <button wire:click="delete({{ $country->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this country?') || event.stopImmediatePropagation()">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $countries->links() }}
                </div>
            @else
                <div class="alert alert-warning text-center">No countries found.</div>
            @endif
        </div>
    </div>
</div>
