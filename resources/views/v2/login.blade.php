<html>
    <head>
        @include('stylesheets')
        @include('scripts')

    </head>

    <body>
        <div class = "aside aside col s6 z-depth-2">

            <div class = "row col s12" style = "margin-top: -20px; padding-left: 10px;">
                <div class="input-field col s6">
                    <i class="material-icons prefix">email</i>
                    <input id="email" type="email" class="validate">
                    <label for="email" data-error="wrong" data-success="right">Email</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="password" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="password" data-error = "Invalid format." data-success = "">Password<span style = "color: red;">*</span></label>
                </div>
            </div>

        </div>
    </body>

</html>