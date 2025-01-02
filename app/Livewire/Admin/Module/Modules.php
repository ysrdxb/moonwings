<?php

namespace App\Livewire\Admin\Module;

use Livewire\Component;
use App\Models\Module;
use App\Models\Currency;

class Modules extends Component
{
    public $modules;
    public $currencies;
    public $name, $api_key, $api_secret, $booking_type = 'onsite', $currency_id, $status = 'inactive';
    public $showForm = false;
    public $editModuleId = null;

    public function mount()
    {
        $this->modules = Module::all();
        $this->currencies = Currency::all();
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        $this->resetForm();
    }

    public function saveModule()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:modules,name',
            'api_key' => 'nullable|string|max:255',
            'api_secret' => 'nullable|string|max:255',
            'booking_type' => 'required|in:onsite,affiliate',
            'currency_id' => 'nullable|exists:currencies,id',
            'status' => 'required|in:active,inactive',
        ]);

        Module::create([
            'name' => $this->name,
            'api_key' => $this->api_key,
            'api_secret' => $this->api_secret,
            'booking_type' => $this->booking_type,
            'currency_id' => $this->currency_id,
            'status' => $this->status,
        ]);

        $this->modules = Module::all();
        $this->showForm = false; 
        session()->flash('message', 'Module saved successfully!');
    }

    public function editModule($id)
    {
        $module = Module::find($id);
        if ($module) {
            $this->name = $module->name;
            $this->api_key = $module->api_key;
            $this->api_secret = $module->api_secret;
            $this->booking_type = $module->booking_type;
            $this->currency_id = $module->currency_id;
            $this->status = $module->status;
            $this->editModuleId = $module->id;
            $this->showForm = true;
        }
    }

    public function deleteModule($id)
    {
        $module = Module::find($id);
        if ($module) {
            $module->delete();
            $this->modules = Module::all(); 
            session()->flash('message', 'Module deleted successfully!');
        }
    }

    public function resetForm()
    {
        $this->name = $this->api_key = $this->api_secret = $this->currency_id = null;
        $this->booking_type = 'onsite';
        $this->status = 'inactive';
        $this->editModuleId = null;
    }

    public function render()
    {
        return view('admin.module.modules');
    }
}
