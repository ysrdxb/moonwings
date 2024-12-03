<div class="container-fluid">
    @include('message')
    @section('page_title', 'Car Categories')

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Search categories...">
                    </div>
                </div>
                <a href="{{ route('admin.car.category.create') }}" class="btn btn-primary">Add New Category</a>
            </div>

            @if($categories->count())
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
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.car.category.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button wire:click="delete({{ $category->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this category?') || event.stopImmediatePropagation()">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $categories->links() }}
                </div>
            @else
                <div class="alert alert-warning text-center">No categories found.</div>
            @endif
        </div>
    </div>
</div>

<script>
    window.addEventListener('confirm-delete', event => {
        $('#deleteConfirmationModal').modal('show');
    });
</script>
