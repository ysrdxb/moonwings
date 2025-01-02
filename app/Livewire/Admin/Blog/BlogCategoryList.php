<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BlogCategory;

class BlogCategoryList extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $categories = BlogCategory::where('name', 'like', '%' . $this->search . '%')
                                  ->paginate(12);

        return view('admin.blog.blog-category-list', [
            'categories' => $categories
        ]);
    }

    public function delete($id)
    {
        $blogCategory = BlogCategory::find($id);
        if ($blogCategory) {
            $blogCategory->delete();
            session()->flash('message', 'Blog category deleted successfully.');
        }
    }    
}