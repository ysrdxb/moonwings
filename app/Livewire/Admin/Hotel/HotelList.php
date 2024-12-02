<?php

namespace App\Livewire\Admin\Hotel;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Hotel;

class HotelList extends Component
{
    use WithPagination;

    public $search = '';
    public $hotelIdToDelete;

    protected $listeners = ['deleteConfirmed' => 'deleteHotel'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->hotelIdToDelete = $id;
        $this->dispatch('confirm-delete');
    }

    public function deleteHotel()
    {
        $hotel = Hotel::find($this->hotelIdToDelete);

        if ($hotel) {
            $hotel->delete();
            session()->flash('message', 'Hotel deleted successfully.');
            $this->dispatch('hideModal');
        }

        $this->reset('hotelIdToDelete');
    }

    public function render()
    {
        $hotels = Hotel::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('admin.hotel.hotel-list', [
            'hotels' => $hotels
        ]);
    }
}
