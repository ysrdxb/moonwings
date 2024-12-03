<?php

namespace App\Livewire\Admin\Car;

use Livewire\Component;
use App\Models\CarMake;

class CarMakeCrud extends Component
{
    public $makeId, $name;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255|unique:car_makes,name',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->updateMode = true;
            $make = CarMake::find($id);
            $this->makeId = $make->id;
            $this->name = $make->name;
        }
    }

    public function createOrUpdateMake()
    {
        $this->validate();

        if ($this->updateMode) {
            $make = CarMake::find($this->makeId);
            $make->update(['name' => $this->name]);
            session()->flash('success', 'Car make updated successfully.');
        } else {
            CarMake::create(['name' => $this->name]);
            session()->flash('success', 'Car make created successfully.');
        }

        return redirect()->route('admin.car.make');
    }

    public function render()
    {
        return view('admin.car.car-make-crud');
    }
}
