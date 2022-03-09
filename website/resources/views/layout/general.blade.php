@php $headDescription = "" ; @endphp

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- HTML Meta Tags -->
        <title>{{ config('app.name') }}</title>
        <meta name="description" content="{{ $headDescription }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Facebook Meta Tags -->
        <meta property="og:url" content="{{ route('index') }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ config('app.name') }}">
        <meta property="og:description" content="{{ $headDescription }}">
        <meta property="og:image" content="{{ asset('images/metatag-wallpaper.png') }}">

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="{{ config('app.url') }}">
        <meta property="twitter:url" content="{{ route('index') }}">
        <meta name="twitter:title" content="{{ config('app.name') }}">
        <meta name="twitter:description" content="{{ $headDescription }}">
        <meta name="twitter:image" content="{{ asset('images/metatag-wallpaper.png') }}">

        <!-- Style CSS files -->
        <link rel="stylesheet" href="{{ asset('css/global.min.css') }}">
        @stack('style')
    </head>
    <body class="position-relative font-muli">
        @include('flash::message')
        @yield('template_content')

        <script type="text/javascript" src="{{ asset('modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}" data-vital="1"></script>
        <script type="module" src="{{ asset('js/global.js') }}"></script>
        @stack('script')

        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "url": "{{ route('index') }}",
                "legalName": "{{ config('app.name') }}",
                "logo": "{{ asset('favicon.png') }}"
              }
        </script>
    </body>
</html>
