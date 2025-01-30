<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Discover</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 bg-gradient-to-br from-slate-950 to-slate-900 min-h-screen">
    <livewire:NavigationBar active_tab="discover"/>
    <livewire:Discover.Places/> 
    <livewire:footer />
</body>

</html>
