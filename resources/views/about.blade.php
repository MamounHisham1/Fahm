<x-layouts.app :title="__('About Us')">
    <!-- About Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-b from-blue-50 to-white">
        <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))]"></div>
        <div class="relative max-w-7xl mx-auto px-4 pt-20 pb-16 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text mb-4 px-2">
                Our mission is to empower educators
            </h1>
            <p class="max-w-2xl mx-auto text-lg sm:text-xl text-gray-600 px-4">
                We're building tools that help teachers create engaging learning experiences for students around the world
            </p>
        </div>
    </div>

    <!-- Our Story Section -->
    <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <div class="order-2 lg:order-1">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Founded in 2020 by a team of educators and technologists, our platform was born from a simple observation: teachers were spending too much time on administrative tasks and not enough time connecting with students.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        We set out to build a solution that would streamline the teaching process, provide powerful analytics, and create more engaging learning experiences. What started as a simple tool for a handful of classrooms has grown into a comprehensive platform used by thousands of educators worldwide.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Our team combines expertise in education, technology, and design to create tools that are not only powerful but also intuitive and enjoyable to use.
                    </p>
                </div>
            </div>
            <div class="order-1 lg:order-2 bg-white rounded-xl shadow-lg p-2 border border-gray-200">
                <img src="{{ asset('team/team.jpg') }}" alt="Our Team" class="rounded-lg w-full">
            </div>
        </div>
    </div>

    <!-- Our Values Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 px-2">Our Values</h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                    These core principles guide everything we do
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Value 1 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Trust & Privacy</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        We take data privacy seriously and are committed to protecting the information of both educators and students.
                    </p>
                </div>
                
                <!-- Value 2 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Innovation</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        We continuously explore new technologies and pedagogical approaches to improve the teaching and learning experience.
                    </p>
                </div>
                
                <!-- Value 3 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Accessibility</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        We believe educational tools should be accessible to all, regardless of technical ability or resource constraints.
                    </p>
                </div>
                
                <!-- Value 4 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Community</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        We foster a supportive community of educators who share best practices and inspire each other.
                    </p>
                </div>
                
                <!-- Value 5 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Passion for Education</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        We're deeply committed to improving education and believe technology can help create more meaningful learning experiences.
                    </p>
                </div>
                
                <!-- Value 6 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Quality</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        We're committed to excellence in everything we do, from code quality to customer support.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 px-2">Meet Our Team</h2>
            <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                The passionate people behind our mission
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            <!-- Team Member 1 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                    <img src="{{ asset('team/ceo-image.png') }}" alt="CEO" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Alex Morgan</h3>
                    <p class="text-sm text-gray-500 mb-3">CEO & Co-Founder</p>
                    <p class="text-gray-600 text-sm">Former teacher with 10+ years of experience in EdTech.</p>
                </div>
            </div>
            
            <!-- Team Member 2 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                    <img src="{{ asset('team/cto-image.png') }}" alt="CTO" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Jamie Chen</h3>
                    <p class="text-sm text-gray-500 mb-3">CTO & Co-Founder</p>
                    <p class="text-gray-600 text-sm">Software engineer passionate about using technology to solve educational challenges.</p>
                </div>
            </div>
            
            <!-- Team Member 3 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                    <img src="{{ asset('team/cpo-image.png') }}" alt="CPO" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Taylor Williams</h3>
                    <p class="text-sm text-gray-500 mb-3">Chief Product Officer</p>
                    <p class="text-gray-600 text-sm">Former curriculum designer with expertise in learning experience design.</p>
                </div>
            </div>
            
            <!-- Team Member 4 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                    <img src="{{ asset('team/cmo-image.png') }}" alt="CMO" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Jordan Patel</h3>
                    <p class="text-sm text-gray-500 mb-3">Chief Marketing Officer</p>
                    <p class="text-gray-600 text-sm">Experienced in building brands that resonate with educators and schools.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Investors Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Backed By</h2>
                <p class="text-xl text-gray-600">
                    Partners who believe in our mission
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 items-center">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-center h-24 hover:shadow-md transition-shadow duration-200">
                    <img src="{{ asset('logos/investors/nexus-ventures.svg') }}" alt="Nexus Ventures" class="h-12 w-auto max-w-full">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-center h-24 hover:shadow-md transition-shadow duration-200">
                    <img src="{{ asset('logos/investors/quantum-capital.svg') }}" alt="Quantum Capital" class="h-12 w-auto max-w-full">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-center h-24 hover:shadow-md transition-shadow duration-200">
                    <img src="{{ asset('logos/investors/apex-partners.svg') }}" alt="Apex Partners" class="h-12 w-auto max-w-full">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-center h-24 hover:shadow-md transition-shadow duration-200">
                    <img src="{{ asset('logos/investors/stellar-fund.svg') }}" alt="Stellar Fund" class="h-12 w-auto max-w-full">
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Join us in transforming education</h2>
            <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
                Be part of our mission to create better learning experiences for students everywhere.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="transform transition-all duration-200 hover:scale-105 inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 border-2 border-white text-base sm:text-lg font-semibold rounded-full text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full sm:w-auto" wire:navigate>
                    Start Free Trial
                </a>
                <a href="{{ route('pricing') }}" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 border-2 border-white text-base sm:text-lg font-semibold rounded-full text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full sm:w-auto" wire:navigate>
                    View Pricing
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
