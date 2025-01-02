<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogCrud extends Component
{
    public $title, $slug, $content, $banner_image, $main_image, $status, $blog_category_id, $blogId;
    public $updateMode = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:blogs,slug',
        'content' => 'required|string',
        'banner_image' => 'nullable|string|max:255',
        'main_image' => 'nullable|string|max:255',
        'status' => 'required|in:draft,published,archived',
        'blog_category_id' => 'nullable|exists:blog_categories,id',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }    

    public function render()
    {
        return view('admin.blog.blog-crud', [
            'blogs' => Blog::with('category', 'user')->paginate(12),
            'categories' => BlogCategory::all(),
        ]);
    }

    public function resetInputFields()
    {
        $this->title = '';
        $this->slug = '';
        $this->content = '';
        $this->banner_image = '';
        $this->main_image = '';
        $this->status = 'draft';
        $this->blog_category_id = null;
        $this->blogId = null;
    }

    public function store()
    {
        $this->validate();

        Blog::create([
            'title' => $this->title,
            'slug' => $this->slug ? $this->slug : Str::slug($this->title),
            'content' => $this->content,
            'banner_image' => $this->banner_image,
            'main_image' => $this->main_image,
            'status' => $this->status,
            'blog_category_id' => $this->blog_category_id,
            'user_id' => Auth::id(),
        ]);

        session()->flash('message', 'Blog post created successfully.');
        $this->resetInputFields();
        return redirect()->route('admin.blog');

    }

    public function edit($id)
    {
        $this->updateMode = true;

        $blog = Blog::findOrFail($id);
        $this->blogId = $blog->id;
        $this->title = $blog->title;
        $this->slug = $blog->slug;
        $this->content = $blog->content;
        $this->banner_image = $blog->banner_image;
        $this->main_image = $blog->main_image;
        $this->status = $blog->status;
        $this->blog_category_id = $blog->blog_category_id;
    }

    public function update()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'banner_image' => 'nullable|string|max:255',
            'main_image' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,archived',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
        ];
    
        // Check if the slug has changed
        $blog = Blog::find($this->blogId);
        
        if ($this->slug !== $blog->slug) {
            $rules['slug'] = 'required|string|max:255|unique:blogs,slug';
        } else {
            $rules['slug'] = 'required|string|max:255';
        }
    
        // Validate the form with the modified rules
        $this->validate($rules);
    
        // Update the blog
        $blog->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'banner_image' => $this->banner_image,
            'main_image' => $this->main_image,
            'status' => $this->status,
            'blog_category_id' => $this->blog_category_id,
        ]);
    
        session()->flash('message', 'Blog post updated successfully.');
        $this->resetInputFields();
        $this->updateMode = false;
        return redirect()->route('admin.blog');
    }
    

    public function cancel()
    {
        $this->resetInputFields();
        $this->updateMode = false;
        return redirect()->route('admin.blog');
    }
}
