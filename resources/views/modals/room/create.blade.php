<!-- Modal Create Room -->
<div id="modalCreateRoom" class="modalCreateRoom modal modal-fixed-footer" style = " overflow-y: hidden; height: 400px; width: 700px;">
    <div class = "modalRoomTypeHeader modal-header" style = "height: 55px;">
        <h4 class = "text" style = "color: white; font-family: fontSketch; font-size: 2.3vw; padding-left: 230px;">Create Room</h4>
    </div>
    <form class="modal-content" id="formCreateRoom" ng-submit="saveNewRoom()">

        <div class = "row" style = "margin-top: -20px;">
            <div class="input-field col s6">
                <input ng-model="additional.strAdditionalName" id="itemName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Room One" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
                <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
            </div>
            <a name = "action" class="btnRoomType modal-trigger btn light-green right" style = "margin-top: 25px; color: black; margin-right: 10px;" href = "#modalRoomType">New Room Type</a>
        </div>
        <i class = "modalCatReqField left" style = "color: red; padding-left: 10px;">*Required Fields</i>
        <br><br>

        <div>
            <label style = "font-family: Arial; font-size: 1.2vw; color: black; padding-left: 10px;">Room Type</label>
            <p ng-hide="roomTypeList.length != 0" style = "margin-left: 10px;">
            <h6 style = "padding-left: 10px;">Create Room Type first.</h6>
            </p>
            <p ng-repeat="roomType in roomTypeList" style = "margin-left: 10px;">
                <input ng-click="showBlocks(roomType.strRoomTypeName)" type="checkbox" id="@{{ roomType.intRoomTypeId }}" value="@{{ roomType.intRoomTypeId }}" name="roomTypes[]"/>
                <label for="@{{ roomType.intRoomTypeId }}">@{{ roomType.strRoomTypeName }}</label>
            </p>
        </div>

        <div ng-show="showBlock" ng-disabled="!showBlock" class="input-field required col s6">
            <input ng-model="newRoom.intMaxBlock" id="maxBlock" type="number" class="validate" required = "" aria-required="true" minlength = "1" length = "20" min="1" max="20">
            <label for="maxBlock" data-error = "Invalid format." data-success = "">Maximum Number of Block/s: <span style = "color: red;">*</span></label>
        </div>
    </form>
    <div class="modal-footer" >
        <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black; margin-right: 20px;">Confirm</button>
        <button name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</button>
    </div>
</div>