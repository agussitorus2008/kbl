<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') . ': ' }}@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="{{ config('app.name') }}" />
    <meta name="keyword" content="{{ $keyword ?? config('app.name') }}" />
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
    @include('layouts.frontend.head')
</head>

<body>
    <div id="preloader">
        <div data-loader="dual-ring"></div>
    </div>

    <div id="main-wrapper">
        @include('layouts.frontend.header')
        @yield('content')
        @include('layouts.frontend.footer')
    </div>
    <a id="back-to-top" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)">
        <i class="fa fa-chevron-up"></i>
    </a>
    @include('layouts.frontend.modal')
    @include('layouts.frontend.scripts')
</body>

</html>
