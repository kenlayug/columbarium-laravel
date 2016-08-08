<div id="deceasedForm" class="modal modal-fixed-footer" style="overflow-y: hidden; height: 300px;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Deceased Form</h4></cesnter>
    </div>
    <div class="modal-content" style="overflow-y: auto; clear: bottom;">
        <div class="row">
            <div class="input-field col s7">
                <input id="dname" type="text" required="" aria-required="true" class="validate" list="deceasedList">
                <label for="dname" data-error="No Existing Deceased Found!">Deceased Name<span style = "color: red;">*</span></label>
            </div>

            <datalist id="deceasedList">
                <option ng-repeat="customer in customerList" value="@{{ customer.strFullName }}">
            </datalist>

            <div class="col s5">
                <a data-target="newDeceased" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Deceased" href="#newDeceased" style="color: #000000; margin-top: 15px;"><i class="material-icons">add</i><i class="material-icons">assignment_ind</i></a>

                <a data-target="newDeceased" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Deceased Details" href="#newDeceased" style="color: #000000;width: 100px; margin-top: 15px;"><i class="material-icons">mode_edit</i><i class="material-icons">assignment_ind</i></a>
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