<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>Login</title>
</head>
<body>


        <form class="myForm" method="POST" action="{{ route('register') }}">
        @csrf

        <h1>Register</h1>



        <div class="div emaildiv">
    <x-text-input id="name" class="block mt-1 w-full" type="name" name="name" :value="old('name')" required autofocus autocomplete="username" placeholder="name address" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div class="div mt-4">
            <x-text-input id="Phone" class="block mt-1 w-full" type="Phone" name="Phone" :value="old('Phone')" required autocomplete="username" placeholder="phone number" />
            <x-input-error :messages="$errors->get('phonenumber')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="div emaildiv">
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email address" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>


        <!-- Password -->
        <div class="div emaildiv mt-4 div">

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Password"  />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


      <!-- Confirm Password -->
      <div class="div emaildiv mt-4">

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>



        <select name="role" id="selectoption">
            <option value="" selected disabled>Select account type</option>
            <option value="Doctor">Doctor</option>
            <option value="patient">Patient</option>
        </select>



        <div class="flex items-center justify-end mt-4">
        <x-primary-button class="register ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        

            @if (Route::has('login'))
            <a style="text-align:center" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            @endif
    </form>


<script src="{{ asset('assets/js/register.js') }}"></script>





    <script>
        window.specialites = @json($specialites);
    </script>

    <script src="{{ asset('path/to/your/external/js/file.js') }}"></script>


</body>
</html>




