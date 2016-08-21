<div id="newDeceased" class="modal modal-fixed-footer" style="overflow-y: hidden; width: 95%; max-height: 120%;">
    <div class="modal-header" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont2; color: white; padding: 20px;">Deceased Details</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <form ng-submit='saveDeceased()' autocomplete="off">
        <div class="modal-content" style="overflow-y: auto; clear: bottom;">
            <div class="row">
                <div class="input-field col s4">
                    <input ng-model='newDeceased.strFirstName' id="dFirstName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="dFirstName">Deceased First Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input ng-model='newDeceased.strMiddleName' id="dMidName" type="text" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="dMidName">Deceased Middle Name</label>
                </div>
                <div class="input-field col s4">
                    <input ng-model='newDeceased.strLastName' id="dLastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="dLastName">Deceased Last Name<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s2">
                    <label for="dateOfDeath">Date of Death:<span style="color: red">*</span></label>
                </div>
                <div class="input-field col s2">
                    <input ng-model='newDeceased.dateDeath' id="dateOfDeath" type="date" required="" aria-required="true">
                </div> 
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <label>Customer relationship to the deceased:</label>
                </div>
                <div class="input-field col s4">
                    <input ng-model="newDeceased.newRelationship" type="checkbox" id="addRelationship" name="colorCheckbox" value=1/>
                    <label for="addRelationship">Add New Relationship Type</label>
                </div>

                <div class="addRelationship input-field col s4" ng-show='newDeceased.newRelationship == true'>
                    <input ng-disabled='newDeceased.newRelationship != true' ng-model="newDeceased.strRelationshipName" id="daLastName" type="text" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="daLastName">Add New Relationship Type:<span style = "color: red;">*</span></label>
                </div>

                <div class="input-field col s4 oldRel" ng-hide='newDeceased.newRelationship == true'>
                    <select ng-model="newDeceased.intRelationshipId"
                            material-select watch>
                        <option value="" disabled selected>Relationship to the deceased:<span style = "color: red;">*</span></option>
                        <option ng-repeat="relationship in relationshipList"
                                value="@{{ relationship.intRelationshipId }}">
                                @{{ relationship.strRelationshipName }}
                        </option>
                    </select>
                </div>
            </div><br>
            <i class = "left" style = "color: red; margin-bottom: 10px;">*Required Fields</i>
            <br><br><br><br><br><br>
        </div>
        <div class="modal-footer">
            <button name="action" class="right btn wave-lights light-green" style="color: #000000; margin-right: 10px; margin-left: 10px;">Submit</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>