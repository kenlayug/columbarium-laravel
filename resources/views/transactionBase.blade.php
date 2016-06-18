<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@yield('title')</title>

    @include('scripts')
    @include('stylesheets')
    <script src="{!! asset('/main.js') !!}"></script>

</head>
<body ng-app="app">
@yield('navbar')

@section('body')
</body>
</html>