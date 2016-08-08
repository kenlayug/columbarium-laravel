<div id="newDeceased" class="modal modal-fixed-footer" style="overflow-y: hidden; width:75% !important; max-height: 100% !important;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Deceased Details</h4></cesnter>
    </div>
    <div class="modal-content" style="overflow-y: auto; clear: bottom;">
        <div class="row">
            <div class="input-field col s4">
                <input id="dFirstName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                <label for="dFirstName">Deceased First Name<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s4">
                <input id="dMidName" type="text" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                <label for="dMidName">Deceased Middle Name</label>
            </div>
            <div class="input-field col s4">
                <input id="dLastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                <label for="dLastName">Deceased Last Name<span style = "color: red;">*</span></label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s2">
                <label for="dateOfBirth">Date of Birth:<span style="color: red">*</span></label>
            </div>
            <div class="input-field col s2">
                <input id="dateOfBirth" type="date" required="" aria-required="true">
            </div> 
            <div class="input-field col s2">
                <label for="dateOfDeath">Date of Death:<span style="color: red">*</span></label>
            </div>
            <div class="input-field col s2">
                <input id="dateOfDeath" type="date" required="" aria-required="true">
            </div> 
        </div>
        <i class = "left" style = "color: red; margin-bottom: 10px;">*Required Field</i>
        <br><br>
    </div>
    <div class="modal-footer">
        <button name="action" class="right btn wave-lights light-green" style="color: #000000; margin-right: 10px; margin-left: 10px;">Submit</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>