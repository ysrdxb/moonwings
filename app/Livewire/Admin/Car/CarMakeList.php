<?php

namespace App\Livewire\Admin\Car;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CarMake;

class CarMakeList extends Component
{
    use WithPagination;

    public $search = '';
    public $makeIdToDelete;

    protected $listeners = ['deleteConfirmed' => 'deleteMake'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->makeIdToDelete = $id;
        $this->dispatchBrowserEvent('confirm-delete');
    }

    public function deleteMake()
    {
        $make = CarMake::find($this->makeIdToDelete);

        if ($make) {
            $make->delete();
            session()->flash('success', 'Car make deleted successfully.');
        }

        $this->reset('makeIdToDelete');
    }

    public function render()
    {
        $makes = CarMake::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('admin.car.car-make-list', [
            'makes' => $makes
        ]);
    }
}
