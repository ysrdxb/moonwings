<?php

namespace App\Livewire\Admin\Car;

use Livewire\Component;
use App\Models\CarCategory;

class CarCategoryCrud extends Component
{
    public $categoryId, $name;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255|unique:car_categories,name',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->updateMode = true;
            $category = CarCategory::find($id);
            $this->categoryId = $category->id;
            $this->name = $category->name;
        }
    }

    public function createOrUpdateCategory()
    {
        $this->validate();

        if ($this->updateMode) {
            $category = CarCategory::find($this->categoryId);
            $category->update([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Car category updated successfully.');
        } else {
            CarCategory::create([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Car category created successfully.');
        }

        return redirect()->route('admin.car.category');
    }

    public function render()
    {
        return view('admin.car.car-category-crud');
    }
}
