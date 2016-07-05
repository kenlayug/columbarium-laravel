<!-- Modal Update -->
<div id="modalUpdateRequirement" class="modalUpdate modal modal-fixed-footer" ng-controller="ctrl.updateRequirement">
    <div class = "modal-header">
        <h4 class = "modalUpdateH4">Update Requirement</h4>
    </div>
    <form class="modal-content" id="formUpdate" ng-submit="SaveRequirement()">

        <div class="row">
            <div class="input-field col s6">
                <input ng-model="update.intRequirementId" id="requirementToBeUpdated" type="hidden"/>
                <input ng-model="update.strRequirementName" placeholder = "Requirement Name" id="requirementNameUpdate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Valid ID" required = "" aria-required = "true" minlength = "1" maxlength="20" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
                <label class = "active" for="requirementNameUpdate">New Name<span style = "color: red;">*</span></label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input ng-model="update.strRequirementDesc" placeholder = "Requirement Description" id="requirementDescUpdate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric and special characters.<br>*Example: Requirement that is required in cremation.">
                <label for="requirementNameUpdate">New Description</label>
            </div>
        </div>

        <i class = "modalUpdateReqField left">*Required Fields</i>
        <div class="modal-footer" style = "width: 550px; height: 55px;">
            <button type = "submit" name = "action" class="btn light-green bottom" style = "color: black; margin-left: 10px; margin-right: 20px;">Confirm</button>
            <a name = "action" class="btn light-green modal-close bottom" style = "color: black;">Cancel</a>
        </div>

    </form>
</div>