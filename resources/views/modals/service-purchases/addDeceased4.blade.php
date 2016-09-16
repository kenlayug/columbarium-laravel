<div id="addDeceased" class="modal modal-fixed-footer" style="width: 95%; max-height: 120%; overflow-y: hidden;">
    <form id="addDeceasedToUnit" ng-submit="addDeceasedToUnit(addDeceased)" autocomplete="off">
        <div class="modal-header" style="background-color: #00897b;">
            <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Add Deceased To Unit: @{{ unit.display }}</h4></center>
            <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
        </div>
        <div class="modal-content" style="overflow: auto; position: fixed; clear: bottom;">
            <div class="row" style="margin-top: -30px;">
                <div class="input-field col s2">
                    <label for="dateOfInter">Date of Interment:<span style="color: red">*</span></label>
                </div>
                <div class="input-field col s2">
                    <input ng-model="addDeceased.dateInterment"
                           id="dateOfInter" type="date" required="" aria-required="true">
                </div>
                <div class="input-field col s1">
                    <label for="iTime">Time<span style="color: red">*</span></label>
                </div>
                <div class="input-field col s2">
                    <input ng-model="addDeceased.timeInterment" ui-time-mask='short' id="iTime" type="text" required="" aria-required="true">
                </div>
                <div class="col s3 offset-s2">
                    <a class="waves-light btn light-green modal-trigger" style="color: #000000; margin-top: 20px;" data-target="requirements" href="#requirements">View Requirements</a>
                </div>
            </div>
            <div class="row">
                <div class="col s4" style="margin-top: 15px;">
                    <select ng-model="addDeceased.intStorageTypeId"
                            material-select watch>
                        <option value="" disabled selected>Storage Type*</option>
                        <option ng-repeat="storageType in storageTypeList"
                            value="@{{ storageType.intStorageTypeId }}">
                            @{{ storageType.strStorageTypeName }}
                        </option>
                    </select>
                </div>
                <div class="input-field col s6">
                    <input ng-model='addDeceased.strDeceasedName' id="dname" type="text" required="" aria-required="true" class="validate" ng-readonly="true">
                    <label for="dname">Deceased Name<span style = "color: red;">*</span></label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s2">
                    <label>Total Amount To Pay:</label>
                </div>
                <div class="input-field col s2">
                    <label><u>@{{ add.service.price.deciPrice | currency : "₱" }}</u></label>
                </div>     
            </div>
            <i class = "left" style = "color: red; margin-top: 10px;">*Required Fields</i>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Submit</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>