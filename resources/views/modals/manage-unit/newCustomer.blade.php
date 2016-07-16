<div id="newCustomer" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden">

    <div class="modal-header1" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; font-family: myFirstFont2; color: white; padding: 20px;">Add New Customer</h4></center>
    </div>

    <div class="modal-content" style="overflow-y: auto;">
        <div class="row">
            <div class="input-field col s4">
                <input id="FirstName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                <label for="FirstName">First Name<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s4">
                <input id="MidName" type="text" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                <label for="MidName">Middle Name</label>
            </div>
            <div class="input-field col s4">
                <input id="LastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                <label for="LastName">Last Name<span style = "color: red;">*</span></label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s8">
                <input id="address" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="100" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,100}">
                <label for="address">Address<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s4">
                <input id="cNum" type="text" required="" aria-required="true" class="validate" pattern="\d{4}[\-, ., ]\d{3}[\-, ., ]\d{4}">
                <label for="cNum" data-error="Format: XXXX-XXX-XXXX">Contact Number<span style = "color: red;">*</span></label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s2">
                <label for="dayB">Date of Birth:</label>
            </div>
            <div class="input-field col s4">
                <input id="dayB" type="date" class="datepicker">
            </div>
            <div class="input-field col s2">
                <label>Gender:</label>
            </div>
            <div class="input-field col s4">
                <p>
                    <input name="group1" type="radio" id="gender1" checked="checked"/>
                    <label for="gender1">Male</label>
                    <input name="group1" type="radio" id="gender2" />
                    <label for="gender2">Female</label>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s3">
                <label>Civil Status:</label>
            </div>
            <div class="input-field col s8">
                <p>
                    <input name="group11" type="radio" id="test1" checked="checked"/>
                    <label for="test1">Single</label>
                    <input name="group11" type="radio" id="test2" />
                    <label for="test2">Married</label>
                    <input name="group11" type="radio" id="test3" />
                    <label for="test3">Widow/Widower</label>
                </p>
            </div>
            <i class = "left" style = "color: red; margin-top: 10px;">*Required Fields</i>
        </div>

        <br><br>
    </div>

    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>
<script type="text/javascript">
    $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });
</script>>