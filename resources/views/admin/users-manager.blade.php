<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950">
    <livewire:NavigationBar active_tab="manage" />
    <div class="flex flex-col gap-6 mx-auto w-[95%] lg:flex-row lg:gap-10 mb-10">
        <div class="w-full">
            <livewire:admin.users-manager.users-list />
        </div>
        <div class="w-full">
            <livewire:admin.users-manager.user-editor />
        </div>
    </div>
    <livewire:footer />
    <x-livewire-alert::scripts />
</body>

</html>
