<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A+ Bayanihan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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

    <main class="py-4">
        @yield('content')
    </main>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
