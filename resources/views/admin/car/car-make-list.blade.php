<div class="container-fluid">
    @include('message')
    @section('page_title', 'Car Makes')

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Search makes...">
                    </div>
                </div>
                <a href="{{ route('admin.car.make.create') }}" class="btn btn-primary">Add New Make</a>
            </div>

            @if($makes->count())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($makes as $make)
                                <tr>
                                    <td>{{ $make->id }}</td>
                                    <td>{{ $make->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.car.make.edit', $make->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button wire:click="delete({{ $make->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this make?') || event.stopImmediatePropagation()">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $makes->links() }}
                </div>
            @else
                <div class="alert alert-warning text-center">No makes found.</div>
            @endif
        </div>
    </div>
</div>