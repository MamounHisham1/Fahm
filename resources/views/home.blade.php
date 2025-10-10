<x-layouts.app :title="__('Home')">
    <!-- Hero Section with Background Image -->
    <div class="relative min-h-screen overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img 
                src="{{ asset('main-section.webp') }}"
                alt="Platform Overview"
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/80"></div>
        </div>
        
        <!-- Grid Pattern Overlay -->
        <div class="absolute inset-0 bg-grid-slate-100/10 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.1))]"></div>
        
        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 pt-20 pb-16 sm:pt-32 sm:pb-24 sm:px-6 lg:px-8 min-h-screen flex items-center">
            <div class="text-center w-full">
                <div class="animate-fade-in-up">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-black tracking-tight bg-gradient-to-r from-white via-blue-100 to-purple-100 text-transparent bg-clip-text mb-6 sm:mb-8 lg:mb-10 drop-shadow-2xl leading-tight">
                        Connect with your students
                    </h1>
                    <p class="max-w-2xl mx-auto text-lg sm:text-xl lg:text-2xl text-white/90 leading-relaxed font-light mb-8 sm:mb-10 lg:mb-12 px-2">
                        Transform your teaching experience with our powerful platform designed to help educators create engaging and interactive learning environments.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center items-center px-4 sm:px-0">
                        <a href="{{ route('register') }}" class="group transform transition-all duration-300 hover:scale-105 hover:shadow-2xl inline-flex items-center justify-center px-6 sm:px-8 lg:px-10 py-3 sm:py-4 lg:py-5 border-2 border-transparent text-base sm:text-lg lg:text-xl font-bold rounded-full shadow-2xl text-white bg-gradient-to-r from-blue-600 via-purple-600 to-blue-700 hover:from-blue-700 hover:via-purple-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500/50 w-full sm:w-auto backdrop-blur-sm">
                            Get Started Free
                            <svg class="ml-2 sm:ml-3 -mr-1 h-5 w-5 sm:h-6 sm:w-6 group-hover:translate-x-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#how-it-works" class="group transform transition-all duration-300 hover:scale-105 inline-flex items-center justify-center px-6 sm:px-8 lg:px-10 py-3 sm:py-4 lg:py-5 border-2 border-white/30 text-base sm:text-lg lg:text-xl font-bold rounded-full text-white bg-white/10 backdrop-blur-md hover:bg-white/20 hover:border-white/50 focus:outline-none focus:ring-4 focus:ring-white/30 w-full sm:w-auto">
                            Learn More
                            <svg class="ml-2 sm:ml-3 -mr-1 h-5 w-5 sm:h-6 sm:w-6 group-hover:translate-y-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-4 sm:bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-5 h-8 sm:w-6 sm:h-10 border-2 border-white/50 rounded-full flex justify-center">
                <div class="w-1 h-2 sm:h-3 bg-white/70 rounded-full mt-1 sm:mt-2 animate-pulse"></div>
            </div>
        </div>
    </div>

    <!-- Stats Section with Glass Effect -->  
    <div class="relative -mt-16 sm:-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/95 backdrop-blur-xl rounded-2xl sm:rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 lg:p-12 mx-2 sm:mx-0">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 lg:gap-12">
                    <div class="text-center group">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-blue-600 group-hover:scale-110 transition-transform duration-300">10k+</div>
                        <div class="mt-2 sm:mt-3 text-sm sm:text-base text-gray-600 font-medium">Active Students</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-purple-600 group-hover:scale-110 transition-transform duration-300">5k+</div>
                        <div class="mt-2 sm:mt-3 text-sm sm:text-base text-gray-600 font-medium">Teachers</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-green-600 group-hover:scale-110 transition-transform duration-300">1M+</div>
                        <div class="mt-2 sm:mt-3 text-sm sm:text-base text-gray-600 font-medium">Lessons Created</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-red-600 group-hover:scale-110 transition-transform duration-300">98%</div>
                        <div class="mt-2 sm:mt-3 text-sm sm:text-base text-gray-600 font-medium">Satisfaction Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Cards with Enhanced Design -->
    <div class="max-w-7xl mx-auto px-4 py-16 sm:py-20 lg:py-24 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16 lg:mb-20">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 mb-4 sm:mb-6 px-2">Everything you need to succeed</h2>
            <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto px-4">Powerful features to help you manage your classroom effectively and create engaging learning experiences</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-10">
            <div class="group p-6 sm:p-8 bg-white rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 mx-2 sm:mx-0">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4 text-gray-900">Easy to Start</h3>
                <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Create your first lesson in minutes with our intuitive interface designed for educators.</p>
            </div>

            <div class="group p-6 sm:p-8 bg-white rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 mx-2 sm:mx-0">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4 text-gray-900">Engage Students</h3>
                <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Interactive tools and multimedia content to keep your students motivated and actively involved.</p>
            </div>

            <div class="group p-6 sm:p-8 bg-white rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 mx-2 sm:mx-0 sm:col-span-2 lg:col-span-1">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4 text-gray-900">Track Progress</h3>
                <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Monitor student performance with detailed analytics, insights, and personalized feedback.</p>
            </div>
        </div>
    </div>

    <!-- How It Works Section with Enhanced Design -->
    <div id="how-it-works" class="bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 py-16 sm:py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 mb-4 sm:mb-6 px-2">How It Works</h2>
                <p class="text-lg sm:text-xl text-gray-600 px-4">Get started in minutes, not hours</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 lg:gap-16">
                <div class="space-y-6 sm:space-y-8">
                    <div class="group flex items-start gap-4 sm:gap-6 px-2 sm:px-0">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-blue-600 font-bold text-base sm:text-lg">1</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-gray-900">Create Your School Profile</h3>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Set up your school's profile with custom branding, educational goals, and personalized settings.</p>
                        </div>
                    </div>
                    <div class="group flex items-start gap-4 sm:gap-6 px-2 sm:px-0">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-purple-600 font-bold text-base sm:text-lg">2</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-gray-900">Add Your Subjects</h3>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Organize your curriculum by creating subjects, lesson plans, and learning objectives.</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-6 sm:space-y-8">
                    <div class="group flex items-start gap-4 sm:gap-6 px-2 sm:px-0">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-green-600 font-bold text-base sm:text-lg">3</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-gray-900">Invite Students</h3>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Connect with your students through secure invitations and start sharing your lessons.</p>
                        </div>
                    </div>
                    <div class="group flex items-start gap-4 sm:gap-6 px-2 sm:px-0">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-red-600 font-bold text-base sm:text-lg">4</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 text-gray-900">Track Progress</h3>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Monitor student engagement and achievement with detailed analytics and progress reports.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section with Enhanced Cards -->
    <div class="max-w-7xl mx-auto px-4 py-16 sm:py-20 lg:py-24 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16 lg:mb-20">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 mb-4 sm:mb-6 px-2">Loved by Educators</h2>
            <p class="text-lg sm:text-xl text-gray-600 px-4">Don't just take our word for it</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-12">
            <blockquote class="group p-6 sm:p-8 bg-white rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 mx-2 sm:mx-0">
                <div class="flex items-center mb-4 sm:mb-6 gap-1">
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
                <p class="text-gray-600 mb-4 sm:mb-6 text-base sm:text-lg leading-relaxed">"This platform has transformed how I connect with my students. The interactive features make learning more engaging than ever before."</p>
                <footer class="flex items-center gap-3 sm:gap-4">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-bold text-base sm:text-lg">SJ</span>
                    </div>
                    <div>
                        <cite class="font-bold not-italic text-gray-900 text-sm sm:text-base">Sarah Johnson</cite>
                        <p class="text-xs sm:text-sm text-gray-500">Math Teacher</p>
                    </div>
                </footer>
            </blockquote>
            <blockquote class="group p-6 sm:p-8 bg-white rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 mx-2 sm:mx-0">
                <div class="flex items-center mb-4 sm:mb-6 gap-1">
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
                <p class="text-gray-600 mb-4 sm:mb-6 text-base sm:text-lg leading-relaxed">"The analytics help me understand exactly where my students need support. It's like having a teaching assistant that never sleeps."</p>
                <footer class="flex items-center gap-3 sm:gap-4">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center">
                        <span class="text-green-600 font-bold text-base sm:text-lg">MC</span>
                    </div>
                    <div>
                        <cite class="font-bold not-italic text-gray-900 text-sm sm:text-base">Michael Chen</cite>
                        <p class="text-xs sm:text-sm text-gray-500">Science Teacher</p>
                    </div>
                </footer>
            </blockquote>
        </div>
    </div>

    <!-- Enhanced CTA Section with Particles Effect -->
    <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-blue-700 py-16 sm:py-20 lg:py-24 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px), radial-gradient(circle at 75% 75%, white 2px, transparent 2px); background-size: 50px 50px;"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-6 sm:mb-8 px-2">Ready to Transform Your Teaching?</h2>
            <p class="text-base sm:text-lg lg:text-xl text-white/90 mb-8 sm:mb-10 lg:mb-12 max-w-3xl mx-auto leading-relaxed px-4">
                Join thousands of educators who are already creating better learning experiences and building stronger connections with their students.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center items-center px-4 sm:px-0">
                <a href="{{ route('register') }}" class="group transform transition-all duration-300 hover:scale-105 hover:shadow-2xl inline-flex items-center justify-center px-8 sm:px-10 py-4 sm:py-5 border-2 border-white text-lg sm:text-xl font-bold rounded-full text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-4 focus:ring-white/30 w-full sm:w-auto">
                    Start Free Trial
                    <svg class="ml-2 sm:ml-3 -mr-1 h-5 w-5 sm:h-6 sm:w-6 group-hover:translate-x-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="#" class="group transform transition-all duration-300 hover:scale-105 inline-flex items-center justify-center px-8 sm:px-10 py-4 sm:py-5 border-2 border-white text-lg sm:text-xl font-bold rounded-full text-white hover:bg-white/10 focus:outline-none focus:ring-4 focus:ring-white/30 w-full sm:w-auto backdrop-blur-sm">
                    Schedule Demo
                    <svg class="ml-2 sm:ml-3 -mr-1 h-5 w-5 sm:h-6 sm:w-6 group-hover:translate-x-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
