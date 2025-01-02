<?php

namespace App\Livewire\Admin\Car;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CarModel;

class CarModelList extends Component
{
    use WithPagination;

    public $search = '';
    public $modelIdToDelete;

    protected $listeners = ['deleteConfirmed' => 'deleteModel'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->modelIdToDelete = $id;
        $this->dispatchBrowserEvent('confirm-delete');
    }

    public function deleteModel()
    {
        $model = CarModel::find($this->modelIdToDelete);

        if ($model) {
            $model->delete();
            session()->flash('success', 'Car model deleted successfully.');
        }

        $this->reset('modelIdToDelete');
    }

    public function render()
    {
        $models = CarModel::with('make')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('admin.car.car-model-list', [
            'models' => $models
        ]);
    }
}
