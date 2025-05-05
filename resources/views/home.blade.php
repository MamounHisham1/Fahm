<x-layouts.app :title="__('Home')">
    <!-- Hero Section with Background -->
    <div class="relative overflow-hidden bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))] dark:bg-grid-slate-700/25"></div>
        <div class="relative max-w-7xl mx-auto px-4 pt-20 pb-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text mb-6 sm:mb-8">
                    Connect with your students
                </h1>
                <p class="max-w-2xl mx-auto text-xl text-gray-600 dark:text-gray-300 leading-relaxed">
                    Transform your teaching experience with our powerful platform designed to help educators create engaging and interactive learning environments.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="transform transition-all duration-200 hover:scale-105 inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 border border-transparent text-base sm:text-lg font-semibold rounded-full shadow-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full sm:w-auto">
                        Get Started Free
                        <svg class="ml-3 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    <a href="#how-it-works" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 border-2 border-gray-300 dark:border-gray-600 text-base sm:text-lg font-semibold rounded-full text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full sm:w-auto">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->  
    <div class="bg-white dark:bg-gray-800 shadow-sm border-y border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 dark:text-blue-400">10k+</div>
                    <div class="mt-2 text-gray-600 dark:text-gray-300">Active Students</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-600 dark:text-purple-400">5k+</div>
                    <div class="mt-2 text-gray-600 dark:text-gray-300">Teachers</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600 dark:text-green-400">1M+</div>
                    <div class="mt-2 text-gray-600 dark:text-gray-300">Lessons Created</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-red-600 dark:text-red-400">98%</div>
                    <div class="mt-2 text-gray-600 dark:text-gray-300">Satisfaction Rate</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Cards -->
    <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Everything you need to succeed</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300">Powerful features to help you manage your classroom effectively</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Easy to Start</h3>
                <p class="text-gray-600 dark:text-gray-300">Create your first lesson in minutes with our intuitive interface.</p>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Engage Students</h3>
                <p class="text-gray-600 dark:text-gray-300">Interactive tools to keep your students motivated and involved.</p>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Track Progress</h3>
                <p class="text-gray-600 dark:text-gray-300">Monitor student performance with detailed analytics and insights.</p>
            </div>
        </div>
    </div>

    <!-- Main Image -->
    <div class="mt-12 flex justify-center">
        <img 
            src="{{ asset('main-section.webp') }}" 
            alt="Platform Overview" 
            class="rounded-xl shadow-lg w-full max-w-3xl object-cover"
        >
    </div>

    <!-- How It Works Section -->
    <div id="how-it-works" class="bg-gray-50 dark:bg-gray-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">How It Works</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">Get started in minutes, not hours</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-12">
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <span class="text-blue-600 dark:text-blue-300 font-semibold">1</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Create Your School Profile</h3>
                            <p class="text-gray-600 dark:text-gray-300">Set up your school's profile with custom branding and educational goals.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <span class="text-purple-600 dark:text-purple-300 font-semibold">2</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Add Your Subjects</h3>
                            <p class="text-gray-600 dark:text-gray-300">Organize your curriculum by creating subjects and lesson plans.</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                            <span class="text-green-600 dark:text-green-300 font-semibold">3</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Invite Students</h3>
                            <p class="text-gray-600 dark:text-gray-300">Connect with your students and start sharing your lessons.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                            <span class="text-red-600 dark:text-red-300 font-semibold">4</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Track Progress</h3>
                            <p class="text-gray-600 dark:text-gray-300">Monitor student engagement and achievement with detailed analytics.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section with Images -->
    <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Loved by Educators</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300">Don't just take our word for it</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
            <blockquote class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-300 mb-4">"This platform has transformed how I connect with my students. The interactive features make learning more engaging than ever."</p>
                <footer class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                    <div>
                        <cite class="font-semibold not-italic">Sarah Johnson</cite>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Math Teacher</p>
                    </div>
                </footer>
            </blockquote>
            <blockquote class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-300 mb-4">"The analytics help me understand exactly where my students need support. It's like having a teaching assistant that never sleeps."</p>
                <footer class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                    <div>
                        <cite class="font-semibold not-italic">Michael Chen</cite>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Science Teacher</p>
                    </div>
                </footer>
            </blockquote>
        </div>
    </div>

    <!-- Enhanced CTA Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Transform Your Teaching?</h2>
            <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
                Join thousands of educators who are already creating better learning experiences.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="transform transition-all duration-200 hover:scale-105 inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 border-2 border-white text-base sm:text-lg font-semibold rounded-full text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full sm:w-auto">
                    Start Free Trial
                </a>
                <a href="#" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 border-2 border-white text-base sm:text-lg font-semibold rounded-full text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full sm:w-auto">
                    Schedule Demo
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
