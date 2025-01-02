<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Country;

class CountryList extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $countries = Country::where('name', 'like', '%' . $this->search . '%')
                                  ->paginate(12);

        return view('admin.setting.country-list', [
            'countries' => $countries
        ]);
    }

    public function delete($id)
    {
        $country = Country::find($id);
        if ($country) {
            $country->delete();
            session()->flash('message', 'Country deleted successfully.');
        }
    }    
}