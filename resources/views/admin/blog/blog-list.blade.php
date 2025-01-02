<div class="container-fluid">
    @include('message')
    @section('page_title', 'Blog Posts')

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Search posts...">
                    </div>
                </div>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Add New Blog Post</a>
            </div>

            @if($blogs->count())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->category->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($blog->status == 'draft') 
                                                bg-warning 
                                            @elseif($blog->status == 'published') 
                                                bg-success 
                                            @elseif($blog->status == 'archived') 
                                                bg-secondary 
                                            @endif
                                        ">
                                            {{ ucfirst($blog->status) }}
                                        </span>
                                    </td>                                    
                                    <td>{{ $blog->user->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button wire:click="delete({{ $blog->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this blog post?') || event.stopImmediatePropagation()">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $blogs->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-warning text-center">No blog posts found.</div>
            @endif
        </div>
    </div>
</div>
