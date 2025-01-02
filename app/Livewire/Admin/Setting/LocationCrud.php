<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Location;
use App\Models\Country;
use App\Models\City;

class LocationCrud extends Component
{
    use WithPagination;

    public $name, $city_id, $country_id, $status = true, $latitude, $longitude;
    public $updateMode = false;
    public $locationId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'country_id' => 'required|exists:countries,id',
        'city_id' => 'nullable|exists:cities,id',
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
        'status' => 'required|boolean',
    ];

    public function render()
    {
        return view('admin.setting.location-crud', [
            'locations' => Location::paginate(10),
        ]);
    }

    public function searchCountries($query)
    {
        return Country::where('name', 'like', "%{$query}%")->get()->map(function($country) {
            return ['id' => $country->id, 'text' => $country->name];
        });
    }
    
    public function searchCities($query)
    {
        if (strlen($query) >= 3 && $this->country_id) {
            return City::where('name', 'like', "%{$query}%")
                ->where('country_id', $this->country_id)
                ->get()->map(function($city) {
                    return ['id' => $city->id, 'text' => $city->name];
                });
        }
        return [];
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->city_id = '';
        $this->country_id = '';
        $this->status = true;
        $this->latitude = '';
        $this->longitude = '';
        $this->updateMode = false;
        $this->locationId = null;
    }

    public function store()
    {
        $this->validate();

        Location::create([
            'name' => $this->name,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Location created successfully.');
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate();

        if ($this->locationId) {
            $location = Location::find($this->locationId);
            $location->update([
                'name' => $this->name,
                'country_id' => $this->country_id,
                'city_id' => $this->city_id,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Location updated successfully.');
            $this->resetInputFields();
        }
    }
    
    public function delete($id)
    {
        Location::find($id)->delete();
        session()->flash('message', 'Location deleted successfully.');
    }    

    public function cancel()
    {
        $this->resetInputFields();
    }    

    public function edit($id)
    {
        $location = Location::findOrFail($id);
        $this->locationId = $id;
        $this->name = $location->name;
        $this->city_id = $location->city_id;
        $this->country_id = $location->country_id;
        $this->latitude = $location->latitude;
        $this->longitude = $location->longitude;
        $this->status = $location->status;
        $this->updateMode = true;
    
        // Fetch selected country
        $selectedCountry = Country::find($this->country_id);
        $selectedCity = City::find($this->city_id);
    
        $this->dispatch('editMode', [
            'selectedCountry' => $selectedCountry,
            'selectedCity' => $selectedCity
        ]);
    }
    
    
}
