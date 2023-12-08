<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') Safe Pass Course Dublin</title>
    <meta name='description' itemprop='description' content="@yield('description'){{'SOLAS Safe Pass in Dublin! Courses available daily. Trusted safepass dublin provider with years of experience.'}}" />
    <meta name='keywords' content="safepass dublin, safe pass dublin" />
    <meta name="robots" content="index, follow" />
    <meta property="og:description" content="@yield('description'){{'SOLAS Safe Pass in Dublin! Courses available daily. Trusted safepass dublin provider with years of experience.'}}"/>
    <meta property="og:title" content="@yield('title'){{'Safe Pass Course Dublin'}}"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:type" content="article"/>

    <meta property="og:locale" content="{{ app()->getLocale() }}"/>
    {{--    @foreach(localization()->getSupportedLocales() as $key => $locale)--}}
    {{--        <meta property="og:locale:alternate"content="{{ $key }}" />--}}
    {{--    @endforeach--}}
    <meta property="og:site_name" content="{{ env('APP_NAME') }}"/>
    <meta property="og:image:url"
          content=" "/>
    <meta property="og:image:size" content="300"/>

    <meta name="twitter:title" content="@yield('title'){{'Safe Pass Course Dublin'}}"/>
    <meta name="twitter:card" content="@yield('description'){{'SOLAS Safe Pass in Dublin! Courses available daily. Trusted safepass dublin provider with years of experience.'}}"/>
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

</head>
<body>

@yield('body')

<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
