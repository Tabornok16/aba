<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>A+ Bayanihan App</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <style>
            :root {
                --primary-blue: #4AA3D8;
                --primary-yellow: #F8B803;
                --primary-orange: #FF7B5B;
                --primary-red: #FF4D4D;
                --bg-cream: #FFF7E9;
                --text-dark: #2C2C2C;
                --border-light: #E5E5E5;
            }
            
            body {
                margin: 0;
                padding: 0;
                font-family: "Instrument Sans", system-ui, sans-serif;
                min-height: 100vh;
                display: flex;
                background: white;
            }
            
            .container {
                display: flex;
                width: 100%;
            }
            
            .login-section {
                flex: 1;
                padding: 48px;
                background: white;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            
            .logo-container {
                margin-bottom: 40px;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            
            .logo-icon {
                width: 40px;
                height: 40px;
            }
            
            .logo-text {
                font-size: 24px;
                font-weight: 600;
            }
            
            .form-container {
                width: 100%;
                max-width: 360px;
            }
            
            h1 {
                font-size: 32px;
                margin: 0 0 32px;
                font-weight: 600;
                color: var(--text-dark);
            }
            
            .input-field {
                width: 100%;
                padding: 16px;
                background: #F5F8FF;
                border: 1px solid transparent;
                border-radius: 12px;
                margin-bottom: 16px;
                font-size: 16px;
                box-sizing: border-box;
                outline: none;
                transition: all 0.2s;
            }
            
            .input-field:focus {
                border-color: var(--primary-blue);
                background: white;
            }
            
            .password-field {
                position: relative;
            }
            
            .password-toggle {
                position: absolute;
                right: 16px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                opacity: 0.5;
                transition: opacity 0.2s;
            }
            
            .password-toggle:hover {
                opacity: 0.8;
            }
            
            .login-button {
                width: 100%;
                padding: 16px;
                background: var(--primary-orange);
                color: white;
                border: none;
                border-radius: 12px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: opacity 0.2s;
                margin-top: 8px;
            }
            
            .login-button:hover {
                opacity: 0.9;
            }ifference?
            
            .register-text {
                margin-top: 24px;
                text-align: center;
                color: #666;
                font-size: 14px;
            }
            
            .register-text a {
                color: var(--primary-orange);
                text-decoration: none;
                font-weight: 500;
            }
            
            .register-text a:hover {
                text-decoration: underline;
            }
            
            .illustration-section {
                flex: 1;
                background: var(--bg-cream);
                padding: 48px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
            }
            
            .illustration-container {
                position: relative;
                width: 400px;
                height: 400px;
                margin-bottom: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .illustration-image {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }
            
            .illustration-text {
                font-size: 20px;
                color: var(--text-dark);
                font-weight: 500;
                max-width: 360px;
                line-height: 1.4;
                margin: 0;
            }
            
            @media (max-width: 1024px) {
                .illustration-section {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="login-section">
                <div class="logo-container">
                    <svg class="logo-icon" viewBox="0 0 40 40" fill="none">
                        <circle cx="15" cy="15" r="12" fill="#4AA3D8"/>
                        <circle cx="25" cy="15" r="12" fill="#F8B803"/>
                        <circle cx="20" cy="22" r="10" fill="#FF7B5B"/>
                    </svg>
                    <span class="logo-text">
                        <span style="color: #F8B803;">A+</span>
                        <span style="color: #213D6B;">Bayanihan App</span>
                    </span>
                </div>
                
                <div class="form-container">
                    <h1>Welcome, Rosenian!</h1>
                    
                    <form method="POST" action="/login">
                        @csrf
                        <input type="email" class="input-field" name="email" placeholder="j.velandres@sunlogistics.com.ph" required>
                        
                        <div class="password-field">
                            <input type="password" class="input-field" name="password" placeholder="Enter your password" required autocomplete="current-password">
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <a href="{{ route('password.request') }}" class="text-sm text-primary-orange hover:underline">
                                Forgot Your Password?
                            </a>
                        </div>

                        <button type="submit" class="login-button">Log in</button>
                    </form>
                    
                    <p class="register-text">
                        Don't have an Account? <a href="/register">Register Here</a>
                    </p>
                </div>
            </div>
            
            <div class="illustration-section">
                <div class="illustration-container">
                    <img src="{{ asset('images/illustration.jpg') }}" alt="Community Contribution Illustration" class="illustration-image">
                </div>
                
                <p class="illustration-text">
                    Let's help and contribute to a better community!
                </p>
            </div>
        </div>

        <script>
            document.querySelector('.password-toggle').addEventListener('click', function() {
                var input = document.querySelector('input[type="password"]');
                if (input.type === 'password') {
                    input.type = 'text';
                } else {
                    input.type = 'password';
                }
            });
        </script>
    </body>
</html>