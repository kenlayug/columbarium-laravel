<!-- Modal New Room Type -->
<form ng-submit="createRoomType()" id="modalRoomType" class="modalRoomType modal modal-fixed-footer" style = "height: 300px; width: 500px;" autocomplete="off">
    <div class = "modalRoomTypeHeader modal-header" style = "height: 55px;">
        <h4 class = "text" style = "color: white; font-family: fontSketch; font-size: 2vw; padding-left: 120px;">New Room Type</h4>
    </div>
    <div class="modal-content" id="formCreateRoomType">
        <div class = "roomType">
            <div class="input-field col s12">
                <input ng-model="newRoomType.strRoomTypeName" id="itemCategoryDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Cashier" name="item.strItemCategory" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                <label for="itemCategoryDesc" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
            </div>
        </div>

        <i class = "modalCatReqField left col s12" style = "color: red; padding-top: 10px;">*Required Fields</i>

    </div>
    <div class="modal-footer">
        <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black; margin-right: 20px;">Confirm</button>
        <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
    </div>
</form>