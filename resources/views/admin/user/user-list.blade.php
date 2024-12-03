<!-- views/livewire/admin/user-list.blade.php -->
<div class="container-fluid">
    @include('message')

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Search users...">
                    </div>
                </div>
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Add New User</a>
            </div>

            @if($users->count())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->status) }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button wire:click="delete({{ $user->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this user?') || event.stopImmediatePropagation()">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-warning text-center">No users found.</div>
            @endif
        </div>
    </div>
</div>
