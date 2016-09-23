<html>
    <head>
        <link rel = "stylesheet" href = "{!! asset('/css/loginUtilities.css') !!}"/>
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
        <script type="text/javascript" src="{!! asset('/angular-datatable/plugins/select/angular-datatables.select.js') !!}"></script>

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

        <script type='text/javascript' src="{!! asset('/js/scrollglue.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('/main.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('/resource.js') !!}"></script>

        <link rel = "stylesheet" href = "{!! asset('/css/loading.css') !!}"/>
        
        <script type="text/javascript" src="{!! asset('/dashboard/ctrl.notification.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('/login/controller.js') !!}"></script>

    </head>

    <body style = "background-color: darkorange;" ng-app="app">
        <form class = "loginForm aside aside col s6 z-depth-2" ng-submit="login(loginInfo)" autocomplete="off" ng-controller="ctrl.login">
            <img class = "responsive-img" id="image2" style="margin-top: -60px; margin-left: 35px; width: 290px; height: 290px;" src="{!! asset('/img/C&C-Logo-Final.png') !!}" alt="..." />

            <h4 style = "font-family: roboto3; font-size: 1.6vw; margin-top: -50px; padding-left: 20px;">Columbarium and Crematorium &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Management System</h4>

            <div class = "row col s12" style = "margin-right: 20px;margin-top: 0px; padding-left: 10px;">
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input ng-model="loginInfo.strEmail" id="email" type="email" class="validate" required = "" aria-required="true">
                    <label for="email" data-error="Invalid." data-success="">Email<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input ng-model="loginInfo.strPassword" id="password" type="password" class="validate" required = "" aria-required="true" minlength = "1" maxlength="20" length = "20" ng-pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="password" data-error = "Invalid Format." data-success = "">Password<span style = "color: red;">*</span></label>
                </div>
            </div>

            <div style = "margin-top: -10px; margin-left: 30px;">
                <p>
                    <input type="checkbox" class="filled-in" id="filled-in-box"/>
                    <label for="filled-in-box">Remember Password</label>
                </p>
            </div>
            <br>
            <button class="waves-effect waves-light teal btn center" style = "width: 145px; color: white; margin-left: 105px;">Login</button>


        </form>
    </body>

</html>