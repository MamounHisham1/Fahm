<?php

namespace App\Livewire\ClientInterface;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Client;
use App\Enums\UserRole;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Validation\Rule;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $gender;
    public $phone;
    public $address;
    public $bio;
    public $avatar;
    public $terms = false;

    public $client;

    public function mount()
    {
        $this->client = Context::getHidden('client');
    }

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('client_id', $this->client->id);
                }),
            ],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string', 'in:male,female'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'terms' => ['accepted'],
        ]);

        DB::beginTransaction();
        if (isset($this->avatar)) {
            $avatarPath = $this->avatar->store('avatars');
        }

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'client_id' => $this->client->id,
                'role' => UserRole::Student,
            ]);

            Profile::create([
                'user_id' => $user->id,
                'client_id' => $this->client->id,
                'avatar' => $avatarPath ?? null,
                'gender' => $validated['gender'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'bio' => $validated['bio'],
            ]);
            event(new Registered($user));

            Auth::login($user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        $this->redirect(route('client.home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.client-interface.register');
    }
}
