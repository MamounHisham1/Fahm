<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <!-- Client Header -->
        <flux:header container sticky class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <a href="{{ route('client.home', $client ?? '') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0">
                @if(isset($client) && $client->logo)
                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}" class="h-8 w-auto">
                @else
                    <x-app-logo />
                @endif
                
                @if(isset($client))
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">{{ $client->name }}</span>
                @endif
            </a>

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="home" :href="route('client.home', $client ?? '')" :current="request()->routeIs('client.home')" wire:navigate>
                    {{ __('Home') }}
                </flux:navbar.item>
                <flux:navbar.item icon="academic-cap" href="#courses" :current="request()->routeIs('client.courses')">
                    {{ __('Courses') }}
                </flux:navbar.item>
                <flux:navbar.item icon="book-open" href="#lessons" :current="request()->routeIs('client.lessons')">
                    {{ __('Lessons') }}
                </flux:navbar.item>
                <flux:navbar.item icon="clipboard-document-list" href="#assignments" :current="request()->routeIs('client.assignments')">
                    {{ __('Assignments') }}
                </flux:navbar.item>
                <flux:navbar.item icon="chart-bar" href="#progress" :current="request()->routeIs('client.progress')">
                    {{ __('Progress') }}
                </flux:navbar.item>
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
                        <flux:menu.item :href="route('settings.profile')" icon="user-circle" wire:navigate>
                            {{ __('Profile') }}
                        </flux:menu.item>
                        <flux:menu.item :href="route('settings.appearance')" icon="paint-brush" wire:navigate>
                            {{ __('Appearance') }}
                        </flux:menu.item>
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
            @else
            <div class="flex items-center space-x-4">
                <a href="{{ route('client.login', $client ?? '') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400" wire:navigate>
                    {{ __('Log In') }}
                </a>
                <a href="{{ route('client.register', $client ?? '') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" wire:navigate>
                    {{ __('Register') }}
                </a>
            </div>
            @endauth
        </flux:header>

        <!-- Mobile Sidebar -->
        <flux:sidebar stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('client.home', $client ?? '') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse">
                @if(isset($client) && $client->logo)
                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}" class="h-8 w-auto">
                @else
                    <x-app-logo />
                @endif
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Navigation')">
                    <flux:navlist.item icon="home" :href="route('client.home', $client ?? '')" :current="request()->routeIs('client.home')" wire:navigate>
                        {{ __('Home') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="academic-cap" href="#courses" :current="request()->routeIs('client.courses')">
                        {{ __('Courses') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="book-open" href="#lessons" :current="request()->routeIs('client.lessons')">
                        {{ __('Lessons') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="clipboard-document-list" href="#assignments" :current="request()->routeIs('client.assignments')">
                        {{ __('Assignments') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="chart-bar" href="#progress" :current="request()->routeIs('client.progress')">
                        {{ __('Progress') }}
                    </flux:navlist.item>
                </flux:navlist.group>

                @auth
                <flux:navlist.group :heading="__('Account')">
                    <flux:navlist.item icon="user-circle" :href="route('settings.profile')" :current="request()->routeIs('settings.profile')" wire:navigate>
                        {{ __('Profile') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="cog-6-tooth" :href="route('settings.appearance')" :current="request()->routeIs('settings.appearance')" wire:navigate>
                        {{ __('Settings') }}
                    </flux:navlist.item>
                </flux:navlist.group>
                @endauth

                @guest
                <flux:navlist.group :heading="__('Account')">
                    <flux:navlist.item :href="route('client.login', $client ?? '')" wire:navigate>
                        {{ __('Log In') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="user-plus" :href="route('client.register', $client ?? '')" wire:navigate>
                        {{ __('Register') }}
                    </flux:navlist.item>
                </flux:navlist.group>
                @endguest
            </flux:navlist>
        </flux:sidebar>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        @if(isset($client))
                            <p class="text-sm text-gray-600 dark:text-gray-400">&copy; {{ date('Y') }} {{ $client->name }}. All rights reserved.</p>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-400">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                        @endif
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400">Terms of Service</a>
                        <a href="{{ route('contact') }}" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400" wire:navigate>Contact</a>
                    </div>
                </div>
            </div>
        </footer>

        @fluxScripts
    </body>
</html>
