<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950">
    <livewire:NavigationBar active_tab="news" />
    <div class="flex justify-center mt-5 mx-40">
        <livewire:News.NewsArticlesList />
    </div>
</body>

</html>