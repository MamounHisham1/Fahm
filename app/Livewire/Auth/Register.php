<?php

namespace App\Livewire\Auth;

use App\Enums\UserRole;
use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $domain;
    public string $password_confirmation = '';
    public string $school_name = '';
    public $logo;
    public string $description = '';
    public bool $terms = false;

    public function register()
    {
        $validated = $this->validatedData();

        DB::beginTransaction();

        try {
            $client = $this->createClient($validated);

            $this->saveLogo($client);

            $user = $this->createUser($validated, $client);

            event(new Registered($user));

            Auth::login($user);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        $appDomain = config('fahm.app_domain');

        return redirect()->away("https://{$client->domain}.{$appDomain}/dashboard");
    }

    private function validatedData()
    {
        return $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'domain' => ['nullable', 'string', 'max:255', 'unique:'.Client::class],
            'school_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:1024'],
            'terms' => ['accepted'],
        ]);
    }

    private function createClient($validated)
    {
        return Client::create([
            'domain' => $validated['domain'] ?? Str::slug($validated['school_name']),
            'name' => $validated['school_name'],
            'description' => $validated['description'],
        ]);
    }

    private function saveLogo($client)
    {
        if ($this->logo) {
            $logoPath = $this->logo->store('logos', 'public');
            $client->update(['logo' => $logoPath]);
        }
    }

    private function createUser($validated, $client)
    {
        return User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'client_id' => $client->id,
            'role' => UserRole::Admin,
        ]);
    }

    public function render()
    {
        return view('auth.register');
    }
}
