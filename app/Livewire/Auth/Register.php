<?php

namespace App\Livewire\Auth;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public string $password_confirmation = '';

    public string $school_name = '';

    public $logo;

    public string $description = '';

    public bool $terms = false;

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'school_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:1024'],
            'terms' => ['accepted'],
        ]);

        DB::beginTransaction();

        try {
            $client = Client::create([
                'name' => $validated['school_name'],
                'description' => $validated['description'],
            ]);
    
            if (isset($this->logo)) {
                $logoPath = request()->file('logo')->store('logos', 'public');
                $client->update(['logo' => $logoPath]);
            }
    
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'client_id' => $client->id,
                'role' => UserRole::Admin,
            ]);
            event(new Registered($user));
            
            Auth::login($user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


        $this->redirect(route('filament.dashboard.pages.dashboard'), navigate: true);
    }

    public function render()
    {
        return view('auth.register');
    }
}
