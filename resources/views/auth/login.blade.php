<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-950 to-slate-900 min-h-screen">
    <livewire:NavigationBar active_tab="login" />

    <div class="container mx-auto px-4 flex items-center justify-center">
        <div
            class="w-full max-w-md bg-slate-900/90 backdrop-blur-sm text-zinc-200 rounded-2xl shadow-xl shadow-slate-900/20 p-6 sm:p-8 my-8">
            <div class="space-y-4">
                <h1 class="font-bold text-3xl sm:text-4xl flex items-center gap-3">
                    Login
                    <i class="fa-solid fa-unlock-keyhole text-sky-500"></i>
                </h1>

                <p class="font-light text-sm text-zinc-400">
                    If you already have an account, please enter your email or username along with your password to log
                    in.
                </p>

                <hr class="border-zinc-700">

                @error('email')
                    <livewire:Alert title="INVALID E-MAIL OR USERNAME"
                        message="The e-mail or username you entered does not exist in our records." type="error" />
                @enderror

                @error('password')
                    <livewire:Alert title="INVALID PASSWORD" message="The password you entered is incorrect."
                        type="error" />
                @enderror

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="block font-medium" for="username_or_email">
                            Username or e-mail
                        </label>
                        <input
                            class="w-full bg-zinc-800/50 text-zinc-200 border border-zinc-700 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 focus:outline-none transition-all duration-200 p-3"
                            id="email" name="email" type="text" maxlength="64"
                            placeholder="Enter your username or email" required>
                    </div>

                    <div class="space-y-2">
                        <label class="block font-medium" for="password">
                            Password
                        </label>
                        <input
                            class="w-full bg-zinc-800/50 text-zinc-200 border border-zinc-700 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 focus:outline-none transition-all duration-200 p-3"
                            id="password" name="password" type="password" placeholder="Enter your password" required>
                    </div>

                    <div class="space-y-6 pt-4">
                        <button
                            class="w-full bg-sky-500 hover:bg-sky-600 active:bg-sky-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-sky-500/25"
                            type="submit">
                            Sign In
                        </button>

                        <div class="space-y-4">
                            <div class="text-center">
                                <p class="font-medium text-zinc-400 mb-2">Don't have an account?</p>
                                <a class="block w-full bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-indigo-500/25"
                                    href="{{ route('register') }}">
                                    Create Account
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<livewire:footer />
</body>
</html>
