<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-950 to-slate-900 min-h-screen">
    <livewire:NavigationBar active_tab="register" />

    <div class="container mx-auto px-4 flex items-center justify-center">
        <div
            class="w-full max-w-md bg-slate-900/90 backdrop-blur-sm text-zinc-200 rounded-2xl shadow-xl shadow-slate-900/20 p-6 sm:p-8 my-8">
            <div class="space-y-4">
                <h1 class="font-bold text-3xl sm:text-4xl flex items-center gap-3">
                    Register
                    <i class="fa-solid fa-address-card text-indigo-500"></i>
                </h1>

                <p class="font-light text-sm text-zinc-400">
                    Create your account by providing the following information to get started.
                </p>

                <hr class="border-zinc-700">

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block font-medium" for="first_name">First Name</label>
                            <input
                                class="w-full bg-zinc-800/50 text-zinc-200 border border-zinc-700 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 focus:outline-none transition-all duration-200 p-3"
                                id="first_name" name="first_name" type="text" placeholder="Enter first name"
                                required>
                            @error('first_name')
                                <livewire:Alert title="INVALID FIRST NAME" message="{{ $message }}" type="error" />
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block font-medium" for="last_name">Last Name</label>
                            <input
                                class="w-full bg-zinc-800/50 text-zinc-200 border border-zinc-700 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 focus:outline-none transition-all duration-200 p-3"
                                id="last_name" name="last_name" type="text" placeholder="Enter last name" required>
                            @error('last_name')
                                <livewire:Alert title="INVALID LAST NAME" message="{{ $message }}" type="error" />
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block font-medium" for="username">Username</label>
                        <input
                            class="w-full bg-zinc-800/50 text-zinc-200 border border-zinc-700 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 focus:outline-none transition-all duration-200 p-3"
                            id="username" name="username" type="text" placeholder="Choose a username" required>
                        @error('username')
                            <livewire:Alert title="INVALID USERNAME" message="{{ $message }}" type="error" />
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block font-medium" for="email">E-mail</label>
                        <input
                            class="w-full bg-zinc-800/50 text-zinc-200 border border-zinc-700 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 focus:outline-none transition-all duration-200 p-3"
                            id="email" name="email" type="email" placeholder="Enter your email" required>
                        @error('email')
                            <livewire:Alert title="INVALID EMAIL" message="{{ $message }}" type="error" />
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block font-medium" for="password">Password</label>
                        <input
                            class="w-full bg-zinc-800/50 text-zinc-200 border border-zinc-700 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 focus:outline-none transition-all duration-200 p-3"
                            id="password" name="password" type="password" placeholder="Create a password" required>
                        @error('password')
                            <livewire:Alert title="INVALID PASSWORD" message="{{ $message }}" type="error" />
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block font-medium" for="password_confirmation">Confirm Password</label>
                        <input
                            class="w-full bg-zinc-800/50 text-zinc-200 border border-zinc-700 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 focus:outline-none transition-all duration-200 p-3"
                            id="password_confirmation" name="password_confirmation" type="password"
                            placeholder="Confirm your password" required>
                        @error('password_confirmation')
                            <livewire:Alert title="INVALID PASSWORD CONFIRMATION" message="{{ $message }}"
                                type="error" />
                        @enderror
                    </div>

                    <div class="space-y-6 pt-4">
                        <button
                            class="w-full bg-sky-500 hover:bg-sky-600 active:bg-sky-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-sky-500/25"
                            type="submit">
                            Create Account
                        </button>

                        <div class="text-center">
                            <p class="font-medium text-zinc-400 mb-2">Already have an account?</p>
                            <a class="block w-full bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-indigo-500/25"
                                href="{{ route('login') }}">
                                Sign In
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<livewire:footer />
</body>

</html>
