<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\City;
use App\Models\Country;

class CityCrud extends Component
{
    use WithFileUploads;

    public $name, $country_id, $image, $cityId;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'country_id' => 'required|exists:countries,id',
        'image' => 'nullable|image|max:1024', // Image max 1MB
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }

    public function render()
    {
        $countries = Country::where('status', 1)->get();
        return view('admin.setting.city-crud', compact('countries'));
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->country_id = '';
        $this->image = '';
    }

    public function store()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('cities', 'public') : null;

        City::create([
            'name' => $this->name,
            'country_id' => $this->country_id,
            'image' => $imagePath,
        ]);

        session()->flash('message', 'City created successfully.');
        return redirect()->route('admin.cities');
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        $this->cityId = $id;
        $this->name = $city->name;
        $this->country_id = $city->country_id;
        $this->image = $city->image;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate();

        $city = City::find($this->cityId);
        $imagePath = $this->image ? $this->image->store('cities', 'public') : $city->image;

        $city->update([
            'name' => $this->name,
            'country_id' => $this->country_id,
            'image' => $imagePath,
        ]);

        $this->updateMode = false;
        session()->flash('message', 'City updated successfully.');
        return redirect()->route('admin.cities');
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->updateMode = false;
        return redirect()->route('admin.cities');
    }
}
