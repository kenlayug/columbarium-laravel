@extends('baseLayout')

@section('navbar')

	<link rel = "stylesheet" href = "{!! asset('/css/sidenav-hamburger.css') !!}"/>


	<div class="navbar-fixed nav-leo">
	    <nav>
	        <div class="nav-wrapper">


	            <a href="#" class="brand-logo center" style = "font-size: 2.5vw; font-family: myFirstFont1;">Columbary and Crematory Management System</a>

	            <nav id="slide-out-l" class="side-nav left" style = "background-color: #212121;">

	                <!-- Account Information -->
	                <div style="width: 200px; height: 120px; position: relative;">
	                    <img id="image1" style="height: 120px; width: 240px; position: relative;" src="{!! asset('/img/pattern8.jpg') !!}" alt="..." />
	                    <div class = "row">
	                        <div class = "col s6">
	                            <img class = "responsive-img circle" id="image2" style="position: absolute; top: 23px; left: 15px; width: 70px; height: 70px;" src="{!! asset('/img/Ken Layug.jpg') !!}" alt="..." />
	                        </div>
	                        <div class = "col s6">
	                            <p style="position: absolute; top: 0px; font-size: 18px; padding-left: 100px; width: 220px; font-weight: bold;">Ken Layug</p>
	                            <p style="position: absolute; top: 0px; font-size: 18px; padding-top: 25px; padding-left: 90px; width: 220px; font-weight: bold;">Administrator</p>
	                        </div>
	                    </div>
	                </div>

	                <ul class="collapsible collapsible-accordion">
	                    <li>
	                        <div class="collapsible-header" style = "padding-left: 0px; font-family: myFirstFont2;"><i class="material-icons">settings</i>Maintenance</div>
	                        <div class="collapsible-body">
	                            <ul>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/interests') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Interest</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/buildings') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Building</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/floors') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Floor</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/blocks') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Block</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! urL('/units') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Unit</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/additionals') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Additional</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/requirements') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Requirement</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/services') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Services</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/packages') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Package</h6></a></li>
	                            </ul>
	                        </div>
	                    </li>
	                    <li>
	                        <div class="collapsible-header" style = "padding-left: 0px;font-family: myFirstFont2;"><i class="material-icons">work</i>Transaction</div>
	                        <div class="collapsible-body">
	                            <ul>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="<%=request.getContextPath()%>/customer"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Customer</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="<%=request.getContextPath()%>/buy-unit"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Manage Service</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="<%=request.getContextPath()%>/schedule"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Scheduling</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="<%=request.getContextPath()%>/manage-unit"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Manage Unit</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="<%=request.getContextPath()%>/collection"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Collection</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href="<%=request.getContextPath()%>/notification"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Notification</h6></a></li>
	                            </ul>
	                        </div>
	                    </li>
	                    <li>
	                        <div class="collapsible-header" style = "padding-left: 0px; font-family: myFirstFont2;"><i class="material-icons">settings</i>Queries</div>
	                        <div class="collapsible-body">
	                            <ul>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Item</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Service</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Requirement</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Package</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Building</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Floor</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Block</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Unit</h6></a></li>
	                            </ul>
	                        </div>
	                    </li>
	                    <li>
	                        <div class="collapsible-header" style = "padding-left: 0px; font-family: myFirstFont2;"><i class="material-icons">web</i>Reports</div>
	                        <div class="collapsible-body">
	                            <ul>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Service Reports</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Scheduling Reports</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Manage Reports</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Collection Reports</h6></a></li>
	                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Notification Reports</h6></a></li>
	                            </ul>
	                        </div>
	                    </li>
	                </ul>

	            </nav>
	            <a href="#" data-activates="slide-out-l" class="button-collapse show-on-large"><i class="material-icons">reorder</i></a>
	        </div>
	    </nav>
	</div>


	<script>
	    $(function() {

	        $("[data-activates=slide-out-l]").sideNav();
	        $("[data-activates=slide-out-r]").sideNav({
	            edge: 'right'
	        });
	    })


	    $(document).ready(function(){
	        $('.collapsible').collapsible({
	            accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
	        });
	    });
	</script>

	@yield('body')

@endsection