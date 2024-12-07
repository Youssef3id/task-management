<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="java.js">
</head>

<body>
    <section class="container">
        <div class="login-container">
            <!-- Circles for decorative effect -->
            <div class="circle circle-one"></div>

            <div class="form-container">
                <!-- Illustration image -->
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                    alt="illustration" class="illustration" />

                <!-- Title -->
                <h1 class="opacity">LOGIN</h1>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Username input -->
                    <input type="email" id="email" name="email" placeholder="USERNAME"
                        value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="opacity block mt-1 w-full">

                    <!-- Password input -->
                    <input type="password" id="password" name="password" placeholder="PASSWORD" required
                        autocomplete="current-password" class="opacity block mt-1 w-full">

                    <!-- Remember Me checkbox -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="opacity">
                        {{ __('Log in') }}
                    </button>
                </form>

                <!-- Register and Forgot Password Links -->
                <div class="register-forget opacity">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">FORGOT PASSWORD</a>
                    @endif
                    <span class="mx-2">|</span>
                    <a href="{{ route('register') }}">REGISTER</a>
                </div>

                <!-- External Login Options -->
                <div class="flex justify-center mt-4">
                    <a href="{{ route('login.google') }}" class="text-sm text-blue-500 hover:text-blue-700">
                        {{ __('Login with Google') }}
                    </a>
                    <span class="mx-2">|</span>
                    <a href="{{ route('login.github') }}" class="text-sm text-blue-500 hover:text-blue-700">
                        {{ __('Login with GitHub') }}
                    </a>
                </div>
            </div>

            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>

</html>
