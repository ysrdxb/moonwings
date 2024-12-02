<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryCrud extends Component
{
    public $name, $slug, $blogCategoryId;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:blog_categories,slug,' . 'slug',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }

    public function render()
    {
        return view('admin.blog.blog-category-crud');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->slug = '';
    }

    public function store()
    {
        $this->validate();

        BlogCategory::create([
            'name' => $this->name,
            'slug' => $this->slug ?? Str::slug($this->name),
        ]);

        session()->flash('message', 'Blog category created successfully.');
        return redirect()->route('admin.blog.category');
    }

    public function edit($id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
        $this->blogCategoryId = $id;
        $this->name = $blogCategory->name;
        $this->slug = $blogCategory->slug;
        $this->updateMode = true;
    }       

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
        return redirect()->route('admin.blog.category');
    }

    public function update()
    {
        $this->validate();

        if ($this->blogCategoryId) {

            $blogCategory = BlogCategory::find($this->blogCategoryId);

            if ($this->slug !== $blogCategory->slug) {
                $rules['slug'] = 'required|string|max:255|unique:blog_categories,slug';
            } else {
                $rules['slug'] = 'required|string|max:255';
            }   
                     
            $blogCategory->update([
                'name' => $this->name,
                'slug' => $this->slug ?? Str::slug($this->name),
            ]);

            $this->updateMode = false;
            session()->flash('message', 'Blog category updated successfully.');
            return redirect()->route('admin.blog.category');
        }
    }
}
