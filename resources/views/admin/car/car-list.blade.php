<div class="container-fluid">
    @include('message')
    @section('page_title', 'Cars')

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Search input -->
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Search cars by make, model, or license plate...">
                    </div>
                </div>
                <!-- Add Car Button -->
                <a href="{{ route('admin.car.create') }}" class="btn btn-primary">Add New Car</a>
            </div>

            @if($cars->count())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>License Plate</th>
                                <th>Category</th> <!-- New Column -->
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $car)
                                <tr>
                                    <td>{{ $car->id }}</td>
                                    <td>
                                        @if ($car->image)
                                            <img src="{{ asset('storage/images/' . basename($car->image)) }}" alt="Car Image" style="max-width: 100px; max-height: 100px;">
                                        @else
                                            No image available
                                        @endif
                                    </td>
                                    <td>{{ $car->name }}</td>
                                    <td>{{ $car->model->make->name }}</td>
                                    <td>{{ $car->model->name }}</td>
                                    <td>{{ $car->year }}</td>
                                    <td>{{ $car->license_plate }}</td>
                                    <td>{{ $car->category->name ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.car.edit', $car->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button wire:click="delete({{ $car->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this car?') || event.stopImmediatePropagation()">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    {{ $cars->links() }}
                </div>
            @else
                <div class="alert alert-warning text-center">No cars found. Try adjusting your search.</div> <!-- Enhanced feedback message -->
            @endif
        </div>
    </div>
</div>
