<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@yield('title')</title>

    @include('scripts')
    @include('stylesheets')

</head>
<body ng-app="app">
    @include('v2.navbar')

    @yield('body')

</body>
</html>