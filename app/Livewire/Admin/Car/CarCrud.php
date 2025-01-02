<?php

namespace App\Livewire\Admin\Car;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Car;
use App\Models\CarCategory;
use App\Models\CarModel;

class CarCrud extends Component
{
    use WithFileUploads;

    public $model_id, $year, $license_plate, $category_id, $is_featured, $featured_from, $featured_to;
    public $seating_capacity, $transmission, $color, $doors, $baggage, $fuel_type, $daily_rate, $hourly_rate, $per_km_rate; 
    public $status, $is_available, $transfer_mode, $rental_mode, $meta_title, $meta_description;
    public $image, $gallery = [], $video_link;
    public $colors = ['red', 'blue', 'black', 'white', 'silver', 'green']; 
    public $carId;
    public $updateMode = false;

    protected $rules = [
        'model_id' => 'required|exists:car_models,id',
        'year' => 'required|integer|min:1900|max:2024',
        'license_plate' => 'required|string|max:255|unique:cars,license_plate',
        'category_id' => 'required|exists:car_categories,id',
        'is_featured' => 'nullable|boolean',
        'featured_from' => 'nullable|date',
        'featured_to' => 'nullable|date|after_or_equal:featured_from',
        'seating_capacity' => 'required|integer|min:1',
        'transmission' => 'required|string|max:255',
        'color' => 'nullable|string|max:255',
        'doors' => 'nullable|integer|min:0',
        'baggage' => 'nullable|integer|min:0',
        'fuel_type' => 'required|string|max:255',
        'daily_rate' => 'required|numeric|min:0',
        'hourly_rate' => 'nullable|numeric|min:0',
        'per_km_rate' => 'nullable|numeric|min:0',
        'transfer_mode' => 'nullable|integer|in:0,1',
        'rental_mode' => 'nullable|integer|in:0,1',
        'status' => 'nullable|string|in:active,pending,booked',
        'is_available' => 'nullable|integer|in:0,1',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
        'gallery.*' => 'nullable|image|max:2048',
        'video_link' => 'nullable|url',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }

    public function render()
    {
        $categories = CarCategory::all();
        $models = CarModel::all();
        $colors = $this->colors;
        return view('admin.car.car-crud', compact('categories', 'models', 'colors'));
    }

    public function resetInputFields()
    {
        $this->model_id = '';
        $this->year = '';
        $this->license_plate = '';
        $this->category_id = '';
        $this->is_featured = false;
        $this->featured_from = null;
        $this->featured_to = null;
        $this->seating_capacity = '';
        $this->transmission = '';
        $this->color = '';
        $this->doors = '';
        $this->baggage = '';
        $this->fuel_type = '';
        $this->daily_rate = '';
        $this->hourly_rate = '';
        $this->per_km_rate = '';
        $this->is_available = '';
        $this->status = '';
        $this->transfer_mode = '';
        $this->rental_mode = '';
        $this->meta_title = '';
        $this->meta_description = '';
        $this->image = null;
        $this->gallery = [];
        $this->video_link = '';
        $this->carId = null;
    }

