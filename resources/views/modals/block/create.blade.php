<style>
    .headerDivider {
        border-left:1px solid #bdbdbd;
        border-right:1px solid #bdbdbd;
        height:280px;
        position:absolute;
        right:330px;
        top: -5px;
    }
</style>

<div id="modalCreateBlock" class="modal modal-fixed-footer" style = "overflow-y: hidden; height: 380px; width: 650px;">
    <div class = "modal-header box" style = "height: 55px;">
        <h4 class = "center" style = "margin-top: -5px; color: white; font-family: roboto3;">Create Block</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <form ng-submit="createBlock()" autocomplete="off">
        <div class = "modal-content" id="createBlockForm" style = "overflow-y: auto;">
            <div class="row" style = "padding-top: 0px;">
                <div class = "col s6" style = "margin-top: -10px;">
                    <h5 style = "color: dimgrey; padding-left: 10px; font-family: roboto3;">Block Size:</h5>
                    <div class="input-field col s12" style = "padding-left: 10px;">
                        <input ng-model="newBlock.intLevelNo" id="blockLevel" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only. Max input: 10<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "10">
                        <label for="blockLevel" data-error = "1-10 only" data-success = "">Level/s:<span style = "color: red;">*</span></label>
                    </div>
                    <div class="input-field col s12">
                        <input ng-model="newBlock.intColumnNo" id="blockColumn" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only. Max input: 20<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "20">
                        <label for="blockColumn" data-error = "1-20 only" data-success = "">Unit/s:<span style = "color: red">*</span></label>
                    </div>
                    <i class = "left" style = "padding-top: 20px; padding-left: 10px; color: red;">*Required Fields</i>
                </div>
                <div class="headerDivider"></div>
                <div class="input-field col s6" id="divUnitType" style = "margin-top: -10px; margin-bottom: 20px;">
                    <div ng-repeat="roomType in roomTypeList">
                        <input ng-model="newBlock.intUnitType" type="radio" name="unitType" value="@{{ roomType.intRoomTypeId }}" id="@{{ roomType.intRoomTypeId }}">
                        <label for="@{{ roomType.intRoomTypeId }}">@{{ roomType.strRoomTypeName }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="btn light-green" style = "margin-right: 10px; color: black; margin-left: 10px;">Confirm</button>
            <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
        </div>
    </form>
</div>