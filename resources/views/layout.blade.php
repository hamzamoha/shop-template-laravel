<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@section('title')Easy Shop - Affordable Online Shopping for Everyone @show</title>
    @include('includes.head')
</head>

<body>
    @include('includes.header')
    <main>
        @yield('main')
    </main>
    @include('includes.footer')
</body>
</html>