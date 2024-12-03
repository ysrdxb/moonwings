<div class="container-fluid">
    @include('message')
    @section('page_title', 'Hotels')

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Search hotels...">
                    </div>
                </div>
                <a href="{{ route('admin.hotel.create') }}" class="btn btn-primary">Add New Hotel</a>
            </div>

            @if($hotels->count())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hotels as $hotel)
                                <tr>
                                    <td>{{ $hotel->id }}</td>
                                    <td>{{ $hotel->name }}</td>
                                    <td>{{ $hotel->address }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.hotel.edit', $hotel->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button wire:click="confirmDelete({{ $hotel->id }})" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $hotels->links() }}
                </div>
            @else
                <div class="alert alert-warning text-center">No hotels found.</div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this hotel? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" wire:click="deleteHotel" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('confirm-delete', event => {
        $('#deleteConfirmationModal').modal('show');
    });
    window.addEventListener('hideModal', event => {
        $('#deleteConfirmationModal').modal('hide');
    });    
</script>
