<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} - @yield('title')</title>

    <meta name='description' itemprop='description' content="@yield('description')" />
    <meta name='keywords' content="@yield('keywords')" />
    <meta name="robots" content="index, follow" />
    <meta property="og:description"content="@yield('description')" />
    <meta property="og:title"content="{{ env('APP_NAME') }} - @yield('title')" />
    <meta property="og:url"content="{{ url()->current() }}" />
    <meta property="og:type"content="article" />

    <meta property="og:locale"content="{{ app()->getLocale() }}" />
{{--    @foreach(localization()->getSupportedLocales() as $key => $locale)--}}
{{--        <meta property="og:locale:alternate"content="{{ $key }}" />--}}
{{--    @endforeach--}}
    <meta property="og:site_name"content="{{ env('APP_NAME') }}" />
    <meta property="og:image:url"content="{{ Cloudder::secureShow('/cit/hero', config('settings.cloudinary_optimised_jpg')) }}" />
    <meta property="og:image:size"content="300" />

    <meta name="twitter:card"content="@yield('description')" />
    <meta name="twitter:title"content="{{ env('APP_NAME') }} - @yield('title')" />
{{--    <meta name="twitter:site"content="@MedicusMedical" />--}}

{{--    @foreach(localization()->getSupportedLocales() as $key => $locale)--}}
{{--        <link rel="alternate" hreflang="{{ $key }}" href="{{ localization()->getLocalizedURL($key) }}">--}}
{{--    @endforeach--}}

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

{{--    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>--}}

    {{--    @include('partials.crisp')--}}

    {{-- @include('partials.cookieconsent') --}}

</head>
<body>

<div id="app" class="max-w-screen-xl mx-auto">
    @yield('body')
</div>


<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
