<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use App\Models\Country;

class CountryCrud extends Component
{
    public $name, $status, $countryId;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'status' => 'required|boolean',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }

    public function render()
    {
        return view('admin.setting.country-crud');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->status = '';
    }

    public function store()
    {
        $this->validate();

        Country::create([
            'name' => $this->name,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Country created successfully.');
        return redirect()->route('admin.countries');
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        $this->countryId = $id;
        $this->name = $country->name;
        $this->status = $country->status;
        $this->updateMode = true;
    }       

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
        return redirect()->route('admin.countries');
    }

    public function update()
    {
        $this->validate();

        if ($this->countryId) {
            $country = Country::find($this->countryId);
            $country->update([
                'name' => $this->name,
                'status' => $this->status,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'Country updated successfully.');
            return redirect()->route('admin.countries');
        }
    }
}
