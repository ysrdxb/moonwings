<?php

namespace App\Livewire\Admin\Hotel;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HotelAmenity;

class HotelAmenityList extends Component
{
    use WithPagination;

    public $search = '';
    public $amenityIdToDelete;

    protected $listeners = ['deleteConfirmed' => 'deleteAmenity'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->amenityIdToDelete = $id;
        $this->dispatch('confirm-delete');
    }

    public function deleteAmenity()
    {
        $amenity = HotelAmenity::find($this->amenityIdToDelete);

        if ($amenity) {
            $amenity->delete();
            session()->flash('message', 'Hotel amenity deleted successfully.');
            $this->dispatch('hide-modal');
        }

        $this->reset('amenityIdToDelete');
    }

    public function render()
    {
        $amenities = HotelAmenity::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('admin.hotel.hotel-amenity-list', [
            'amenities' => $amenities
        ]);
    }
}