    public function store()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
        }

        $galleryPaths = [];
        if ($this->gallery) {
            foreach ($this->gallery as $image) {
                $galleryPaths[] = $image->store('images', 'public');
            }
        }

        $model = CarModel::find($this->model_id);
        $category = CarCategory::find($this->category_id);
        $carName = $model->make->name . ' ' . $model->name . ' ' . $this->year . ' ' . $this->color . ' ' .$category->name;
        Car::create([
            'name' => $carName,
            'slug' => Str::slug($carName . ' ' . rand(0000, 9999)),
            'model_id' => $this->model_id,
            'year' => $this->year,
            'license_plate' => $this->license_plate,
            'category_id' => $this->category_id,
            'is_featured' => $this->is_featured ?? false,
            'featured_from' => $this->featured_from,
            'featured_to' => $this->featured_to,
            'seating_capacity' => $this->seating_capacity,
            'transmission' => $this->transmission,
            'color' => $this->color,
            'doors' => $this->doors,
            'baggage' => $this->baggage,
            'fuel_type' => $this->fuel_type,
            'daily_rate' => $this->daily_rate,
            'hourly_rate' => $this->hourly_rate,
            'per_km_rate' => $this->per_km_rate,
            'rental_mode' => $this->rental_mode,
            'transfer_mode' => $this->transfer_mode,
            'is_available' => $this->is_available,
            'status' => $this->status,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'image' => $imagePath,
            'gallery' => json_encode($galleryPaths),
            'video_link' => $this->video_link,
            'user_id' => Auth::id(),
        ]);

        session()->flash('message', 'Car created successfully.');
        $this->resetInputFields();
        return redirect()->route('admin.car');
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $car = Car::findOrFail($id);
        $this->carId = $car->id;
        $this->model_id = $car->model_id;
        $this->year = $car->year;
        $this->license_plate = $car->license_plate;
        $this->category_id = $car->category_id;
        $this->is_featured = $car->is_featured;
        $this->featured_from = $car->featured_from;
        $this->featured_to = $car->featured_to;
        $this->seating_capacity = $car->seating_capacity;
        $this->transmission = $car->transmission;
        $this->color = $car->color;
        $this->doors = $car->doors;
        $this->baggage = $car->baggage;
        $this->fuel_type = $car->fuel_type;
        $this->daily_rate = $car->daily_rate;
        $this->hourly_rate = $car->hourly_rate;
        $this->per_km_rate = $car->per_km_rate;
        $this->meta_title = $car->meta_title;
        $this->meta_description = $car->meta_description;
        // $this->image = $car->image; 
        // $this->gallery = json_decode($car->gallery, true) ?? [];
        $this->video_link = $car->video_link;
        $this->rental_mode = $car->rental_mode;
        $this->transfer_mode = $car->transfer_mode;
        $this->is_available = $car->is_available;
        $this->status = $car->status;
    }

    public function update()
    {
        $car = Car::findOrFail($this->carId);

        $rules = $this->rules;

        if ($this->license_plate !== $car->license_plate) {
            $rules['license_plate'] = 'required|string|max:255|unique:cars,license_plate';
        } else {
            $rules['license_plate'] = 'required|string|max:255';
        }

        $this->validate($rules);

        $imagePath = $car->image; 

        if ($this->image && $this->image !== $car->image) {
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }
            $imagePath = $this->image->store('images', 'public');
        }

        if ($this->gallery) {
            $rules['gallery.*'] = 'nullable|image|max:2048';
        } else {
            unset($rules['gallery.*']);
        }

        $imagePath = $car->image;
        if ($this->image) {
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }
            $imagePath = $this->image->store('images', 'public');
        }

        $galleryPaths = json_decode($car->gallery, true) ?? [];
        if ($this->gallery) {
            foreach ($galleryPaths as $oldImage) {
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $galleryPaths = [];
            foreach ($this->gallery as $image) {
                $galleryPaths[] = $image->store('images', 'public');
            }
        }

        $car->update([
            'slug' => Str::slug($this->model_id . ' ' . $this->year),
            'model_id' => $this->model_id,
            'year' => $this->year,
            'license_plate' => $this->license_plate,
            'category_id' => $this->category_id,
            'is_featured' => $this->is_featured ?? false,
            'featured_from' => $this->featured_from,
            'featured_to' => $this->featured_to,
            'seating_capacity' => $this->seating_capacity,
            'transmission' => $this->transmission,
            'color' => $this->color,
            'doors' => $this->doors,
            'baggage' => $this->baggage,
            'fuel_type' => $this->fuel_type,
            'daily_rate' => $this->daily_rate,
            'hourly_rate' => $this->hourly_rate,
            'per_km_rate' => $this->per_km_rate,
            'is_available' => $this->is_available,
            'rental_mode' => $this->rental_mode,
            'transfer_mode' => $this->transfer_mode,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,            
            'status' => $this->status,
            'image' => $imagePath,
            'gallery' => json_encode($galleryPaths),
            'video_link' => $this->video_link,
            'user_id' => Auth::id(),
        ]);

        session()->flash('message', 'Car updated successfully.');
        $this->resetInputFields();
        $this->updateMode = false;
        return redirect()->route('admin.car');
    }

    public function delete($id)
    {
        Car::find($id)->delete();
        session()->flash('message', 'Car deleted successfully.');
    }
}
