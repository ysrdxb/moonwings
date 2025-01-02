<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserCrud extends Component
{
    use WithPagination;

    public $firstname, $lastname, $username, $email, $password, $status, $role, $country_id, $city_id, $language_id, $address, $userId;
    public $updateMode = false;

    protected $rules = [
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8',
        'status' => 'required|in:active,pending,blocked',
        'role' => 'required|in:admin,customer,supplier,agent',
        // 'country_id' => 'nullable|exists:countries,id',
        // 'city_id' => 'nullable|exists:cities,id',
        // 'language_id' => 'nullable|exists:languages,id',
        'address' => 'nullable|string',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }

    public function render()
    {
        return view('admin.user.user-crud', [
            'users' => User::paginate(10),
        ]);
    }

    public function resetInputFields()
    {
        $this->firstname = '';
        $this->lastname = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->status = 'active';
        $this->role = 'customer';
        $this->country_id = null;
        $this->city_id = null;
        $this->language_id = null;
        $this->address = '';
        $this->userId = null;
    }

    public function store()
    {
        $this->validate();

        User::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'status' => $this->status,
            'role' => $this->role,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'language_id' => $this->language_id,
            'address' => $this->address,
        ]);

        session()->flash('message', 'User created successfully.');
        $this->resetInputFields();
        return redirect()->route('admin.users');
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->status = $user->status;
        $this->role = $user->role;
        $this->country_id = $user->country_id;
        $this->city_id = $user->city_id;
        $this->language_id = $user->language_id;
        $this->address = $user->address;
    }

    public function update()
    {
        $this->validate();

        $user = User::find($this->userId);
        $user->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'status' => $this->status,
            'role' => $this->role,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'language_id' => $this->language_id,
            'address' => $this->address,
        ]);

        session()->flash('message', 'User updated successfully.');
        $this->resetInputFields();
        $this->updateMode = false;
        return redirect()->route('admin.users');
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->updateMode = false;
        return redirect()->route('admin.users');
    }
}
