<div class="container-fluid">
    @include('message')

    <div class="card">
        <div class="card-header">
            <h4>{{ $updateMode ? 'Edit Blog Post' : 'Add Blog Post' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" wire:model.defer="title" class="form-control" id="title" placeholder="Enter blog title">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control" id="slug" placeholder="Enter slug">
                    @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea wire:model.defer="content" class="form-control" id="content" rows="5" placeholder="Enter content"></textarea>
                    @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="banner_image" class="form-label">Banner Image</label>
                    <input type="text" wire:model.defer="banner_image" class="form-control" id="banner_image" placeholder="Enter banner image URL">
                    @error('banner_image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="main_image" class="form-label">Main Image</label>
                    <input type="text" wire:model.defer="main_image" class="form-control" id="main_image" placeholder="Enter main image URL">
                    @error('main_image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select wire:model.defer="status" class="form-control" id="status">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="blog_category_id" class="form-label">Category</label>
                    <select wire:model.defer="blog_category_id" class="form-control" id="blog_category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('blog_category_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-success">{{ $updateMode ? 'Update' : 'Save' }}</button>
                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
</div>
