<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="IGNITE Hackathon 2024 - A City-wide Innovation Challenge by the City Youth Development Office of Santa Rosa">

        <title>IGNITE Hackathon 2024 - City of Santa Rosa</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="http://localhost:5173/@vite/client"></script>
            <script src="http://localhost:5173/resources/js/app.js"></script>
            <link rel="stylesheet" href="http://localhost:5173/resources/css/app.css">
        @endif
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen font-['Inter']">
        <!-- Navigation -->
        <nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">
                <a href="/" class="flex items-center space-x-6">
                    <img src="{{ asset('images/STA_ROSA_LOGO.jpg') }}" class="h-16 w-16 object-contain" alt="Santa Rosa Logo">
                    <div class="h-10 w-px bg-gray-200 dark:bg-gray-700"></div>
                    <img src="{{ asset('images/sti.jpg') }}" class="h-12 w-auto object-contain" alt="STI Logo">
                </a>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors duration-200">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                    Register Now
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
            <div class="absolute inset-0 bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800">
                <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,transparent,black)] dark:bg-grid-slate-700/25"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <!-- Event Badge -->
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 mb-8">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                        City-wide Innovation Challenge 2025
                    </div>
                    
                    <!-- Main Title -->
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400 mb-6">
                        IGNITE <span class="text-orange-600 dark:text-orange-500">HACKATHON</span>
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="max-w-2xl mx-auto text-xl sm:text-2xl text-gray-600 dark:text-gray-300 mb-8">
                        An Initiative by the <span class="font-semibold text-gray-800 dark:text-gray-100">City Youth Development Office of Santa Rosa</span>
                    </p>
                    
                    <!-- Participant Badge -->
                    <div class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 border border-gray-200 dark:border-gray-700 shadow-sm mb-12">
                        <img src="{{ asset('images/sti.jpg') }}" class="h-8 w-auto mr-3" alt="STI Logo">
                        <span class="text-lg font-medium text-gray-800 dark:text-gray-200">Proud Participant</span>
                    </div>

                    <!-- Feature Cards -->
                    <div class="grid md:grid-cols-3 gap-8 mb-12">
                        <div class="relative group">
                            <div class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-blue-600 to-blue-400 opacity-25 group-hover:opacity-50 blur transition duration-200"></div>
                            <div class="relative p-6 bg-white dark:bg-gray-800 rounded-xl">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 mb-4 mx-auto">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Innovation</h3>
                                <p class="text-gray-600 dark:text-gray-300">Transform ideas into impactful solutions</p>
                            </div>
                        </div>
                        
                        <div class="relative group">
                            <div class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-orange-600 to-orange-400 opacity-25 group-hover:opacity-50 blur transition duration-200"></div>
                            <div class="relative p-6 bg-white dark:bg-gray-800 rounded-xl">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/50 text-orange-600 dark:text-orange-400 mb-4 mx-auto">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Collaboration</h3>
                                <p class="text-gray-600 dark:text-gray-300">Connect with brilliant minds</p>
                            </div>
                        </div>
                        
                        <div class="relative group">
                            <div class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-green-600 to-green-400 opacity-25 group-hover:opacity-50 blur transition duration-200"></div>
                            <div class="relative p-6 bg-white dark:bg-gray-800 rounded-xl">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 mb-4 mx-auto">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Impact</h3>
                                <p class="text-gray-600 dark:text-gray-300">Create meaningful change</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                        <a href="{{ route('register') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Register Now
                        </a>
                        <a href="#about" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="relative py-24 bg-white dark:bg-gray-900 overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.indigo.100),white)] dark:bg-[radial-gradient(45rem_50rem_at_top,theme(colors.indigo.900),theme(colors.gray.900))] opacity-40"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-base font-semibold leading-7 text-blue-600 dark:text-blue-400 mb-4">About the Event</h2>
                    <h3 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl mb-6">
                        Empowering Young Innovators
                    </h3>
                    <p class="text-lg leading-8 text-gray-600 dark:text-gray-300">
                        A city-wide initiative bringing together brilliant minds to create solutions that matter. Join us in shaping the future of Santa Rosa through technology and innovation.
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="relative">
                        <div class="absolute -inset-4">
                            <div class="w-full h-full mx-auto opacity-30 blur-lg filter bg-gradient-to-r from-blue-400 to-indigo-400"></div>
                        </div>
                        <div class="relative">
                            <img src="{{ asset('images/illustration.jpg') }}" alt="Hackathon Illustration" class="rounded-2xl shadow-2xl w-full">
                            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10 dark:ring-white/10"></div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-3xl p-8 shadow-xl ring-1 ring-gray-900/10 dark:ring-white/10">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Why Participate?</h3>
                            
                            <div class="space-y-6">
                                <!-- Skill Development -->
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Skill Development</h4>
                                        <p class="mt-2 text-gray-600 dark:text-gray-300">Showcase and enhance your technical skills through real-world challenges</p>
                                    </div>
                                </div>

                                <!-- Networking -->
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-orange-100 dark:bg-orange-900/50 text-orange-600 dark:text-orange-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Industry Connections</h4>
                                        <p class="mt-2 text-gray-600 dark:text-gray-300">Network with industry professionals, mentors, and fellow innovators</p>
                                    </div>
                                </div>

                                <!-- Recognition -->
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Prizes & Recognition</h4>
                                        <p class="mt-2 text-gray-600 dark:text-gray-300">Win exciting prizes and gain recognition for your innovative solutions</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-center">
                                <a href="{{ route('register') }}" 
                                   class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                    Join the Challenge
                                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>