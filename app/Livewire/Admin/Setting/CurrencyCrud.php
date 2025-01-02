<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use App\Models\Currency;
use Livewire\WithPagination;

class CurrencyCrud extends Component
{
    use WithPagination;

    public $name, $code, $symbol, $status, $is_default, $rate, $currencyId;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'nullable|string|max:10',
        'symbol' => 'nullable|string|max:10',
        'status' => 'required|boolean',
        'is_default' => 'required|boolean',
        'rate' => 'nullable|numeric|min:0',
    ];

    public function render()
    {
        return view('admin.setting.currency-crud', [
            'currencies' => Currency::paginate(24),
        ])->layout('admin.layouts.app');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->code = '';
        $this->symbol = '';
        $this->status = true;
        $this->is_default = false;
        $this->rate = null;
        $this->currencyId = null;
        $this->updateMode = false; // Reset to add mode
    }

    public function store()
    {
        $this->validate();

        Currency::create([
            'name' => $this->name,
            'code' => $this->code,
            'symbol' => $this->symbol,
            'status' => $this->status,
            'is_default' => $this->is_default,
            'rate' => $this->rate,
        ]);

        session()->flash('message', 'Currency created successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        $this->currencyId = $id;
        $this->name = $currency->name;
        $this->code = $currency->code;
        $this->symbol = $currency->symbol;
        $this->status = $currency->status;
        $this->is_default = $currency->is_default;
        $this->rate = $currency->rate;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate();

        if ($this->currencyId) {
            $currency = Currency::find($this->currencyId);
            $currency->update([
                'name' => $this->name,
                'code' => $this->code,
                'symbol' => $this->symbol,
                'status' => $this->status,
                'is_default' => $this->is_default,
                'rate' => $this->rate,
            ]);

            session()->flash('message', 'Currency updated successfully.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        Currency::find($id)->delete();
        session()->flash('message', 'Currency deleted successfully.');
    }
}
