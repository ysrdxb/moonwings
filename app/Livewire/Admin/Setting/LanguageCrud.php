<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use App\Models\Language;
use Livewire\WithPagination;

class LanguageCrud extends Component
{
    use WithPagination;

    public $name, $code, $direction, $status, $is_default, $languageId;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'nullable|string|max:10',
        'direction' => 'required|in:LTR,RTL',
        'status' => 'required|boolean',
        'is_default' => 'required|boolean',
    ];

    public function render()
    {
        return view('admin.setting.language-crud', [
            'languages' => Language::paginate(24),
        ]);
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->code = '';
        $this->direction = 'LTR';
        $this->status = true;
        $this->is_default = false;
        $this->languageId = null;
        $this->updateMode = false; // Reset to add mode
    }

    public function store()
    {
        $this->validate();

        Language::create([
            'name' => $this->name,
            'code' => $this->code,
            'direction' => $this->direction,
            'status' => $this->status,
            'is_default' => $this->is_default,
        ]);

        session()->flash('message', 'Language created successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $language = Language::findOrFail($id);
        $this->languageId = $id;
        $this->name = $language->name;
        $this->code = $language->code;
        $this->direction = $language->direction;
        $this->status = $language->status;
        $this->is_default = $language->is_default;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate();

        if ($this->languageId) {
            $language = Language::find($this->languageId);
            $language->update([
                'name' => $this->name,
                'code' => $this->code,
                'direction' => $this->direction,
                'status' => $this->status,
                'is_default' => $this->is_default,
            ]);

            session()->flash('message', 'Language updated successfully.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        Language::find($id)->delete();
        session()->flash('message', 'Language deleted successfully.');
    }
}
