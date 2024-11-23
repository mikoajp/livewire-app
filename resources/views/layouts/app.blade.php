<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
<header class="bg-white shadow">
    <div class="container mx-auto p-4">
        <h1>{{ config('app.name', 'Laravel') }}</h1>
    </div>
</header>
<main class="container mx-auto p-6">
    {{ $slot }}
</main>
@livewireScripts
</body>
</html>
