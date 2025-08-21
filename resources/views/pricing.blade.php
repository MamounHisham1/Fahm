@php
    $user = auth()->user();
    
    // Get the user's current active subscription (most recent one)
    $currentSubscription = $user ? $user->subscriptions()
        ->whereIn('stripe_status', ['active', 'trialing'])
        ->orderBy('created_at', 'desc')
        ->first() : null;
    
    $hasProSubscription = $currentSubscription && $currentSubscription->stripe_price === 'price_1RxdiGP7efSykOFMYbp9pz7I';
    $hasEnterpriseSubscription = $currentSubscription && $currentSubscription->stripe_price === 'price_1RxdkcP7efSykOFMRIs4x0We';
    $isFreeUser = $user && !$currentSubscription;
@endphp

<x-layouts.app :title="__('Pricing')">
    <!-- Pricing Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))] dark:bg-grid-slate-700/25"></div>
        <div class="relative max-w-7xl mx-auto px-4 pt-20 pb-16 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text mb-4">
                Simple, transparent pricing
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-gray-600 dark:text-gray-300">
                Choose the perfect plan for your educational needs
            </p>
        </div>
    </div>

    <!-- Pricing Tiers -->
    <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Free Tier -->
            <div class="flex flex-col p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 transition-all duration-200 hover:shadow-lg {{ $isFreeUser ? 'ring-2 ring-green-500 shadow-lg' : '' }} relative">
                @if($isFreeUser)
                    <div class="absolute top-0 right-0 bg-green-500 text-white font-semibold px-4 py-1 rounded-bl-lg rounded-tr-xl text-sm">
                        CURRENT PLAN
                    </div>
                @endif
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Free</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Perfect for getting started</p>
                </div>
                <div class="mb-8">
                    <p class="text-5xl font-bold text-gray-900 dark:text-white">$0</p>
                    <p class="text-gray-500 dark:text-gray-400">Free forever</p>
                </div>
                <ul class="space-y-4 mb-8 flex-grow">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">Up to 30 students</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">5 subjects</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">Basic analytics</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">Community support</span>
                    </li>
                </ul>
                @if($isFreeUser)
                    <div class="w-full inline-flex justify-center items-center px-6 py-3 border-2 border-green-500 text-base font-semibold rounded-full text-green-700 bg-green-50 dark:bg-green-900/20 dark:text-green-300 cursor-default">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Current Plan
                    </div>
                @else
                    <a href="{{ route('register') }}" class="w-full inline-flex justify-center items-center px-6 py-3 border-2 border-gray-300 dark:border-gray-600 text-base font-semibold rounded-full text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" wire:navigate>
                        Get started
                    </a>
                @endif
            </div>

            <!-- Pro Tier -->
            <div class="flex flex-col p-8 bg-gradient-to-b from-blue-600 to-purple-600 rounded-2xl shadow-xl border-2 border-blue-400 dark:border-purple-500 transform transition-all duration-200 hover:scale-105 relative {{ $hasProSubscription ? 'ring-4 ring-green-400' : 'ring-2 ring-blue-300' }}">
                @if($hasProSubscription)
                    <div class="absolute top-0 right-0 bg-green-500 text-white font-semibold px-4 py-1 rounded-bl-lg rounded-tr-xl text-sm">
                        CURRENT PLAN
                    </div>
                @else
                    <div class="absolute top-0 right-0 bg-gradient-to-r from-yellow-400 to-orange-400 text-gray-900 font-bold px-4 py-1 rounded-bl-lg rounded-tr-xl text-sm shadow-lg">
                        ⭐ MOST POPULAR
                    </div>
                @endif
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-white">Pro</h3>
                    <p class="mt-2 text-blue-100">For growing schools</p>
                </div>
                <div class="mb-8">
                    <p class="text-5xl font-bold text-white">$49</p>
                    <p class="text-blue-100">per month</p>
                </div>
                <ul class="space-y-4 mb-8 flex-grow">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-white mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Up to 200 students</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-white mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Unlimited subjects</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-white mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Advanced analytics</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-white mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Priority email support</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-white mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Custom branding</span>
                    </li>
                </ul>
                @if($hasProSubscription)
                    <div class="w-full inline-flex justify-center items-center px-6 py-3 border-2 border-green-400 text-base font-semibold rounded-full text-green-400 bg-white/10 cursor-default">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Current Plan
                    </div>
                @else
                    <a href="{{ route('checkout', ['product' => 'prod_StQZW1xtmLhfIH', 'plan' => 'price_1RxdiGP7efSykOFMYbp9pz7I']) }}" class="w-full inline-flex justify-center items-center px-6 py-3 border-2 border-white text-base font-semibold rounded-full text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200" wire:navigate>
                        @if($user && $currentSubscription)
                            Upgrade to Pro
                        @else
                            Choose Pro Plan
                        @endif
                    </a>
                @endif
            </div>

            <!-- Enterprise Tier -->
            <div class="flex flex-col p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 transition-all duration-200 hover:shadow-lg {{ $hasEnterpriseSubscription ? 'ring-2 ring-green-500 shadow-lg' : '' }} relative">
                @if($hasEnterpriseSubscription)
                    <div class="absolute top-0 right-0 bg-green-500 text-white font-semibold px-4 py-1 rounded-bl-lg rounded-tr-xl text-sm">
                        CURRENT PLAN
                    </div>
                @endif
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Enterprise</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">For large institutions</p>
                </div>
                <div class="mb-8">
                    <p class="text-5xl font-bold text-gray-900 dark:text-white">$199</p>
                    <p class="text-gray-500 dark:text-gray-400">per month</p>
                </div>
                <ul class="space-y-4 mb-8 flex-grow">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">Unlimited students</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">Unlimited subjects</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">Advanced analytics & reporting</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">Dedicated account manager</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">API access</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600 dark:text-gray-300">SSO integration</span>
                    </li>
                </ul>
                @if($hasEnterpriseSubscription)
                    <div class="w-full inline-flex justify-center items-center px-6 py-3 border-2 border-green-500 text-base font-semibold rounded-full text-green-700 bg-green-50 dark:bg-green-900/20 dark:text-green-300 cursor-default">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Current Plan
                    </div>
                @else
                    <a href="{{ route('checkout', ['product' => 'prod_StQb8sdDEmJM48', 'plan' => 'price_1RxdkcP7efSykOFMRIs4x0We']) }}" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-semibold rounded-full shadow-sm text-white bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-900 hover:to-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200">
                        @if($user && $currentSubscription)
                            Upgrade to Enterprise
                        @else
                            Choose Enterprise Plan
                        @endif
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Feature Comparison -->
    <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">Compare Plans</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Feature</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium {{ $isFreeUser ? 'text-green-600 dark:text-green-400' : 'text-gray-500 dark:text-gray-400' }} uppercase tracking-wider">
                            Free
                            @if($isFreeUser)
                                <span class="block text-xs normal-case font-normal">(Current)</span>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium {{ $hasProSubscription ? 'text-green-600 dark:text-green-400' : 'text-blue-600 dark:text-blue-400' }} uppercase tracking-wider">
                            Pro
                            @if($hasProSubscription)
                                <span class="block text-xs normal-case font-normal">(Current)</span>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium {{ $hasEnterpriseSubscription ? 'text-green-600 dark:text-green-400' : 'text-gray-500 dark:text-gray-400' }} uppercase tracking-wider">
                            Enterprise
                            @if($hasEnterpriseSubscription)
                                <span class="block text-xs normal-case font-normal">(Current)</span>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">Students</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">Up to 30</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-blue-600 dark:text-blue-400 font-medium">Up to 200</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">Unlimited</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">Subjects</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-blue-600 dark:text-blue-400 font-medium">Unlimited</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">Unlimited</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">Lessons</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">50</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-blue-600 dark:text-blue-400 font-medium">Unlimited</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">Unlimited</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">Storage</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">1 GB</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-blue-600 dark:text-blue-400 font-medium">10 GB</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">100 GB</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">Analytics</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">Basic</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-blue-600 dark:text-blue-400 font-medium">Advanced</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">Advanced + Custom</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">Support</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">Community</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-blue-600 dark:text-blue-400 font-medium">Priority Email</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">Dedicated Manager</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">Custom Branding</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <svg class="h-5 w-5 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <svg class="h-5 w-5 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <svg class="h-5 w-5 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">API Access</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <svg class="h-5 w-5 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <svg class="h-5 w-5 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <svg class="h-5 w-5 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">SSO Integration</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <svg class="h-5 w-5 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <svg class="h-5 w-5 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <svg class="h-5 w-5 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="max-w-5xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">Frequently Asked Questions</h2>
        
        <div class="space-y-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Can I upgrade or downgrade my plan at any time?</h3>
                <p class="text-gray-600 dark:text-gray-300">Yes, you can upgrade or downgrade your plan at any time. Changes to your subscription will be prorated based on the time remaining in your billing cycle.</p>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Do you offer discounts for educational institutions?</h3>
                <p class="text-gray-600 dark:text-gray-300">Yes, we offer special pricing for educational institutions. Please contact our sales team for more information about our educational discounts.</p>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">How long is the free trial period?</h3>
                <p class="text-gray-600 dark:text-gray-300">Our free trial for the Pro plan lasts for 14 days. During this period, you'll have access to all Pro features without any commitment. No credit card is required to start your trial.</p>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">What payment methods do you accept?</h3>
                <p class="text-gray-600 dark:text-gray-300">We accept all major credit cards, including Visa, Mastercard, American Express, and Discover. We also support payment via PayPal and bank transfers for annual Enterprise plans.</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Ready to transform your teaching experience?</h2>
            <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
                Join thousands of educators who are already creating better learning experiences.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="transform transition-all duration-200 hover:scale-105 inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 border-2 border-white text-base sm:text-lg font-semibold rounded-full text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full sm:w-auto" wire:navigate>
                    Start Free Trial
                </a>
                <a href="#" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 border-2 border-white text-base sm:text-lg font-semibold rounded-full text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full sm:w-auto">
                    Contact Sales
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
