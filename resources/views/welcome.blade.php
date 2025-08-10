<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ABA - A+ Bayanihan App | Empowering Communities, Rewarding Civic Engagement</title>
        
        <!-- SEO Meta Tags -->
        <meta name="description" content="ABA transforms community service into a rewarding experience through a point-based system. Join us in building a stronger, smarter, and more connected Santa Rosa City.">
        <meta name="keywords" content="Bayanihan app Santa Rosa, civic engagement Philippines, barangay rewards system, community point system, youth participation app, Santa Rosa Laguna app">
        <meta name="robots" content="index, follow">
        <meta name="author" content="STI College Santa Rosa">
        <link rel="canonical" href="{{ url('/') }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:title" content="ABA - A+ Bayanihan App | Empowering Communities">
        <meta property="og:description" content="Transform community service into a rewarding experience. Join us in building a stronger Santa Rosa City.">
        <meta property="og:image" content="{{ asset('images/logo.jpg') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url('/') }}">
        <meta property="twitter:title" content="ABA - A+ Bayanihan App | Empowering Communities">
        <meta property="twitter:description" content="Transform community service into a rewarding experience. Join us in building a stronger Santa Rosa City.">
        <meta property="twitter:image" content="{{ asset('images/logo.jpg') }}">

        <!-- Favicon -->
        <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo.jpg') }}">
        
        <!-- Language -->
        <link rel="alternate" href="{{ url('/') }}" hreflang="en-PH">
        <link rel="alternate" href="{{ url('/') }}" hreflang="tl">
        <link rel="alternate" href="{{ url('/') }}" hreflang="x-default">

        <!-- Preload Critical Assets -->
        <link rel="preload" href="{{ asset('images/logo.jpg') }}" as="image">
        <link rel="preload" href="{{ asset('images/sti.jpg') }}" as="image">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@700;800&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen font-['Inter']">
        <!-- Navigation -->
        <nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">
                <a href="/" class="flex items-center space-x-6">
                    <img src="{{ asset('images/logo.jpg') }}" class="h-16 w-16 object-contain" alt="ABA Logo">
                    <span class="font-bold text-xl"><span class="text-[#F4B223]">A+</span><span class="text-[#1B2B65] dark:text-[#F4B223]">Bayanihan</span></span>
                </a>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-[#1B2B65] hover:bg-[#F4B223] rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="text-gray-700 dark:text-gray-200 hover:text-yellow-600 dark:hover:text-yellow-400 font-medium transition-colors duration-200">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-[#1B2B65] hover:bg-[#F4B223] rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                    Join the Community
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-gradient-to-b from-yellow-50 to-white dark:from-gray-900 dark:to-gray-800">
                <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMzLjMxNCAwIDYtMi42ODYgNi02cy0yLjY4Ni02LTYtNmMtMy4zMTQgMC02IDIuNjg2LTYgNnMyLjY4NiA2IDYgNnptMC0yYTQgNCAwIDEwMC04IDQgNCAwIDAwMCA4em0xMiAxNGMzLjMxNCAwIDYtMi42ODYgNi02cy0yLjY4Ni02LTYtNmMtMy4zMTQgMC02IDIuNjg2LTYgNnMyLjY4NiA2IDYgNnptMC0yYTQgNCAwIDEwMC04IDQgNCAwIDAwMCA4ek0xOCAzNmMzLjMxNCAwIDYtMi42ODYgNi02cy0yLjY4Ni02LTYtNmMtMy4zMTQgMC02IDIuNjg2LTYgNnMyLjY4NiA2IDYgNnptMC0yYTQgNCAwIDEwMC04IDQgNCAwIDAwMCA4em0wIDEyYzMuMzE0IDAgNi0yLjY4NiA2LTZzLTIuNjg2LTYtNi02Yy0zLjMxNCAwLTYgMi42ODYtNiA2czIuNjg2IDYgNiA2em0wLTJhNCA0IDAgMTAwLTggNCA0IDAgMDAwIDh6bTEyLTEwYzMuMzE0IDAgNi0yLjY4NiA2LTZzLTIuNjg2LTYtNi02Yy0zLjMxNCAwLTYgMi42ODYtNiA2czIuNjg2IDYgNiA2em0wLTJhNCA0IDAgMTAwLTggNCA0IDAgMDAwIDh6IiBmaWxsPSIjMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48L2c+PC9zdmc+')] dark:opacity-5"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <!-- App Badge -->
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 mb-8">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                        </svg>
                        Empowering Communities Through Technology
                    </div>
                    
                    <!-- Main Title -->
                    <h1 class="font-['Poppins'] text-5xl sm:text-6xl lg:text-7xl font-extrabold mb-6">
                        <span class="text-[#F4B223]">A+</span><span class="text-[#1B2B65] dark:text-[#F4B223]">Bayanihan</span>
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="max-w-2xl mx-auto text-xl sm:text-2xl text-gray-600 dark:text-gray-300 mb-8">
                        Empowering communities through <span class="font-semibold text-yellow-600 dark:text-yellow-400">rewards</span> for civic engagement
                    </p>
                    
                    <!-- Participant Badge -->
                    <div class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 border border-gray-200 dark:border-gray-700 shadow-sm mb-12">
                        <img src="{{ asset('images/sti.jpg') }}" class="h-8 w-auto mr-3" alt="STI Logo">
                        <span class="text-lg font-medium text-gray-800 dark:text-gray-200">Project by STI College Santa Rosa</span>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                        <a href="{{ route('register') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-[#1B2B65] hover:bg-[#F4B223] rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Join Your Community
                        </a>
                        <a href="#features" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Explore Features
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-white dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Key Features</h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                        Discover how A+ Bayanihan App transforms community service into a rewarding experience
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- User Management -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/50 text-yellow-600 dark:text-yellow-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">User Management</h3>
                            <p class="text-gray-600 dark:text-gray-300">Specialized roles for administrators, residents, and academic scholars</p>
                        </div>
                    </div>

                    <!-- Bantay Barangay -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Bantay Barangay</h3>
                            <p class="text-gray-600 dark:text-gray-300">Report and track community incidents and concerns</p>
                        </div>
                    </div>

                    <!-- Bayanihan Connect -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Bayanihan Connect</h3>
                            <p class="text-gray-600 dark:text-gray-300">Share and verify community news to earn points</p>
                        </div>
                    </div>

                    <!-- Rewards System -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Rewards System</h3>
                            <p class="text-gray-600 dark:text-gray-300">Redeem points for goods, food, and school supplies</p>
                        </div>
                    </div>

                    <!-- Scholar Hub -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Scholar Hub</h3>
                            <p class="text-gray-600 dark:text-gray-300">Special rewards for academic scholars</p>
                        </div>
                    </div>

                    <!-- eSerbisyo -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">eSerbisyo</h3>
                            <p class="text-gray-600 dark:text-gray-300">Direct access to Santa Rosa City's public services</p>
                        </div>
                    </div>
                </div>

                <!-- SDG Section -->
                <div class="mt-20 text-center">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Supporting UN Sustainable Development Goals</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                            <div class="text-2xl font-bold text-red-600 dark:text-red-400 mb-2">SDG 1</div>
                            <p class="text-gray-600 dark:text-gray-300">No Poverty</p>
                        </div>
                        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-2">SDG 4</div>
                            <p class="text-gray-600 dark:text-gray-300">Quality Education</p>
                        </div>
                        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-2">SDG 11</div>
                            <p class="text-gray-600 dark:text-gray-300">Sustainable Cities</p>
                        </div>
                        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400 mb-2">SDG 16</div>
                            <p class="text-gray-600 dark:text-gray-300">Peace & Justice</p>
                        </div>
                    </div>
                </div>

                <!-- Project Badge -->
                <div class="mt-20 text-center">
                    <div class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 border border-gray-200 dark:border-gray-700 shadow-sm">
                        <img src="{{ asset('images/sti.jpg') }}" class="h-10 w-auto mr-4" alt="STI Logo">
                        <div class="text-left">
                            <p class="text-sm text-gray-600 dark:text-gray-400">A Project by</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">STI College Santa Rosa</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>