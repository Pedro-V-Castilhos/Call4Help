<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $title ?? '' }}</title>
</head>

<body class="min-h-screen flex flex-col items-center">
    <x-layout.header />
    {{ $slot }}
    <x-layout.footer />
</body>

</html>
