<x-layouts.app :title="__('Home')">
    <!-- Hero Section with Background Image -->
    <div class="relative min-h-screen overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img 
                src="{{ asset('main-section.webp') }}"
                alt="Platform Overview"
                class="w-full h-full object-cover rounded-lg"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/80"></div>
        </div>
        
        <!-- Grid Pattern Overlay -->
        <div class="absolute inset-0 bg-grid-slate-100/10 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.1))]"></div>
        
        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 pt-32 pb-24 sm:px-6 lg:px-8 min-h-screen flex items-center">
            <div class="text-center w-full">
                <div class="animate-fade-in-up">
                    <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black tracking-tight bg-gradient-to-r from-white via-blue-100 to-purple-100 text-transparent bg-clip-text mb-8 sm:mb-10 drop-shadow-2xl">
                        Connect with your students
                    </h1>
                    <p class="max-w-3xl mx-auto text-xl sm:text-2xl text-white/90 leading-relaxed font-light mb-12">
                        Transform your teaching experience with our powerful platform designed to help educators create engaging and interactive learning environments.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                        <a href="{{ route('register') }}" class="group transform transition-all duration-300 hover:scale-105 hover:shadow-2xl inline-flex items-center justify-center px-8 sm:px-10 py-4 sm:py-5 border-2 border-transparent text-lg sm:text-xl font-bold rounded-full shadow-2xl text-white bg-gradient-to-r from-blue-600 via-purple-600 to-blue-700 hover:from-blue-700 hover:via-purple-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500/50 w-full sm:w-auto backdrop-blur-sm">
                            Get Started Free
                            <svg class="ml-3 -mr-1 h-6 w-6 group-hover:translate-x-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#how-it-works" class="group transform transition-all duration-300 hover:scale-105 inline-flex items-center justify-center px-8 sm:px-10 py-4 sm:py-5 border-2 border-white/30 text-lg sm:text-xl font-bold rounded-full text-white bg-white/10 backdrop-blur-md hover:bg-white/20 hover:border-white/50 focus:outline-none focus:ring-4 focus:ring-white/30 w-full sm:w-auto">
                            Learn More
                            <svg class="ml-3 -mr-1 h-6 w-6 group-hover:translate-y-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </div>

    <!-- Stats Section with Glass Effect -->  
    <div class="relative -mt-20 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 p-8 sm:p-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-12">
                    <div class="text-center group">
                        <div class="text-5xl font-black text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform duration-300">10k+</div>
                        <div class="mt-3 text-gray-600 dark:text-gray-300 font-medium">Active Students</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-5xl font-black text-purple-600 dark:text-purple-400 group-hover:scale-110 transition-transform duration-300">5k+</div>
                        <div class="mt-3 text-gray-600 dark:text-gray-300 font-medium">Teachers</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-5xl font-black text-green-600 dark:text-green-400 group-hover:scale-110 transition-transform duration-300">1M+</div>
                        <div class="mt-3 text-gray-600 dark:text-gray-300 font-medium">Lessons Created</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-5xl font-black text-red-600 dark:text-red-400 group-hover:scale-110 transition-transform duration-300">98%</div>
                        <div class="mt-3 text-gray-600 dark:text-gray-300 font-medium">Satisfaction Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Cards with Enhanced Design -->
    <div class="max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-5xl font-black text-gray-900 dark:text-white mb-6">Everything you need to succeed</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">Powerful features to help you manage your classroom effectively and create engaging learning experiences</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
            <div class="group p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Easy to Start</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Create your first lesson in minutes with our intuitive interface designed for educators.</p>
            </div>

            <div class="group p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-900 dark:to-purple-800 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Engage Students</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Interactive tools and multimedia content to keep your students motivated and actively involved.</p>
            </div>

            <div class="group p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900 dark:to-green-800 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Track Progress</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Monitor student performance with detailed analytics, insights, and personalized feedback.</p>
            </div>
        </div>
    </div>

    <!-- How It Works Section with Enhanced Design -->
    <div id="how-it-works" class="bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-5xl font-black text-gray-900 dark:text-white mb-6">How It Works</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">Get started in minutes, not hours</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 sm:gap-16">
                <div class="space-y-8">
                    <div class="group flex items-start gap-6">
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-blue-600 dark:text-blue-300 font-bold text-lg">1</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Create Your School Profile</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Set up your school's profile with custom branding, educational goals, and personalized settings.</p>
                        </div>
                    </div>
                    <div class="group flex items-start gap-6">
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-900 dark:to-purple-800 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-purple-600 dark:text-purple-300 font-bold text-lg">2</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Add Your Subjects</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Organize your curriculum by creating subjects, lesson plans, and learning objectives.</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-8">
                    <div class="group flex items-start gap-6">
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900 dark:to-green-800 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-green-600 dark:text-green-300 font-bold text-lg">3</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Invite Students</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Connect with your students through secure invitations and start sharing your lessons.</p>
                        </div>
                    </div>
                    <div class="group flex items-start gap-6">
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-gradient-to-br from-red-100 to-red-200 dark:from-red-900 dark:to-red-800 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-red-600 dark:text-red-300 font-bold text-lg">4</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Track Progress</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Monitor student engagement and achievement with detailed analytics and progress reports.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section with Enhanced Cards -->
    <div class="max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-5xl font-black text-gray-900 dark:text-white mb-6">Loved by Educators</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300">Don't just take our word for it</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-12">
            <blockquote class="group p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="w-4 h-4 text-yellow-400">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="w-4 h-4 text-yellow-400">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="w-4 h-4 text-yellow-400">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="w-4 h-4 text-yellow-400">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="w-4 h-4 text-yellow-400">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-6 text-lg leading-relaxed">"This platform has transformed how I connect with my students. The interactive features make learning more engaging than ever before."</p>
                <footer class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 dark:text-blue-400 font-bold text-lg">SJ</span>
                    </div>
                    <div>
                        <cite class="font-bold not-italic text-gray-900 dark:text-white">Sarah Johnson</cite>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Math Teacher</p>
                    </div>
                </footer>
            </blockquote>
            <blockquote class="group p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="w-4 h-4 text-yellow-400">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="w-4 h-4 text-yellow-400">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="w-4 h-4 text-yellow-400">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="w-4 h-4 text-yellow-400">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="w-4 h-4 text-yellow-400">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-6 text-lg leading-relaxed">"The analytics help me understand exactly where my students need support. It's like having a teaching assistant that never sleeps."</p>
                <footer class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900 dark:to-green-800 rounded-full flex items-center justify-center">
                        <span class="text-green-600 dark:text-green-400 font-bold text-lg">MC</span>
                    </div>
                    <div>
                        <cite class="font-bold not-italic text-gray-900 dark:text-white">Michael Chen</cite>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Science Teacher</p>
                    </div>
                </footer>
            </blockquote>
        </div>
    </div>

    <!-- Enhanced CTA Section with Particles Effect -->
    <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-blue-700 py-24 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px), radial-gradient(circle at 75% 75%, white 2px, transparent 2px); background-size: 50px 50px;"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-5xl font-black text-white mb-8">Ready to Transform Your Teaching?</h2>
            <p class="text-xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed">
                Join thousands of educators who are already creating better learning experiences and building stronger connections with their students.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('register') }}" class="group transform transition-all duration-300 hover:scale-105 hover:shadow-2xl inline-flex items-center justify-center px-10 py-5 border-2 border-white text-xl font-bold rounded-full text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-4 focus:ring-white/30 w-full sm:w-auto">
                    Start Free Trial
                    <svg class="ml-3 -mr-1 h-6 w-6 group-hover:translate-x-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="#" class="group transform transition-all duration-300 hover:scale-105 inline-flex items-center justify-center px-10 py-5 border-2 border-white text-xl font-bold rounded-full text-white hover:bg-white/10 focus:outline-none focus:ring-4 focus:ring-white/30 w-full sm:w-auto backdrop-blur-sm">
                    Schedule Demo
                    <svg class="ml-3 -mr-1 h-6 w-6 group-hover:translate-x-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
