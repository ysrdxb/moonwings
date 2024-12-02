<?php

namespace App\Livewire\Admin\Hotel;

use Livewire\Component;
use App\Models\HotelAmenity;

class HotelAmenityCrud extends Component
{
    public $amenityId, $name;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255|unique:hotel_amenities,name',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->updateMode = true;
            $amenity = HotelAmenity::find($id);
            $this->amenityId = $amenity->id;
            $this->name = $amenity->name;
        }
    }

    public function createOrUpdateAmenity()
    {
        $this->validate();

        if ($this->updateMode) {
            $amenity = HotelAmenity::find($this->amenityId);
            $amenity->update([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Hotel amenity updated successfully.');
        } else {
            HotelAmenity::create([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Hotel amenity created successfully.');
        }

        return redirect()->route('admin.hotel.amenity');
    }

    public function render()
    {
        return view('admin.hotel.hotel-amenity-crud');
    }
}
