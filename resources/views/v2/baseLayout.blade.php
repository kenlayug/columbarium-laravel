<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@yield('title')</title>

    @include('stylesheets')

    <script type="text/javascript" src="{!! asset('/js/jquery-2.1.4.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/angularjs/angular.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/jquery.dataTables.min.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('/angular-datatable/angular-datatables.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/angular-datatable/angular-datatables.directive.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/angular-datatable/angular-datatables.factory.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/angular-datatable/angular-datatables.instances.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/angular-datatable/angular-datatables.options.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/angular-datatable/angular-datatables.renderer.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/angular-datatable/angular-datatables.util.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('/js/materialize.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/angularjs/angular-resource.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/sweetalert.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/angular-materialize.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('/formatter/angular-input-masks-standalone.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/angular-materializecss-datepicker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/template.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/moment.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/angular-moment.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('/angular-socket-io-master/mock/socket-io.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/angular-socket-io-master/socket.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('/main.js') !!}"></script>

{{--    <script type="text/javascript" src="{!! asset('/js/dashboard.js') !!}"></script>--}}
    {{--<link rel = "stylesheet" href = "{!! asset('/css/dashboard.css') !!}"/>--}}

</head>
<body ng-app="app">

    {{--<div class="wrapper @{{ loading }}">--}}
        {{--<div id="loader-wrapper">--}}
            {{--<div id="loader"></div>--}}
            {{--<div class="loader-section section-left"></div>--}}
            {{--<div class="loader-section section-right"></div>--}}
        {{--</div>--}}
    @include('v2.navbar2')

    @yield('body')

    {{--</div>--}}

</body>
</html>