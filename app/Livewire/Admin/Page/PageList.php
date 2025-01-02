<?php

namespace App\Livewire\Admin\Page;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Page;

class PageList extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $pages = Page::where('title', 'like', '%' . $this->search . '%')
                     ->paginate(12);
        return view('admin.page.page-list', [
            'pages' => $pages,
        ]);
    }

    public function delete($id)
    {
        $page = Page::find($id);
        if ($page) {
            $page->delete();
            session()->flash('message', 'Page deleted successfully.');
        }
    }
}
