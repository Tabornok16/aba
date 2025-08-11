<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A+ Bayanihan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        coral: {
                            500: '#FF7B5B',
                            600: '#FF6B4A'
                        },
                        cream: {
                            50: '#FFF9E6'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 filter drop-shadow" viewBox="0 0 48 48" fill="none">
                        <circle cx="18" cy="18" r="14" fill="#4AA3D8" fill-opacity="0.9"/>
                        <circle cx="30" cy="18" r="14" fill="#F8B803" fill-opacity="0.9"/>
                        <circle cx="24" cy="26" r="12" fill="#FF7B5B" fill-opacity="0.95"/>
                    </svg>
                    <span class="text-xl">
                        <span class="font-bold text-[#F8B803]">A<span class="text-[#FF7B5B]">+</span></span>
                        <span class="font-semibold text-[#213D6B] tracking-tight">Bayanihan</span>
                    </span>
                </div>

                @auth
                <div class="flex items-center">
                    <span class="text-gray-700 mr-4">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-coral-500 hover:text-coral-600">Logout</button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <div x-data="{ sidebarOpen: true }" class="flex">
        <!-- Sidebar -->
        @auth
        <aside :class="{ 'w-64': sidebarOpen, 'w-20': !sidebarOpen }" class="bg-[#F8F9FC] min-h-screen shadow-lg transition-all duration-300">
            <div class="py-4" :class="{ 'px-6': sidebarOpen, 'px-2': !sidebarOpen }">
                <!-- Toggle Button -->
                <button @click="sidebarOpen = !sidebarOpen" class="mb-4 p-2 rounded-lg hover:bg-white hover:shadow-md transition-all w-full flex justify-center">
                    <svg class="w-6 h-6 text-[#213D6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            :d="sidebarOpen ? 'M11 19l-7-7 7-7M4 12h16' : 'M13 5l7 7-7 7M20 12H4'"/>
                    </svg>
                </button>
                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 rounded-lg text-[#213D6B] hover:bg-white hover:shadow-md transition-all" :class="{ 'justify-center': !sidebarOpen }">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="font-medium whitespace-nowrap" x-show="sidebarOpen" x-transition>Home</span>
                    </a>

                    <a href="{{ route('reports.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-[#213D6B] hover:bg-white hover:shadow-md transition-all" :class="{ 'justify-center': !sidebarOpen }">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span class="font-medium whitespace-nowrap" x-show="sidebarOpen" x-transition>Bantay Barangay</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-[#213D6B] hover:bg-white hover:shadow-md transition-all" :class="{ 'justify-center': !sidebarOpen }">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium whitespace-nowrap" x-show="sidebarOpen" x-transition>Bayanihan Connect</span>
                    </a>

                    <a href="{{ route('public-advisories.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-[#213D6B] hover:bg-white hover:shadow-md transition-all" :class="{ 'justify-center': !sidebarOpen }">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        <span class="font-medium whitespace-nowrap" x-show="sidebarOpen" x-transition>Public Advisory</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-[#213D6B] hover:bg-white hover:shadow-md transition-all" :class="{ 'justify-center': !sidebarOpen }">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium whitespace-nowrap" x-show="sidebarOpen" x-transition>Business Partnership</span>
                    </a>

                    <a href="{{ route('points.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-[#213D6B] hover:bg-white hover:shadow-md transition-all" :class="{ 'justify-center': !sidebarOpen }">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium whitespace-nowrap" x-show="sidebarOpen" x-transition>Rewards</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-[#213D6B] hover:bg-white hover:shadow-md transition-all" :class="{ 'justify-center': !sidebarOpen }">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span class="font-medium whitespace-nowrap" x-show="sidebarOpen" x-transition>eServisyo</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-[#213D6B] hover:bg-white hover:shadow-md transition-all" :class="{ 'justify-center': !sidebarOpen }">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="font-medium whitespace-nowrap" x-show="sidebarOpen" x-transition>Academic</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-[#213D6B] hover:bg-white hover:shadow-md transition-all" :class="{ 'justify-center': !sidebarOpen }">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="font-medium whitespace-nowrap" x-show="sidebarOpen" x-transition>Profile</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-lg text-red-500 hover:bg-white hover:shadow-md transition-all" :class="{ 'justify-center': !sidebarOpen }">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="font-medium whitespace-nowrap" x-show="sidebarOpen" x-transition>Logout</span>
                        </button>
                    </form>
                </nav>
            </div>
        </aside>
        @endauth

        <!-- Main Content -->
        <main class="flex-1 py-4 px-6">
        @yield('content')
    </main>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
