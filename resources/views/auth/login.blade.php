<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>Login</title>
</head>
<body>


        <form method="POST" action="{{ route('login') }}">
        @csrf

        <h1>Log In</h1>
        <!-- Email Address -->
        <div class="div emaildiv">
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email address" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>


        <!-- Password -->
        <div class="mt-4 div">

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Password"  />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 div">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
        @if (Route::has('password.request'))
                <a class="forgot underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="login ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        

            @if (Route::has('register'))
            <a class="createaccount" href="{{ route('register')}}">

            {{ __('Create an account now !')}}
            </a>
            @endif
    </form>


</body>
</html>




