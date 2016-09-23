<div id="newDeceased" class="modal modal-fixed-footer" style="overflow-y: hidden; width: 80%; max-height: 120%;">
    <div class="modal-header" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; color: white; padding: 0px;">Deceased Details</h4></center>
        <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <form ng-submit='saveDeceased()' autocomplete="off">
        <div class="modal-content" style="overflow-y: auto; clear: bottom;">
            <div class="row">
                <div class="input-field col s4">
                    <input ng-model='newDeceased.strFirstName' id="dFirstName" type="text" class="validate tooltipped"
                        data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Leyo'Leyo-Leyo" 
                        required="" aria-required="true" minlength = "1" maxlength="50" length = "50"
                        ng-pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                    <label for="dFirstName" data-error = "INVALID" data-success = "">First Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input ng-model='newDeceased.strMiddleName' id="dMidName" type="text" class="validate tooltipped" 
                        data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Dela-Cruz"
                        minlength = "1" maxlength="50" length = "50" 
                        ng-pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                    <label for="dMidName" data-error = "INVALID" data-success = "">Middle Name</label>
                </div>
                <div class="input-field col s4">
                    <input ng-model='newDeceased.strLastName' id="dLastName" type="text" class="validate tooltipped" 
                        data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Del'Rosario" 
                        required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" 
                        ng-pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                    <label for="dLastName" data-error = "INVALID" data-success = "">Last Name<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s2">
                    <label for="dateOfDeath">Date of Death:<span style="color: red">*</span></label>
                </div>
                <div class="input-field col s3">
                    <input ng-model='newDeceased.dateDeath' id="dateOfDeath" type="date" required="" aria-required="true">
                </div> 
                <div class="input-field col s2">
                    <label for="dateOfBirth">Date of Birth:<span style="color: red">*</span></label>
                </div>
                <div class="input-field col s3">
                    <input ng-model="newDeceased.dateBirth" id="dateOfBirth" type="date" required="" aria-required="true">
                </div> 
                <div class="input-field col s1">
                    <label for="dayB">Age:</label>
                </div>
                <div class="input-field col s1">
                    <label id="dayB" ng-bind="newDeceased.dateDeath | amDifference : newDeceased.dateBirth : 'years'"></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s1">
                    <label>Gender:<span style="color: red;">*</span></label>
                </div>
                <div class="input-field col s5">
                    <p>
                        <input ng-model="newDeceased.intGender" name="group1" type="radio" id="gender1" value="1" checked="checked"/>
                        <label for="gender1">Male</label>
                        <input ng-model="newDeceased.intGender" name="group1" type="radio" id="gender2" value="2" />
                        <label for="gender2">Female</label>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <label>Customer relationship to the deceased:<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input ng-model="newDeceased.newRelationship" type="checkbox" id="addRelationship" name="colorCheckbox" value=1/>
                    <label for="addRelationship">Add New Relationship Type</label>
                </div>

                <div class="addRelationship input-field col s4" ng-show='newDeceased.newRelationship == true'>
                    <input ng-disabled='newDeceased.newRelationship != true' ng-model="newDeceased.strRelationshipName" 
                    id="rel" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" 
                    class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Brother"
                    ng-pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">   
                    <label for="rel" data-error = "INVALID" data-success = "">Add New Relationship Type:<span style = "color: red;">*</span></label>
                </div>

                <div class="input-field col s4 oldRel" ng-hide='newDeceased.newRelationship == true'>
                    <select ng-model="newDeceased.intRelationshipId"
                            material-select watch>
                        <option value="" disabled selected>Relationship:</option>
                        <option ng-repeat="relationship in relationshipList"
                                value="@{{ relationship.intRelationshipId }}">
                                @{{ relationship.strRelationshipName }}
                        </option>
                    </select>
                </div>
            </div><br>
            <i class = "left" style = "color: red; margin-bottom: 10px; margin-top: -30px;">*Required Fields</i>
            <br><br><br><br>
        </div>
        <div class="modal-footer">
            <button name="action" class="right btn wave-lights light-green" style="color: #000000; margin-right: 10px; margin-left: 10px;">Submit</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>