<meta charset="utf-8" />

<meta name="application-name" content="{{ config('app.name') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>


<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

@fonts

@vite('resources/css/flux-app.css')
@fluxAppearance
