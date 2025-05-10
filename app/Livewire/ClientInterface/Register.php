<?php

namespace App\Livewire\ClientInterface;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
class Register extends Component
{

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function register()
    {
        dd($this->name, $this->email, $this->password, $this->password_confirmation);
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }
    public function render()
    {
        return view('livewire.client-interface.register');
    }
}
