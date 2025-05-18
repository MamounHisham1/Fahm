<div class="min-h-screen flex flex-col md:flex-row bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-indigo-950 dark:to-purple-950">
    <!-- Left side - Decorative elements -->
    <div class="md:w-1/2 p-8 md:p-12 lg:p-16 flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 via-purple-500/10 to-pink-500/10 dark:from-indigo-900/30 dark:via-purple-900/30 dark:to-pink-900/30 backdrop-blur-sm"></div>
        
        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-gradient-to-r from-blue-400/30 to-indigo-500/30 rounded-full dark:from-blue-600/20 dark:to-indigo-700/20"></div>
            <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-gradient-to-r from-purple-400/30 to-pink-500/30 rounded-full dark:from-purple-600/20 dark:to-pink-700/20"></div>
            <div class="absolute bottom-1/4 left-1/3 w-80 h-80 bg-gradient-to-r from-pink-400/30 to-rose-500/30 rounded-full dark:from-pink-600/20 dark:to-rose-700/20"></div>
            
            <!-- Geometric shapes -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 border-2 border-indigo-200 dark:border-indigo-800 rounded-full opacity-30"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 border-2 border-purple-200 dark:border-purple-800 rounded-full opacity-30"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 border-2 border-pink-200 dark:border-pink-800 rounded-full opacity-30"></div>
        </div>
        
        <div class="relative z-10 text-center max-w-md">
            <div class="mb-8 inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-indigo-600 to-purple-700 dark:from-indigo-500 dark:to-purple-600 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800 dark:text-white bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400">Welcome Back</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">Access your personalized dashboard and continue your learning journey.</p>
            
            <!-- Client logo if available -->
            @if(isset($client) && $client->logo)
                <div class="flex justify-center mb-8">
                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}" class="h-16 object-contain">
                </div>
            @endif
            
            <!-- Testimonial -->
            <div class="hidden md:block mt-12 bg-white/90 dark:bg-gray-800/90 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
                <div class="flex justify-center mb-4">
                    <div class="flex space-x-1">
                        @foreach(range(1, 5) as $i)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endforeach
                    </div>
                </div>
                <p class="italic text-gray-600 dark:text-gray-300">"This platform has transformed how we engage with our students. The tools are intuitive and powerful."</p>
                <div class="mt-4 flex items-center justify-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 dark:from-indigo-600 dark:to-purple-700 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">JD</span>
                    </div>
                    <div class="ml-3 text-left">
                        <p class="text-sm font-medium text-gray-800 dark:text-white">Jane Doe</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Education Director</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right side - Login form -->
    <div class="md:w-1/2 p-8 md:p-12 lg:p-16 flex items-center justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white/95 dark:bg-gray-800/95 rounded-3xl shadow-2xl p-8 relative overflow-hidden border border-gray-100 dark:border-gray-700 backdrop-blur-sm">
                <!-- Decorative corner accent -->
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full opacity-80"></div>
                <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-gradient-to-tr from-pink-500 to-purple-600 rounded-full opacity-80"></div>
                
                <div class="relative">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Sign In</h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Enter your credentials to access your account</p>
                    
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    
                    <form wire:submit="login" class="space-y-6">
                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email address</label>
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
                                    autofocus 
                                    autocomplete="email"
                                    placeholder="you@example.com"
                                    class="pl-10 py-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700/70 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                            @error('email') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
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
                                    autocomplete="current-password"
                                    placeholder="••••••••"
                                    class="pl-10 py-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700/70 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                            @error('password') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input 
                                    id="remember" 
                                    type="checkbox" 
                                    wire:model="remember" 
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded dark:border-gray-600 dark:bg-gray-700"
                                >
                                <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Remember me
                                </label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" wire:navigate class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        
                        <!-- Submit Button -->
                        <div>
                            <button 
                                type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-medium text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 hover:from-indigo-700 hover:via-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-150 hover:scale-[1.02]"
                            >
                                Sign in
                            </button>
                        </div>
                    </form>
                    
                    <!-- Divider -->
                    <div class="mt-8">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                                    Don't have an account?
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Register Link -->
                    <div class="mt-6">
                        <a 
                            href="{{ route('client.register') }}" 
                            wire:navigate
                            class="w-full flex justify-center py-3 px-4 border border-gray-300 dark:border-gray-600 rounded-xl shadow-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150"
                        >
                            Create an account
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Additional help text -->
            <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                Need help? <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">Contact support</a>
            </p>
        </div>
    </div>
</div>
