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
    <div class="flex">
        <div class="bg-slate-900 text-zinc-200 rounded-xl mx-auto min-w-md max-w-xl p-5 my-10">
            <h1 class="font-bold text-4xl">Login <i class="fa-solid fa-unlock-keyhole"></i></h1>
            <p class="mt-5 font-light text-sm">If you already have an account, please enter your email or username along
                with your password to log in and access your account.</p>
            <hr class="my-5 border-zinc-200">

            @error('email')
                <livewire:Alert title="INVALID E-MAIL OR USERNAME"
                    message="The e-mail or username you entered does not exist in our records." type="error" />
            @enderror

            @error('password')
                <livewire:Alert title="INVALID PASSWORD" message="The password you entered is incorrect." type="error" />
            @enderror

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-5">
                    <label class="block font-semibold" for="username_or_email">Username or e-mail:</label>
                    <input
                        class="w-full text-zinc-900 border rounded focus:border-zinc-900 focus:outline-none focus:ring-0"
                        id="username_or_email" name="username_or_email" type="text" maxlength="64"
                        placeholder="Username or e-mail" required>
                </div>
                <div class="mb-5">
                    <label class="block font-semibold" for="password">Password:</label>
                    <input
                        class="w-full text-zinc-900 border rounded focus:border-zinc-900 focus:outline-none focus:ring-0"
                        id="password" name="password" type="password" placeholder="Password" required>
                </div>
                <div class="mb-5 gap-5">
                    <button
                        class="block font-bold bg-sky-500 hover:bg-sky-700 text-zinc-100 transition-colros duration-500 mx-auto p-5 border border-zinc-200 rounded-lg w-80 mb-2"
                        type="submit">Login</button>
                    <a class="block text-center font-bold bg-indigo-500 hover:bg-indigo-700 transition-colors duration-500 text-zinc-100 mx-auto p-5 border border-zinc-200 rounded-lg w-80 mb-2"
                        href="{{ route('register') }}">Register</a>
                    <a class="block text-center font-bold bg-teal-500 hover:bg-teal-700 transition-colors duration-500 text-zinc-100 mx-auto p-5 border border-zinc-200 rounded-lg w-80"
                        href="{{ route('password.request') }}">Forgot password</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
