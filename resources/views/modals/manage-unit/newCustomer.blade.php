<div id="newCustomer" class="modal modal-fixed-footer" style="overflow-y: hidden">

    <div class="modal-header1" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; font-family: myFirstFont2; color: white; padding: 20px;">Add New Customer</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <form ng-submit="saveCustomer()" autocomplete="off">
        <div class="modal-content" style="overflow-y: auto;">
            <div class="row">
                <div class="input-field col s4">
                    <input ng-model="customer.strFirstName" id="FirstName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="FirstName">First Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input ng-model="customer.strMiddleName" id="MidName" type="text" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="MidName">Middle Name</label>
                </div>
                <div class="input-field col s4">
                    <input ng-model="customer.strLastName" id="LastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="LastName">Last Name<span style = "color: red;">*</span></label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s8">
                    <input ng-model="customer.strAddress" id="address" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="100" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,100}">
                    <label for="address">Address<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input ng-model="customer.strContactNo" id="cNum" type="text" required="" aria-required="true" class="validate">
                    <label for="cNum" data-error="Format: XXXX-XXX-XXXX">Contact Number<span style = "color: red;">*</span></label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s2">
                    <label for="dayB">Date of Birth:<span style="color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input ng-model="customer.dateBirthday" id="dayB" type="date">
                </div>
                <div class="input-field col s1">
                    <label for="dayB">Age:</label>
                </div>
                <div class="input-field col s1">
                    <label id="dayB">34</label>
                </div>
                <div class="input-field col s1">
                    <label>Gender:<span style="color: red;">*</span></label>
                </div>
                <div class="input-field col s3" style="margin-top: -5px;">
                    <p>
                        <input ng-model="customer.intGender" name="group1" type="radio" id="gender1" value="1" checked="checked"/>
                        <label for="gender1">Male</label>
                        <input name="group1" type="radio" id="gender2" value="2" />
                        <label for="gender2">Female</label>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s2">
                    <label>Civil Status:<span style="color: red;">*</span></label>
                </div>
                <div class="input-field col s8">
                    <p>
                        <input ng-model="customer.intCivilStatus" name="group11" type="radio" id="test1" value="1" checked="checked"/>
                        <label for="test1">Single</label>
                        <input ng-model="customer.intCivilStatus" name="group11" type="radio" value="2" id="test2" />
                        <label for="test2">Married</label>
                        <input ng-model="customer.intCivilStatus" name="group11" type="radio" value="3" id="test3" />
                        <label for="test3">Widow/Widower</label>
                    </p>
                </div>
            </div>
            <div class="row">
                <i class = "left" style = "color: red; margin-top: 10px;">*Required Fields</i>
            </div>

            <br><br><br><br>
        </div>

        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Submit</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>

    </form>
</div>