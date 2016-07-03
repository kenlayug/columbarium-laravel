<!-- Modal Update Room -->
<div id="modalUpdateRoom" class="modalUpdateRoom modal modal-fixed-footer" style = "overflow-y: hidden; height: 450px; width: 600px;">
    <div class = "modalRoomTypeHeader modal-header" style = "height: 55px;">
        <h4 class = "text" style = "color: white; font-family: fontSketch; font-size: 2.2vw; padding-left: 190px;">Update Room</h4>
    </div>
    <form class="modal-content" id="formUpdateRoom" ng-submit="saveUpdate()">
        <div class = "row">
            <div class="input-field col s12" style = "margin-top: 0px;">
                <input ng-model="additional.strAdditionalName" id="itemName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Room One" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
                <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
            </div>
            <i class = "modalCatReqField left col s6" style = "color: red; padding-top: 10px; padding-left: 10px;">*Required Fields</i>
        </div>

        <div class = "row">
            <div class = "col s6">
                <label style = "font-family: Arial; font-size: 1.2vw; color: black; padding-left: 10px;">Room Type</label>
                <p ng-repeat="roomType in roomTypeList" style = "margin-left: 10px;">
                    <input type="checkbox" id="@{{ 'update'+roomType.intRoomTypeId }}" value="@{{ roomType.intRoomTypeId }}" name="updateRoomTypes[]"/>
                    <label for="@{{ 'update'+roomType.intRoomTypeId }}">@{{ roomType.strRoomTypeName }}</label>
                </p>
            </div>
            <div ng-show="updateBlock" class="input-field required col s6">
                <input ng-model="updateRoom.intMaxBlock" id="maxBlockUpdate" type="number" class="validate" required = "" aria-required="true" minlength = "1" length = "20" min="1" max="20">
                <label for="maxBlockUpdate" data-error = "Invalid format." data-success = "">Maximum Number of Block/s: <span style = "color: red;">*</span></label>
            </div>
        </div>

    </form>
    <div class="modal-footer" style = "width: 580px;">
        <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black; margin-right: 20px;">Confirm</button>
        <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
    </div>
</div>