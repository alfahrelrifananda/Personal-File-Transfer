<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Local Share</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' fill='%23000000'/%3E%3Ctext x='50' y='70' font-size='60' text-anchor='middle' fill='%23efebe0' font-family='Arial, sans-serif' font-weight='bold'%3ELS%3C/text%3E%3C/svg%3E">

    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <main class="py-4">
        @yield('content')
    </main>

    <!-- External JavaScript -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
