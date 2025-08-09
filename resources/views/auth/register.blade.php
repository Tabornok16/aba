<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A+ Bayanihan - Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-6xl w-full flex bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Left side - Form -->
            <div class="w-1/2 p-12">
                <div class="flex items-center gap-3 mb-8 transition duration-300 hover:scale-102">
                    <svg class="w-12 h-12 filter drop-shadow" viewBox="0 0 48 48" fill="none">
                        <circle cx="18" cy="18" r="14" fill="#4AA3D8" fill-opacity="0.9"/>
                        <circle cx="30" cy="18" r="14" fill="#F8B803" fill-opacity="0.9"/>
                        <circle cx="24" cy="26" r="12" fill="#FF7B5B" fill-opacity="0.95"/>
                    </svg>
                    <div class="flex flex-col gap-0.5">
                        <span class="text-2xl leading-none">
                            <span class="font-bold text-[#F8B803]">A<span class="text-[#FF7B5B]">+</span></span>
                            <span class="font-semibold text-[#213D6B] tracking-tight">Bayanihan</span>
                        </span>
                    </div>
                </div>
                <h2 class="text-3xl font-bold mb-8">Sign up</h2>
                
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <input type="text" name="username" id="username" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" 
                            placeholder="Username"
                            required>
                        @error('username')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input type="email" name="email" id="email" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" 
                            placeholder="Email"
                            required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <input type="password" name="password" id="password" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" 
                            placeholder="Password"
                            required>
                        <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-3 text-gray-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" 
                            placeholder="Re-type Password"
                            required>
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-3 text-gray-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="w-full bg-coral-500 text-white py-3 rounded-lg font-semibold hover:bg-coral-600 transition duration-200">
                        Sign Up
                    </button>
                </form>

                <p class="mt-6 text-center text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-coral-500 font-semibold hover:text-coral-600">Log in here</a>
                </p>
            </div>

            <!-- Right side - Illustration -->
            <div class="w-1/2 bg-cream-50 p-12 flex flex-col justify-center items-center">
                <img src="{{ asset('images/illustration.jpg') }}" alt="Illustration" class="max-w-md mb-8">
                <h3 class="text-2xl font-bold text-center">Let's help and contribute to a better community!</h3>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
