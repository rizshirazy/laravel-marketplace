<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta
              name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>@yield('title')</title>

        {{-- Styles --}}
        @stack('prepend-styles')
        @include('includes.style')
        @stack('addon-styles')

    </head>

    <body>
        {{-- Navbar --}}
        @include('includes.navbar-auth')

        {{-- Main Content --}}
        @yield('content')

        {{-- Footer --}}
        @include('includes.footer')

        {{-- Script --}}
        @stack('prepend-scripts')
        @include('includes.script')
        @stack('addon-scripts')

    </body>

</html>