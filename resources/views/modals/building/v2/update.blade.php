<!-- Modal Update -->
<form id="modalUpdateBuilding" class="modalUpdate modal modal-fixed-footer" ng-submit="saveUpdate()">
    <div class = "modalUpdateHeader modal-header">
        <h4 class = "modalUpdateH4">Update Building</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <div class="modal-content" id="formUpdate">

        <div class="row updateForm" ng-submit="SaveBuilding()">
            <div class="input-field col s6">
                <input ng-model="updateBuilding.strBuildingName" placeholder = "Building Name" id="buildingNameUpdate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Building One"  required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                <label id="updateName" for="buildingNameUpdate" data-error = "Invalid format." data-success = "">New Name<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field required col s6">
                <input ng-model="updateBuilding.strBuildingCode" id="buildingCodeUpdate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: B001" required = "" aria-required="true" minlength = "1" maxlength="5" length = "5">
                <label id="updateCode" for="buildingCodeUpdate" data-error = "Invalid format." data-success = "">New Code<span style = "color: red;">*</span></label>
            </div>

            <div class="input-field col s12">
                <input ng-model="updateBuilding.strBuildingLocation" placeholder = "Building Name" id="buildingAddressUpdate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Summoner's Rift" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[-.',a-zA-Z0-9]+(\s+[-.',a-zA-Z0-9]+)*$">
                <label id="updateLocation" for="buildingAddressUpdate" data-error = "Invalid Format." data-success = "">New Location<span style = "color: red;">*</span></label>
            </div>
            <i class = "updateFormReq left">*Required Fields</i>
        </div>
    </div>
    <div class="modal-footer">
        <button name = "action" type = "submit" class="btnConfirm btn light-green" style = "margin-right: 20px;">Confirm</button>
        <a class="btnCancel btn light-green modal-close" style = "margin-right: 10px;">Cancel</a>
    </div>
</form>