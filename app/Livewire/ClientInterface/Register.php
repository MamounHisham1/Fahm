<?php

namespace App\Livewire\ClientInterface;

use App\Enums\UserRole;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

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

    public function render()
    {
        return view('livewire.client-interface.register');
    }

    public function register(): void
    {
        $validated = $this->validatedData();

        DB::beginTransaction();

        try {
            $user = $this->createUser($validated);

            $this->createProfile($user, $validated);

            event(new Registered($user));

            Auth::login($user);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        $this->redirect(route('client.home'), navigate: true);
    }

    private function validatedData()
    {
        return $this->validate([
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
    }

    private function saveAvatar()
    {
        return $this->avatar ? $this->avatar->store('avatars', 'public') : null;
    }

    private function createUser($validated)
    {
        return User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'client_id' => $this->client->id,
            'role' => UserRole::Student,
        ]);
    }

    private function createProfile($user, $validated)
    {
        Profile::create([
            'user_id' => $user->id,
            'client_id' => $this->client->id,
            'avatar' => $this->saveAvatar(),
            'gender' => $validated['gender'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'bio' => $validated['bio'],
        ]);
    }
}
