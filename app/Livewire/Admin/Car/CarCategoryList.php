<?php

namespace App\Livewire\Admin\Car;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CarCategory;

class CarCategoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryIdToDelete;

    protected $listeners = ['deleteConfirmed' => 'deleteCategory'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->categoryIdToDelete = $id;
        $this->dispatchBrowserEvent('confirm-delete');
    }

    public function deleteCategory()
    {
        $category = CarCategory::find($this->categoryIdToDelete);

        if ($category) {
            $category->delete();
            session()->flash('success', 'Category deleted successfully.');
        }

        $this->reset('categoryIdToDelete');
    }

    public function render()
    {
        $categories = CarCategory::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('admin.car.car-category-list', [
            'categories' => $categories
        ]);
    }
}
