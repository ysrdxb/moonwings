<?php

namespace App\Livewire\Admin\Menu;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;

class MenuCrud extends Component
{
    use WithPagination;

    public $name, $location, $status = true, $menuId;
    public $updateMode = false;
    public $showMenuItemsForm = false;
    public $addCustomUrl = false;
    public $newItemTitle, $newItemUrl, $newItemOrder, $newItemPageId, $newItemTarget = '_self';

    protected $rules = [
        'name' => 'required|string|max:255|unique:menus,name',
        'location' => 'required|string|max:255|in:header,footer',
        'status' => 'required|boolean',
    ];

    protected $itemRules = [
        'newItemTitle' => 'required|string|max:255',
        'newItemUrl' => 'nullable|string|max:255',
        'newItemPageId' => 'nullable|exists:pages,id',
        'newItemOrder' => 'nullable|integer',
        'newItemTarget' => 'required|in:_blank,_self,_parent,_top',
    ];

    public function render()
    {
        $menu = $this->menuId ? Menu::find($this->menuId) : null;

        return view('admin.menu.menu-crud', [
            'menus' => Menu::with('items')->paginate(12),
            'menuItems' => $this->menuId ? $menu->items : collect(),
            'pages' => Page::all(),
            'menu' => $menu,
        ]);
    }

    public function toggleCustomUrl()
    {
        $this->addCustomUrl = !$this->addCustomUrl;
        $this->newItemUrl = '';
    }    

    public function resetInputFields()
    {
        $this->name = '';
        $this->location = '';
        $this->status = true;
        $this->menuId = null;
        $this->newItemTitle = '';
        $this->newItemUrl = '';
        $this->newItemOrder = '';
        $this->newItemPageId = null;
        $this->newItemTarget = '_self';
    }

    public function store()
    {
        $this->validate();

        Menu::create([
            'name' => $this->name,
            'location' => strtolower($this->location),
            'status' => $this->status,
        ]);

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $this->name = $menu->name;
        $this->location = $menu->location;
        $this->status = $menu->status;
        $this->menuId = $menu->id;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate();

        $menu = Menu::find($this->menuId);
        $menu->update([
            'name' => $this->name,
            'location' => strtolower($this->location),
            'status' => $this->status,
        ]);

        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function delete($id)
    {
        Menu::destroy($id);
    }

    public function selectMenu($id)
    {
        $this->menuId = $id;
        $this->showMenuItemsForm = true;
    }

    public function addMenuItem()
    {
        $this->validate($this->itemRules);

        $menu = Menu::find($this->menuId);
        $url = $this->newItemPageId ? Page::find($this->newItemPageId)->url : $this->newItemUrl;

        $menu->items()->create([
            'title' => $this->newItemTitle,
            'url' => $url,
            'page_id' => $this->newItemPageId,
            'order' => $this->newItemOrder,
            'target' => $this->newItemTarget,
        ]);

        $this->resetItemFields();
    }

    public function removeMenuItem($itemId)
    {
        MenuItem::destroy($itemId);
    }

    public function resetItemFields()
    {
        $this->newItemTitle = '';
        $this->newItemUrl = '';
        $this->newItemOrder = '';
        $this->newItemPageId = null;
        $this->newItemTarget = '_self';
    }
}
