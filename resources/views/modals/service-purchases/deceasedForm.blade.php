<div id="deceasedForm" class="modal modal-fixed-footer" style="overflow-y: hidden; height: 300px;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Deceased Form</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <form ng-submit='addDeceasedToService()' autocomplete="off">
        <div class="modal-content" style="overflow-y: auto; clear: bottom;">
            <div class="row">
                <div class="input-field col s7">
                    <input ng-model='serviceDeceased.strDeceasedName' id="dname" type="text" required="" aria-required="true" class="validate" list="deceasedList" ng-trim=false>
                    <label for="dname" data-error="No Existing Deceased Found!">Deceased Name<span style = "color: red;">*</span></label>
                </div>

                <datalist id="deceasedList">
                    <option ng-repeat="deceased in deceasedList" value="@{{ deceased.strFullName }}"/>
                </datalist>

                <div class="col s5">
                    <a data-target="newDeceased" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Deceased" href="#newDeceased" style="color: #000000; margin-top: 15px;"><i class="material-icons">add</i><i class="material-icons">assignment_ind</i></a>
                </div>
            </div>
            <i class = "left" style = "color: red; margin-bottom: 10px;">*Required Field</i>
            <br><br>
        </div>
        <div class="modal-footer">
            <button name="action" class="right btn wave-lights light-green" style="color: #000000; margin-right: 10px; margin-left: 10px;">Submit</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>