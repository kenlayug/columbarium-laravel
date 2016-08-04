<div id="newCustomer" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden">
    <div class="modal-header1" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Add New Customer</h4></center>
    </div>
    <form ng-submit="saveCustomer()">
        <div class="modal-content" style="overflow-y: auto;">
            <div class="row">
                <div class="input-field col s4">
                    <input ng-model="customer.strFirstName"
                           id="FirstName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="FirstName">First Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input ng-model="customer.strMiddleName"
                           id="MidName" type="text" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="MidName">Middle Name</label>
                </div>
                <div class="input-field col s4">
                    <input ng-model="customer.strLastName"
                           id="LastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="LastName">Last Name<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8">
                    <input ng-model="customer.strAddress"
                           id="address" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="100" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,100}">
                    <label for="address">Address<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input ng-model="customer.strContactNo"
                           id="cNum" type="text" required="" aria-required="true" class="validate" pattern="\d{4}[\-, ., ]\d{3}[\-, ., ]\d{4}">
                    <label for="cNum" data-error="Format: XXXX-XXX-XXXX">Contact Number<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s2">
                    <label for="dayB">Date of Birth:</label>
                </div>
                <div class="input-field col s4">
                    <input ng-model="customer.dateBirthday" id="dayB" type="date" class="">
                </div>
                <div class="input-field col s2">
                    <label>Gender:</label>
                </div>
                <div class="input-field col s4">
                    <p>
                        <input ng-model="customer.intGender"
                               value="1"
                               name="group1" type="radio" id="gender1" checked="checked"/>
                        <label for="gender1">Male</label>
                        <input ng-model="customer.intGender"
                               value="2"
                               name="group1" type="radio" id="gender2" />
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
                        <input ng-model="customer.intCivilStatus"
                               value="1"
                               name="group11" type="radio" id="test1" checked="checked"/>
                        <label for="test1">Single</label>
                        <input ng-model="customer.intCivilStatus"
                               value="2"
                               name="group11" type="radio" id="test2" />
                        <label for="test2">Married</label>
                        <input ng-model="customer.intCivilStatus"
                               value="3"
                               name="group11" type="radio" id="test3" />
                        <label for="test3">Widow/Widower</label>
                    </p>
                </div>
                <i class = "left" style = "color: red; margin-top: 10px;">*Required Fields</i>
            </div>

            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
                <a ng-click="customer = null"
                   name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </div>
    </form>
</div>