<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserList extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $users = User::where('firstname', 'like', "%{$this->search}%")
            ->orWhere('lastname', 'like', "%{$this->search}%")
            ->orWhere('username', 'like', "%{$this->search}%")
            ->paginate(10);

        return view('admin.user.user-list', [
            'users' => $users,
        ]);
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }
}
