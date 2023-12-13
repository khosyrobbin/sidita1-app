<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIDITA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('template') }}/assets/js/init-alpine.js"></script>
    {{-- SweetAlert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop nav sidebar -->
        @include('layouts.navigator')

        <!-- Mobile sidebar -->
        @include('layouts.navigator-mobilr')

        <div class="flex flex-col flex-1 w-full">
            {{-- Header --}}
            @include('layouts.header')

            @yield('content')
        </div>
    </div>
</body>

</html>
