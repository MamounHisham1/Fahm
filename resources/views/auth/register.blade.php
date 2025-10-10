<section class="bg-white">
    <div class="flex justify-center min-h-screen">
        <div class="hidden bg-cover lg:block lg:w-2/5"
            style="background-image: url('https://images.unsplash.com/photo-1494621930069-4fd4b2e24a11?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=715&q=80')">
        </div>

        <div class="flex items-center w-full max-w-3xl p-8 mx-auto lg:px-12 lg:w-3/5">
            <div class="w-full">
                <h1 class="text-2xl font-semibold tracking-wider text-gray-800 capitalize">
                    Get your free account now.
                </h1>

                <p class="mt-4 text-gray-500">
                    Let's get you all set up so you can verify your personal account and begin setting up your profile.
                </p>

                <form class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-1" enctype="multipart/form-data"
                    wire:submit="register">

                    {{-- Personal Information Section --}}
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h2 class="text-xl font-semibold tracking-wider text-gray-800 capitalize">
                            Personal Information
                        </h2>
                        <p class="text-sm text-gray-500 mb-4">
                            These informations will be used to login to the admin dashboard.
                        </p>

                        <div class="space-y-4">
                            <x-input name="name" label="Name" required />

                            <x-input name="email" label="Email" type="email" required />

                            <x-input name="password" label="Password" type="password" required />

                            <x-input name="password_confirmation" label="Confirm Password" type="password" required />
                        </div>
                    </div>

                    {{-- Company Information Section --}}
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h2 class="text-xl font-semibold tracking-wider text-gray-800 capitalize mb-4">
                            School Information
                        </h2>

                        <div class="space-y-4">
                            <x-input name="school_name" label="School Name" required />

                            <x-input name="domain" label="Domain" info="By default, the domain will be the school name. You can change it later." />

                            <x-file-uploader name="logo" label="School Logo" accept="image/*" maxSize="2"
                                recommendedSize="200x200px" />
                            <x-textarea name="description" label="School Description" required />
                        </div>
                    </div>

                    <div class="flex items-center mt-4">
                        <input id="terms" type="checkbox" wire:model="terms" required
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                        <label for="terms" class="ml-2 text-sm font-medium text-gray-600">I agree
                            to the <a href="#" class="text-blue-600 hover:underline">Terms and
                                Conditions</a></label>
                    </div>

                    <div class="flex flex-col gap-4">
                        <button type="submit"
                            class="transform transition-all duration-200 hover:scale-105 inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-semibold rounded-full shadow-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span>Create Account</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-3 -mr-1 rtl:-scale-x-100" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 text-gray-500 bg-white">Or</span>
                            </div>
                        </div>

                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-semibold rounded-full border-2 border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Sign in to your account
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
