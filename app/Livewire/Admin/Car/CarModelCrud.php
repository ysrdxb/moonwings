<?php

namespace App\Livewire\Admin\Car;

use Livewire\Component;
use App\Models\CarModel;
use App\Models\CarMake;

class CarModelCrud extends Component
{
    public $modelId, $name, $make_id;
    public $updateMode = false;
    public $makes;

    protected $rules = [
        'name' => 'required|string|max:255|unique:car_models,name',
        'make_id' => 'required|exists:car_makes,id',
    ];

    public function mount($id = null)
    {
        $this->makes = CarMake::all();

        if ($id) {
            $this->updateMode = true;
            $model = CarModel::find($id);
            $this->modelId = $model->id;
            $this->name = $model->name;
            $this->make_id = $model->make_id;
        }
    }

    public function createOrUpdateModel()
    {
        $this->validate();

        if ($this->updateMode) {
            $model = CarModel::find($this->modelId);
            $model->update([
                'name' => $this->name,
                'make_id' => $this->make_id,
            ]);
            session()->flash('success', 'Car model updated successfully.');
        } else {
            CarModel::create([
                'name' => $this->name,
                'make_id' => $this->make_id,
            ]);
            session()->flash('success', 'Car model created successfully.');
        }

        return redirect()->route('admin.car.model');
    }

    public function render()
    {
        return view('admin.car.car-model-crud');
    }
}
