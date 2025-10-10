<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 flex flex-col md:flex-row">
    <!-- Left side - Registration form -->
    <div class="md:w-1/2 p-8 md:p-12 lg:p-16 flex items-center justify-center order-2 md:order-1">
        <div class="w-full max-w-md">
            <div class="bg-white/95 rounded-3xl shadow-2xl p-8 relative overflow-hidden border border-gray-100 backdrop-blur-sm">
                <!-- Decorative elements -->
                <div class="absolute -top-12 -left-12 w-40 h-40 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full opacity-80"></div>
                <div class="absolute -bottom-12 -right-12 w-40 h-40 bg-gradient-to-tr from-pink-500 to-purple-600 rounded-full opacity-80"></div>
                
                <!-- Geometric patterns -->
                <div class="absolute top-0 right-0 w-32 h-32 overflow-hidden">
                    <div class="w-40 h-40 bg-indigo-100 rotate-45 transform origin-top-left"></div>
                </div>
                <div class="absolute bottom-0 left-0 w-32 h-32 overflow-hidden">
                    <div class="w-40 h-40 bg-pink-100 rotate-45 transform origin-bottom-right"></div>
                </div>
                
                <div class="relative">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Create Account</h2>
                            <p class="text-gray-500">Join our community today</p>
                        </div>
                    </div>
                    
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    
                    <form wire:submit="register" class="space-y-5">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input 
                                    id="name"
                                    type="text" 
                                    wire:model="name" 
                                    required 
                                    autofocus 
                                    autocomplete="name"
                                    placeholder="John Doe"
                                    class="pl-10 p-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                            @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <input 
                                    id="email"
                                    type="email" 
                                    wire:model="email" 
                                    required 
                                    autocomplete="email"
                                    placeholder="you@example.com"
                                    class="pl-10 p-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                            @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input 
                                    id="password"
                                    type="password" 
                                    wire:model="password" 
                                    required 
                                    autocomplete="new-password"
                                    class="pl-10 p-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                            @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input 
                                    id="password_confirmation"
                                    type="password" 
                                    wire:model="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    class="pl-10 p-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                        </div>
                        
                        <!-- Gender -->
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <select 
                                    id="gender"
                                    wire:model="gender" 
                                    required
                                    class="pl-10 p-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            @error('gender') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                </div>
                                <input 
                                    id="phone"
                                    type="tel" 
                                    wire:model="phone" 
                                    autocomplete="tel"
                                    placeholder="+1 (555) 123-4567"
                                    class="pl-10 p-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                            @error('phone') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input 
                                    id="address"
                                    type="text" 
                                    wire:model="address" 
                                    autocomplete="street-address"
                                    placeholder="123 Main St, City, State"
                                    class="pl-10 p-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                            @error('address') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Bio -->
                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <textarea 
                                    id="bio"
                                    wire:model="bio" 
                                    rows="4"
                                    placeholder="Tell us a bit about yourself..."
                                    class="pl-10 p-2 w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                ></textarea>
                            </div>
                            @error('bio') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Avatar Upload -->
                        <div>
                            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                            <div class="mt-1 ">
                                <div class="relative">
                                    <input 
                                        id="avatar" 
                                        type="file" 
                                        wire:model="avatar" 
                                        accept="image/*"
                                        class="sr-only"
                                    >
                                    <label for="avatar" class="cursor-pointer flex items-center justify-center w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                        </svg>
                                        Upload Photo
                                    </label>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF. Max 2MB.</p>
                            @error('avatar') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Terms and Conditions -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input 
                                    id="terms" 
                                    type="checkbox" 
                                    wire:model="terms" 
                                    required
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                >
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-700">
                                    I agree to the 
                                    <a href="#" class="text-indigo-600 hover:text-indigo-500">Terms of Service</a> 
                                    and 
                                    <a href="#" class="text-indigo-600 hover:text-indigo-500">Privacy Policy</a>
                                </label>
                            </div>
                        </div>
                        @error('terms') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        
                        <!-- Submit Button -->
                        <div>
                            <button 
                                type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-medium text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 hover:from-indigo-700 hover:via-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-150 hover:scale-[1.02]"
                            >
                                Create Account
                            </button>
                        </div>
                    </form>
                    
                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account? 
                            <a href="{{ route('client.login') }}" wire:navigate class="font-medium text-indigo-600 hover:text-indigo-500">
                                Sign in
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right side - Decorative elements and information -->
    <div class="md:w-1/2 p-8 md:p-12 lg:p-16 flex items-center justify-center relative overflow-hidden order-1 md:order-2">
        <!-- Decorative background elements -->
        <div class="absolute inset-0">
            <!-- Diagonal stripes -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-indigo-500/20 to-transparent"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[20px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[60px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[100px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[140px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[180px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[220px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[260px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[300px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[340px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[380px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[420px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[460px]"></div>
                <div class="h-[10px] w-full bg-indigo-500/20 rotate-[15deg] transform origin-left translate-y-[500px]"></div>
            </div>
            
            <!-- Floating shapes -->
            <div class="absolute top-1/4 left-1/4 w-16 h-16 bg-gradient-to-r from-blue-400/40 to-indigo-500/40 rounded-lg rotate-12"></div>
            <div class="absolute top-1/3 right-1/4 w-20 h-20 bg-gradient-to-r from-purple-400/40 to-pink-500/40 rounded-full"></div>
            <div class="absolute bottom-1/4 left-1/3 w-24 h-24 bg-gradient-to-r from-pink-400/40 to-rose-500/40 rounded-lg -rotate-12"></div>
            
            <!-- Dotted pattern -->
            <div class="absolute inset-0 grid grid-cols-12 gap-4 opacity-20">
                @for ($i = 0; $i < 120; $i++)
                    <div class="w-1 h-1 rounded-full bg-indigo-500"></div>
                @endfor
            </div>
        </div>
        
        <div class="relative z-10 text-center max-w-md">
            <!-- Client logo if available -->
            @if(isset($client) && $client->logo)
                <div class="flex justify-center mb-8">
                    <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" class="h-20 object-contain">
                </div>
            @else
                <div class="mb-8 inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-indigo-600 to-purple-700 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                    </svg>
                </div>
            @endif
            
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800 bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">Join Our Community</h1>
            <p class="text-lg text-gray-600 mb-8">Create your account and start your learning journey today.</p>
            
            <!-- Features list -->
            <div class="bg-white/90 p-6 rounded-xl shadow-lg border border-gray-100 text-left">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Why join us?</h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">Access to premium learning resources</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">Interactive learning experiences</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">Progress tracking and analytics</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">Community support and collaboration</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
