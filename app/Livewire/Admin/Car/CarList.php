<?php

namespace App\Livewire\Admin\Car;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Car;

class CarList extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $cars = Car::with(['model.make', 'category'])
                    ->whereHas('model.make', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%");
                    })
                    ->orWhereHas('model', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%");
                    })
                    ->orWhere('license_plate', 'like', "%{$this->search}%")
                    ->paginate(10);

        return view('admin.car.car-list', [
            'cars' => $cars,
        ]);
    }

    public function delete($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        session()->flash('message', 'Car deleted successfully.');
    }
}
