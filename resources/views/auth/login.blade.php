<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-zinc-950">
    <div class="flex">
        <div class="bg-amber-200 text-zinc-900 rounded mx-auto min-w-md max-w-xl p-5 my-10">
            <h1 class="font-bold text-4xl">Login</h1>
            <p class="mt-5 font-light text-sm">If you already have an account, please enter your email or username along with your password to log in and access your account.</p>
            <hr class="my-5 border-zinc-900">
            <form>
                <div class="mb-5">
                    <label class="block font-semibold" for="username_or_email">Username or e-mail:</label>
                    <input class="w-full border rounded focus:border-zinc-900 focus:outline-none focus:ring-0" 
                        id="username_or_email" name="username_or_email" type="text" maxlength="64" placeholder="Username or e-mail" required>
                </div>
                <div class="mb-5">
                    <label class="block font-semibold" for="password">Password:</label>
                    <input class="w-full border rounded focus:border-zinc-900 focus:outline-none focus:ring-0" 
                        id="password" name="password" type="password" placeholder="Password" required>
                </div>
           </form>
        </div>
    </div>
</body>

</html>
