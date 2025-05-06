<section class="bg-white dark:bg-gray-900">
    <div class="flex justify-center min-h-screen">
        <div class="hidden bg-cover lg:block lg:w-2/5"
            style="background-image: url('https://images.unsplash.com/photo-1494621930069-4fd4b2e24a11?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=715&q=80')">
        </div>

        <div class="flex items-center w-full max-w-3xl p-8 mx-auto lg:px-12 lg:w-3/5">
            <div class="w-full">
                <h1 class="text-2xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white">
                    Log in to your account
                </h1>

                <p class="mt-4 text-gray-500 dark:text-gray-400">
                    Enter your email and password below to access your account
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mt-4" :status="session('status')" />

                <form wire:submit="login" class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-1">
                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <h2 class="text-xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white mb-4">
                            Account Information
                        </h2>

                        <div class="space-y-4">
                            <!-- Email Address -->
                            <x-input 
                                name="email"
                                wire:model="email"
                                label="Email address"
                                type="email"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="email@example.com"
                            />

                            <!-- Password -->
                            <div class="relative">
                                <x-input
                                    name="password"
                                    wire:model="password"
                                    label="Password"
                                    type="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Password"
                                />

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" wire:navigate class="text-sm text-blue-600 hover:underline dark:text-blue-500 absolute end-0 top-0">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center mt-4">
                                <input id="remember" type="checkbox" wire:model="remember"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="remember" class="ml-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4">
                        <button type="submit"
                            class="transform transition-all duration-200 hover:scale-105 inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-semibold rounded-full shadow-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span>{{ __('Log in') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-3 -mr-1 rtl:-scale-x-100" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        @if (Route::has('register'))
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 text-gray-500 bg-white dark:bg-gray-900">Or</span>
                                </div>
                            </div>

                            <a href="{{ route('register') }}" wire:navigate
                                class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-semibold rounded-full border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Create a new account
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
