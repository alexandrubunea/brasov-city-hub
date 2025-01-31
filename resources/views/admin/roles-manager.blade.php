<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 bg-gradient-to-br from-slate-950 to-slate-900 min-h-screen">
    <livewire:NavigationBar active_tab="manage" />
    <div class="flex flex-col px-5 gap-10 lg:flex-row lg:px-10">
        <livewire:admin.roles-manager.role-creator />
        <livewire:admin.roles-manager.roles-list />
    </div>
    <livewire:footer />
    <x-livewire-alert::scripts />
</body>

</html>
