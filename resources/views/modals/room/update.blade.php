<!-- Modal Update Room -->
<div id="modalUpdateRoom" class="modalUpdateRoom modal" style = "width: 650px;">
    <div class = "modalRoomTypeHeader modal-header" style = "height: 55px;">
        <h4 class = "text" style = "color: white; font-family: fontSketch; font-size: 2.2vw; padding-left: 190px;">Update Room</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <form class="modal-content" id="formUpdateRoom" ng-submit="saveUpdate()">
        <div class = "row">
            <div class="input-field col s12" style = "margin-top: 0px;">
                <input ng-model="updateRoom.strRoomName" id="itemName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Room One" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
            </div>
            <i class = "modalCatReqField left col s6" style = "color: red; padding-top: 10px; padding-left: 10px;">*Required Fields</i>
        </div>

        <div class = "row">
            <div class = "col s6">
                <label style = "font-family: Arial; font-size: 1.2vw; color: black; padding-left: 10px;">Room Type</label>
                <p ng-repeat="roomType in roomTypeList" style = "margin-left: 10px;">
                    <input ng-click="checkUpdateSelectRoomType(roomType)" ng-model="roomType.selected" type="checkbox" id="@{{ 'update'+roomType.intRoomTypeId }}" value="@{{ roomType.intRoomTypeId }}" name="updateRoomTypes[]"/>
                    <label for="@{{ 'update'+roomType.intRoomTypeId }}">@{{ roomType.strRoomTypeName }}</label>
                </p>
            </div>
            <div ng-show="updateUnitTypeChecked > 0" ng-disabled="updateUnitTypeChecked <= 0" class="input-field required col s6">
                <input ng-model="updateRoom.intMaxBlock" id="maxBlockUpdate" type="number" class="validate" required = "" aria-required="true" minlength = "1" length = "20" min="1" max="20">
                <label for="maxBlockUpdate" data-error = "Invalid format." data-success = "">Maximum Number of Block/s: <span style = "color: red;">*</span></label>
            </div>
        </div>
        <div class="modal-footer" style = "margin-bottom: -30px;">
            <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black; margin-right: 0px;">Confirm</button>
            <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
        </div>
    </form>
</div>