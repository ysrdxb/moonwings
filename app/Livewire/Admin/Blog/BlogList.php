<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogList extends Component
{
    use WithPagination;

    public $search = '';
    public $showForm = false;

    public function render()
    {
        $blogs = Blog::with('category', 'user')
            ->where('title', 'like', "%{$this->search}%")
            ->paginate(10);

        return view('admin.blog.blog-list', [
            'blogs' => $blogs,
            'categories' => BlogCategory::all(),
        ]);
    }

    public function delete($id)
    {
        Blog::find($id)->delete();
        session()->flash('message', 'Blog post deleted successfully.');
    }
}
