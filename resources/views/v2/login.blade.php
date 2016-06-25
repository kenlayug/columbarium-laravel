<html>
    <head>
        <link rel = "stylesheet" href = "{!! asset('/css/loginUtilities.css') !!}"/>
        @include('stylesheets')
        @include('scripts')

    </head>

    <body style = "background-color: darkorange;">
        <form class = "loginForm aside aside col s6 z-depth-2">
            <img class = "responsive-img" id="image2" style="margin-top: -60px; margin-left: 35px; width: 290px; height: 290px;" src="{!! asset('/img/C&C-Logo-Final.png') !!}" alt="..." />

            <h4 style = "font-family: font; font-size: 1.5vw; margin-top: -40px; padding-left: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Columbarium and Crematorium Management &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System</h4>

            <div class = "row col s12" style = "margin-right: 20px;margin-top: -20px; padding-left: 10px;">
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input id="email" type="email" class="validate" required = "" aria-required="true">
                    <label for="email" data-error="Invalid." data-success="">Email<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="password" type="password" class="validate" required = "" aria-required="true" minlength = "1" maxlength="20" length = "20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="password" data-error = "Invalid Format." data-success = "">Password<span style = "color: red;">*</span></label>
                </div>
            </div>

            <div action = "#" style = "margin-top: -10px; margin-left: 30px;">
                <p>
                    <input type="checkbox" class="filled-in" id="filled-in-box"/>
                    <label for="filled-in-box">Remember Password</label>
                </p>
            </div>
            <br>

            <button class="waves-effect waves-light teal btn" style = "width: 145px; color: white; margin-left: 20px;">Sign-up</button>
            <button class="waves-effect waves-light teal btn" style = "width: 145px; color: white; margin-left: 10px; margin-right: 20px;">Login</button>


        </form>
    </body>

</html>