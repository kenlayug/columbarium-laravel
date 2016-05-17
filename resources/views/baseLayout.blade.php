<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>@yield('title')</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>

	<script type="text/javascript" src="{!! asset('/angularjs/angular.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('/angularjs/angular-resource.js') !!}"></script>

	<link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
	<link rel="stylesheet" href="{!! asset('/css/style.min.css') !!}">

	<link rel="stylesheet" type="text/css" href="{!! asset('/css/sweetalert.css') !!}">
	<script type="text/javascript" src="{!! asset('/js/sweetalert.min.js') !!}"></script>
	
	<script type="text/javascript" src="{!! asset('/js/angular-materialize.js') !!}"></script>

    <link href="{!! asset('/css/calendar.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('/css/datepicker.css') !!}" rel="stylesheet" type="text/css"/>
				
	
</head>
<body>
	@yield('navbar')

    @section('body')
</body>
</html>