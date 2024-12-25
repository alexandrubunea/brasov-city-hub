<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950">
    <livewire:NavigationBar active_tab="register"/>
    <div class="flex">
        <div class="bg-slate-900 text-zinc-200 rounded-xl mx-auto min-w-md max-w-xl p-5 my-10">
            <h1 class="font-bold text-4xl">Register <i class="fa-solid fa-address-card"></i></h1>
            <p class="mt-5 font-light text-sm">If you don't have an account yet, please sign up by providing the
                following informations to create a new account and get started.</p>
            <hr class="my-5 border-zinc-200">

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-5">
                    <label class="block font-semibold mb-2" for="first_name">First Name:</label>
                    <input
                        class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                        id="first_name" name="first_name" type="text" placeholder="First Name" required>
                    @error('first_name')
                        <livewire:Alert title="INVALID FIRST NAME" message="{{ $message }}" type="error" />
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block font-semibold mb-2" for="second_name">Second Name:</label>
                    <input
                        class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                        id="second_name" name="second_name" type="text" placeholder="Second Name" required>
                    @error('second_name')
                        <livewire:Alert title="INVALID SECOND NAME" message="{{ $message }}" type="error" />
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block font-semibold mb-2" for="username">Username:</label>
                    <input
                        class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                        id="username" name="username" type="text" placeholder="Username" required>
                    @error('username')
                        <livewire:Alert title="INVALID USERNAME" message="{{ $message }}" type="error" />
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block font-semibold mb-2" for="email">E-mail:</label>
                    <input
                        class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                        id="email" name="email" type="email" placeholder="E-mail" required>
                    @error('email')
                        <livewire:Alert title="INVALID EMAIL" message="{{ $message }}" type="error" />
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block font-semibold mb-2" for="password">Password:</label>
                    <input
                        class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                        id="password" name="password" type="password" placeholder="Password" required>
                    @error('password')
                        <livewire:Alert title="INVALID PASSWORD" message="{{ $message }}" type="error" />
                    @enderror
                </div>

                <div class="mb-20">
                    <label class="block font-semibold mb-2" for="confirm_password">Confirm Password:</label>
                    <input
                        class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                        id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Confirm Password" required>
                    @error('password_confirmation')
                        <livewire:Alert title="INVALID PASSWORD CONFIRMATION" message="{{ $message }}" type="error" />
                    @enderror
                </div>

                <div class="mb-5 gap-5">
                    <button
                        class="block font-bold bg-sky-500 hover:bg-sky-700 text-zinc-100 transition-colros duration-500 mx-auto p-5 border border-zinc-200 rounded-lg w-80 mb-5"
                        type="submit">Register</button>
                    <div class="mb-5 mx-auto w-80">
                        <p class="font-bold mb-2">Already have an account?</p>
                        <a class="block text-center font-bold bg-indigo-500 hover:bg-indigo-700 transition-colors duration-500 text-zinc-100 mx-auto p-5 border border-zinc-200 rounded-lg"
                            href="{{ route('login') }}">Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
