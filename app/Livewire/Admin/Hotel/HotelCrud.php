<?php

namespace App\Livewire\Admin\Hotel;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Hotel;
use App\Models\HotelAmenity;
use App\Models\HotelRoom;
use App\Models\Location;
use Illuminate\Support\Str;
use Auth;

class HotelCrud extends Component
{
    use WithFileUploads;

    public $hotelId, $name, $description, $address, $location_id, $postal_code, $latitude, $longitude;
    public $rating = 0, $stars = 1, $phone, $email, $is_featured = false, $status = true;
    public $image, $gallery = [], $video_link, $min_age = 1, $checkin_time, $checkout_time;
    public $meta_title, $meta_description;
    public $selectedAmenities = [];
    public $rooms = [];
    public $updateMode = false;

    public function mount($id = null)
    {
        if ($id) {
            $this->updateMode = true;
            $hotel = Hotel::with('amenities', 'rooms')->find($id);
    
            $this->hotelId = $hotel->id;
            $this->name = $hotel->name;
            $this->description = $hotel->description;
            $this->address = $hotel->address;
            $this->location_id = $hotel->location_id;
            $this->postal_code = $hotel->postal_code;
            $this->latitude = $hotel->latitude;
            $this->longitude = $hotel->longitude;
            $this->rating = $hotel->rating;
            $this->stars = $hotel->stars;
            $this->phone = $hotel->phone;
            $this->email = $hotel->email;
            $this->is_featured = $hotel->is_featured;
            $this->status = $hotel->status;
            $this->video_link = $hotel->video_link;
            $this->min_age = $hotel->min_age;
            $this->checkin_time = $hotel->checkin_time;
            $this->checkout_time = $hotel->checkout_time;
            $this->meta_title = $hotel->meta_title;
            $this->meta_description = $hotel->meta_description;
            $this->selectedAmenities = $hotel->amenities->pluck('id')->toArray();
            $this->rooms = $hotel->rooms->toArray();
        }
    }    

    public function saveGeneralInformation()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        // Save or update hotel general information
        if ($this->updateMode) {
            $hotel = Hotel::find($this->hotelId);
            $hotel->update($validatedData);

            // Handle file uploads
            if ($this->image) {
                $hotel->image = $this->image->store('hotels', 'public');
            }
            if ($this->gallery) {
                foreach ($this->gallery as $file) {
                    $hotel->gallery()->create(['path' => $file->store('hotel_gallery', 'public')]);
                }
            }
        } else {
            $hotel = Hotel::create($validatedData);

            // Handle file uploads
            if ($this->image) {
                $hotel->image = $this->image->store('hotels', 'public');
            }
            if ($this->gallery) {
                foreach ($this->gallery as $file) {
                    $hotel->gallery()->create(['path' => $file->store('hotel_gallery', 'public')]);
                }
            }
        }

        session()->flash('message', $this->updateMode ? 'Hotel updated successfully.' : 'Hotel added successfully.');
        $this->dispatch('saved');
    }

    public function saveLocationInformation()
    {
        $validatedData = $this->validate([
            'address' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'postal_code' => 'nullable|string|max:10',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $hotel = Hotel::find($this->hotelId);
        $hotel->update($validatedData);

        session()->flash('message', $this->updateMode ? 'Hotel location updated successfully.' : 'Hotel location saved successfully.');
        $this->dispatch('saved');
    }

    public function saveDetails()
    {
        $validatedData = $this->validate([
            'rating' => 'nullable|integer|between:0,5',
            'stars' => 'required|integer|min:1|max:5',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'checkin_time' => 'nullable|string|max:5',
            'checkout_time' => 'nullable|string|max:5',
        ]);

        $hotel = Hotel::find($this->hotelId);
        $hotel->update($validatedData);

        session()->flash('message', $this->updateMode ? 'Hotel details updated successfully.' : 'Hotel details saved successfully.');
        $this->dispatch('saved');
    }

    public function saveAmenities()
    {
        $validatedData = $this->validate([
            'selectedAmenities' => 'array',
            'selectedAmenities.*' => 'exists:hotel_amenities,id',
        ]);
    
        $hotel = Hotel::find($this->hotelId);
        $hotel->amenities()->sync($validatedData['selectedAmenities']);
    
        session()->flash('message', $this->updateMode ? 'Hotel amenities updated successfully.' : 'Hotel amenities saved successfully.');
        $this->dispatch('saved');
    }    

    public function saveRoom()
    {
        // Validate room data
        $validatedData = $this->validate([
            'rooms.*.room_type' => 'required|in:Standard,Deluxe,Suite,Family,Executive,Single,Double',
            'rooms.*.capacity' => 'required|integer|min:1',
            'rooms.*.price' => 'required|numeric|min:0',
            'rooms.*.facilities' => 'nullable|string|max:1000',
            'rooms.*.is_available' => 'boolean',
        ]);
    
        foreach ($this->rooms as $roomData) {
            // Ensure that the room data includes a hotel_id if needed
            $roomData['hotel_id'] = $this->hotelId; // Replace with the actual hotel ID logic if different
    
            // Update or create room
            HotelRoom::updateOrCreate(
                ['id' => $roomData['id'] ?? null], // If ID exists, update; otherwise, create a new record
                $roomData
            );
        }
    
        // Success message and dispatch
        session()->flash('message', 'Hotel rooms saved successfully.');
        $this->dispatch('saved');
    }      

    public function addRoom()
    {
        $this->rooms[] = ['room_name' => '', 'capacity' => 1, 'price' => 0, 'facilities' => ''];
    }
    
    public function removeRoom($index)
    {
        unset($this->rooms[$index]);
        $this->rooms = array_values($this->rooms); // Re-index the array
    }
    

    public function render()
    {
        $locations = Location::all();
        $amenities = HotelAmenity::all();
        return view('admin.hotel.hotel-crud', compact('locations', 'amenities'));
    }
}
