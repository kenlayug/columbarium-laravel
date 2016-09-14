<!-- Modal Additionals Category -->
<form id="modalItemCategory" class="modalItemCategory modal modal-fixed-footer" ng-controller="ctrl.newAdditionalCategory" ng-submit="SaveAdditionalCategory()" autocomplete="off">
    <div class = "modalCategoryHeader modal-header">
        <h4 class = "text center flow-text" style = "padding-top: 10px">Additionals Category</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <div class="modal-content" id="formCreateItemCategory">
        <div class = "additionalsNewCategory">
            <div class="input-field col s12">
                <input ng-model="additionalCategory.strAdditionalCategoryName" id="itemCategoryDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Urn" name="item.strItemCategory" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                <label for="itemCategoryDesc" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
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