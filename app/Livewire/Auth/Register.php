<?php

namespace App\Livewire\Auth;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Client;
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
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'domain' => ['nullable', 'string', 'max:255', 'unique:'.Client::class],
            'school_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:1024'],
            'terms' => ['accepted'],
        ]);

        DB::beginTransaction();

        try {
            $client = Client::create([
                'domain' => $validated['domain'] ?? Str::slug($validated['school_name']),
                'name' => $validated['school_name'],
                'description' => $validated['description'],
            ]);
    
            if ($this->logo) {
                $logoPath = $this->logo->store('logos', 'public');
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

        // TODO: Enhance this to use the correct solution. the redirect url will this https://some-domain.fahm.test/admin/dashboard
        $appDomain = env('APP_DOMAIN');
        
        return redirect()->away("https://{$client->domain}.{$appDomain}/dashboard");
    }

    public function render()
    {
        return view('auth.register');
    }
}
