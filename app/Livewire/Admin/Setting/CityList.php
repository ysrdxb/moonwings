<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\City;
use App\Models\Country;

class CityList extends Component
{
    use WithPagination;

    public $search = '';
    public $countryFilter = '';

    public function render()
    {
        $cities = City::where('name', 'like', '%' . $this->search . '%')
                      ->when($this->countryFilter, function ($query) {
                          $query->where('country_id', $this->countryFilter);
                      })
                      ->paginate(12);

        $countries = Country::all();

        return view('admin.setting.city-list', [
            'cities' => $cities,
            'countries' => $countries,
        ]);
    }

    public function delete($id)
    {
        $city = City::find($id);
        if ($city) {
            // Delete the image file from storage if it exists
            if ($city->image) {
                \Storage::disk('public')->delete($city->image);
            }

            $city->delete();
            session()->flash('message', 'City deleted successfully.');
        }
    }
}
