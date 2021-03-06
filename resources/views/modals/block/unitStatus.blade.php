<form id="modalUnit" class="modal modal-fixed-footer" style = "width: 600px; height: 270px; overflow-y: hidden;">
    <div class="modal-header" style = "background-color: #00897b; height: 55px; width: 600px;">
        <h4 class = "center" style="font-family: roboto3; color: white; padding-top: 10px;">Unit Status</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <div class = "modal-content">
        <div class="row">
            <div class="input-field col s3">
                <input ng-model="unit.intUnitId" id="unitToToggle" type="hidden">
                <label style="color: black; font-size: 20px">Unit Id: <span style="color: black">@{{ unit.intUnitId }}</span></label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s3">
                <label style="color: black; font-size: 20px">Status: <span style="color: @{{ unit.colorStatus }}" id="unitStatus">@{{ unit.strUnitStatus }}</span></label>
            </div>
        </div>
    </div>
    <div class="modal-footer" style = "height: 55px; width: 600px;">
            <button ng-hide="unit.intUnitStatus == 0 " ng-click="deactivateUnit(unit.intUnitId)" id="btnDeactivate" class="waves-effect waves-light btn red" style = "width: 150px;  margin-right: 430px;" type="submit">Deactivate</button>
            <button ng-show="unit.intUnitStatus == 0" ng-click="activateUnit(unit.intUnitId)" id="btnActivate" class="waves-effect waves-light btn red right" style = "width: 150px; margin-right: 10px;" type="submit">Activate</button>
    </div>
</form>