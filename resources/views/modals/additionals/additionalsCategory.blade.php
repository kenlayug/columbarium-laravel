<!-- Modal Additionals Category -->
<form id="modalItemCategory" class="modalItemCategory modal modal-fixed-footer" ng-controller="ctrl.newAdditionalCategory" ng-submit="SaveAdditionalCategory()">
    <div class = "modalCategoryHeader modal-header">
        <h4 class = "text">Additionals Category</h4>
    </div>
    <div class="modal-content" id="formCreateItemCategory">
        <div class = "additionalsNewCategory">
            <div class="input-field col s12">
                <input ng-model="additionalCategory.strAdditionalCategoryName" id="itemCategoryDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Urn" name="item.strItemCategory" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                <label for="itemCategoryDesc" data-error = "Invalid format." data-success = "">Category<span style = "color: red;">*</span></label>
                <i class = "modalCatReqField left">*Required Fields</i>
            </div>
            <br>
        </div>

    </div>
    <div class="modal-footer">
        <button name = "action" class="btnConfirmCategory btn light-green" style = "margin-right: 20px;">Confirm</button>
        <a name = "action" class="btnCancel btn light-green modal-close" style = "margin-right: 10px;">Cancel</a>
    </div>
</form>