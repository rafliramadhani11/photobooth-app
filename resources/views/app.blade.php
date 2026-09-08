<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @fonts

    @viteReactRefresh

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-inertia::head />

</head>

<body>
    <x-inertia::app />
</body>

</html>
