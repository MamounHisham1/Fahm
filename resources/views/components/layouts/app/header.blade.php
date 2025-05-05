<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 bg-gradient-to-br from-blue-50 to-purple-50 dark:from-gray-900 dark:to-gray-800">
        <flux:header container sticky class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                    {{ __('Home') }}
                </flux:navbar.item>
                <flux:navbar.item icon="building-library" href="#about" :current="request()->routeIs('about')">
                    {{ __('About') }}
                </flux:navbar.item>
                <flux:navbar.item icon="rocket-launch" href="#features" :current="request()->routeIs('features')">
                    {{ __('Features') }}
                </flux:navbar.item>
                <flux:navbar.item icon="document-text" href="#blog" :current="request()->routeIs('blog')">
                    {{ __('Blog') }}
                </flux:navbar.item>
                <flux:navbar.item icon="chat-bubble-left-right" href="#contact" :current="request()->routeIs('contact')">
                    {{ __('Contact') }}
                </flux:navbar.item>
                @auth
                    <flux:navbar.item icon="squares-2x2" :href="route('filament.dashboard.pages.dashboard')" :current="request()->routeIs('filament.dashboard.pages.dashboardN')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:navbar.item>
                @endauth
            </flux:navbar>

            <flux:spacer />

            <!-- Desktop User Menu -->
            @auth
            <flux:dropdown position="top" align="end">
                <flux:profile
                    class="cursor-pointer"
                    :initials="auth()->user()->initials()"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
            @endauth

            @guest
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('login') }}" 
                    class="transform transition-all duration-200 hover:scale-105 inline-flex items-center justify-center px-6 py-2 text-base font-semibold rounded-full text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                    wire:navigate
                >
                    {{ __('Log In') }}
                </a>
                <a href="{{ route('register') }}" 
                    class="transform transition-all duration-200 hover:scale-105 inline-flex items-center justify-center px-6 py-2 text-base font-semibold rounded-full border-2 border-blue-600 text-blue-600 hover:bg-blue-50 dark:text-purple-400 dark:border-purple-400 dark:hover:bg-purple-400/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                    wire:navigate
                >
                    {{ __('Register') }}
                    <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            @endguest
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky class="lg:hidden border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('home') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <flux:navlist.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                        {{ __('Home') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="building-library" href="#about" :current="request()->routeIs('about')">
                        {{ __('About') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="rocket-launch" href="#features" :current="request()->routeIs('features')">
                        {{ __('Features') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="document-text" href="#blog" :current="request()->routeIs('blog')">
                        {{ __('Blog') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="chat-bubble-left-right" href="#contact" :current="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </flux:navlist.item>
                </flux:navlist.group>

                @auth
                <flux:navlist.group :heading="__('Account')">
                    <flux:navlist.item icon="squares-2x2" :href="route('filament.dashboard.pages.dashboard')" :current="request()->routeIs('filament.dashboard.pages.dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="user-circle" :href="route('settings.profile')" :current="request()->routeIs('settings.profile')" wire:navigate>
                        {{ __('Profile') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="cog-6-tooth" :href="route('settings.profile')" :current="request()->routeIs('settings')" wire:navigate>
                        {{ __('Settings') }}
                    </flux:navlist.item>
                </flux:navlist.group>
                @endauth

                @guest
                <flux:navlist.group :heading="__('Account')">
                    <flux:navlist.item :href="route('login')" wire:navigate>
                        {{ __('Log In') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="user-plus" :href="route('register')" wire:navigate>
                        {{ __('Register') }}
                    </flux:navlist.item>
                </flux:navlist.group>
                @endguest
            </flux:navlist>
        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
