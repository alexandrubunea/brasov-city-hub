<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950">
    <livewire:NavigationBar active_tab="home" />
    <div class="flex flex-col py-10 px-5 gap-10 lg:flex-row lg:px-10">
        <livewire:admin.users-manager.users-list />
    </div>
    <x-livewire-alert::scripts />
</body>

</html>
