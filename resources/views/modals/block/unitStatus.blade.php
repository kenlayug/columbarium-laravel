<form id="modalUnit" class="modal modal-fixed-footer" style = "width: 600px; height: 270px; overflow-y: hidden;">
    <div class="modal-header" style = "height: 55px; width: 600px;">
        <h4 style="font-family: fontSketch; margin-top: -15px; font-size: 2.3vw; padding-left: 180px;">Unit Status</h4>
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