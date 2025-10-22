<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" /> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .status-badge.pendiente {
            @apply bg-yellow-100 text-yellow-800;
        }
        .status-badge.pagado {
            @apply bg-green-100 text-green-800;
        }
    </style>
    <title>@yield('title')</title>
</head>

<body class="">
    <div id="toast-container" class="fixed hidden top-0 right-0 z-50 bg-black/30 text-center w-full items-center"></div>
    @yield('content')
</body>

</html>
