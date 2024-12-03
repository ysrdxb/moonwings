<div class="container-fluid">
    @include('message')
    @section('page_title', 'Car Models')

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Search models...">
                    </div>
                </div>
                <a href="{{ route('admin.car.model.create') }}" class="btn btn-primary">Add New Model</a>
            </div>

            @if($models->count())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Make</th> <!-- Display Make Name -->
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($models as $model)
                                <tr>
                                    <td>{{ $model->id }}</td>
                                    <td>{{ $model->name }}</td>
                                    <td>{{ $model->make->name }}</td> <!-- Show Make name here -->
                                    <td class="text-center">
                                        <a href="{{ route('admin.car.model.edit', $model->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button wire:click="delete({{ $model->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this model?') || event.stopImmediatePropagation()">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $models->links() }}
                </div>
            @else
                <div class="alert alert-warning text-center">No models found.</div>
            @endif
        </div>
    </div>
</div>
