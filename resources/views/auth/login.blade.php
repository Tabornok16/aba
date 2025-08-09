<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>A+Bayanihan — Login</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Fallback minimal styles to avoid crash if Vite isn't running/built */
                html { font-family: "Instrument Sans", ui-sans-serif, system-ui, sans-serif; }
                .hidden { display: none; }
            </style>
        @endif
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        <style>
            :root {
                --brand-blue: #213D6B;
                --brand-yellow: #F8B803;
                --brand-orange: #F07C5B;
                --cream: #FFF7E9;
                --panel: #FFF1DD;
            }
        </style>
    </head>
    <body class="min-h-screen bg-[#FFF7E9] text-[#1b1b18] font-sans">
        <div class="mx-auto max-w-6xl min-h-screen grid grid-cols-1 lg:grid-cols-2">
            <!-- Left: Form -->
            <div class="flex items-center justify-center p-8 lg:p-16 bg-white">
                <div class="w-full max-w-md">
                    <!-- Logo + Title -->
                    <div class="flex items-center gap-3 mb-10">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[var(--panel)] shadow border border-[#e8e2d6]">
                            <!-- Simple people logo -->
                            <svg viewBox="0 0 24 24" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="8" cy="8" r="3" fill="#F8B803"></circle>
                                <circle cx="16" cy="8" r="3" fill="#4AA3D8"></circle>
                                <circle cx="12" cy="14" r="3" fill="#F07C5B"></circle>
                            </svg>
                        </div>
                        <div class="text-2xl font-semibold tracking-tight">
                            <span class="text-[var(--brand-yellow)]">A+</span><span class="text-[var(--brand-blue)]">Bayanihan</span>
                        </div>
                    </div>

                    <h1 class="text-3xl lg:text-4xl font-bold mb-8">Welcome, Citizen!</h1>

                    <form action="#" method="post" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm mb-2" for="username">Username</label>
                            <input id="username" name="username" type="text" class="w-full h-12 px-4 rounded-xl border border-[#d9d9d9] focus:border-[var(--brand-blue)] focus:ring-2 focus:ring-[var(--brand-blue)]/20 outline-none" placeholder="Username" />
                        </div>
                        <div>
                            <label class="block text-sm mb-2" for="password">Password</label>
                            <div class="relative">
                                <input id="password" name="password" type="password" class="w-full h-12 pr-12 pl-4 rounded-xl border border-[#d9d9d9] focus:border-[var(--brand-blue)] focus:ring-2 focus:ring-[var(--brand-blue)]/20 outline-none" placeholder="Password" />
                                <button type="button" aria-label="Toggle password" class="absolute inset-y-0 right-0 px-4 text-[#707070]">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5">
                                        <path d="M2.25 12s3.75-6.75 9.75-6.75 9.75 6.75 9.75 6.75-3.75 6.75-9.75 6.75S2.25 12 2.25 12Z" />
                                        <circle cx="12" cy="12" r="2.75" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="w-full h-12 rounded-xl bg-[var(--brand-orange)] text-white font-semibold hover:brightness-95 transition">Log in</button>
                    </form>

                    <p class="mt-6 text-sm text-center text-[#6b6b6b]">
                        Don't have an Account?
                        <a href="/register" class="text-[var(--brand-orange)] font-medium hover:underline">Register Here</a>
                    </p>
                </div>
            </div>

            <!-- Right: Illustration -->
            <div class="hidden lg:flex items-center justify-center p-8 bg-[var(--cream)]">
                <div class="w-full max-w-xl">
                    <div class="relative mx-auto aspect-[4/3] rounded-2xl bg-[var(--panel)] border border-[#eddcc2] grid place-items-center overflow-hidden">
                        <!-- Simple illustrated composition to match layout vibe -->
                        <div class="absolute inset-0 grid grid-cols-4 grid-rows-4">
                            <div class="col-start-1 row-start-2 place-self-center w-28 h-28 rounded-full bg-white border border-[#e8e2d6] grid place-items-center">
                                <div class="w-10 h-10 rounded-lg bg-[var(--cream)] border border-[#e8e2d6] grid place-items-center text-[var(--brand-orange)] font-bold">+</div>
                            </div>
                            <div class="col-start-4 row-start-2 place-self-center w-28 h-28 rounded-full bg-white border border-[#e8e2d6] grid place-items-center">
                                <div class="w-10 h-10 rounded-md bg-[var(--cream)] border border-[#e8e2d6]"></div>
                            </div>
                            <div class="col-start-2 row-start-3 place-self-center w-28 h-28 rounded-full bg-white border border-[#e8e2d6] grid place-items-center">
                                <div class="w-10 h-10 rounded-full bg-[#ff6b6b]"></div>
                            </div>
                            <div class="col-start-3 row-start-3 place-self-center w-28 h-28 rounded-full bg-white border border-[#e8e2d6] grid place-items-center">
                                <div class="w-10 h-10 rounded-md bg-[var(--cream)] border border-[#e8e2d6]"></div>
                            </div>
                        </div>
                        <!-- Person -->
                        <div class="relative z-10 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 160" class="mx-auto w-44 h-56">
                                <rect x="50" y="110" width="20" height="40" fill="#2F4C7A"/>
                                <rect x="30" y="70" width="60" height="60" rx="8" fill="#E55C4A"/>
                                <circle cx="60" cy="50" r="18" fill="#F3C7A6"/>
                                <rect x="40" y="130" width="15" height="25" fill="#2F4C7A"/>
                                <rect x="65" y="130" width="15" height="25" fill="#2F4C7A"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-center mt-8 text-lg font-medium text-[#2c2a28]">Let’s help and contribute to a better community!</p>
                </div>
            </div>
        </div>
    </body>
    <script>
        // simple password toggle (no framework) for demo parity with the mock
        document.addEventListener('click', function (e) {
            if (e.target.closest('[aria-label="Toggle password"]')) {
                const input = document.getElementById('password');
                input.type = input.type === 'password' ? 'text' : 'password';
            }
        });
    </script>
    </html>


