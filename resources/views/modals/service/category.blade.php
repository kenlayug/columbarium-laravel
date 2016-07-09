<!-- Modal Service Category -->
<div id="modalServiceCategory" class="modalServiceCategory modal modal-fixed-footer">
    <div class = "modalCategoryHeader modal-header">
        <h4 class = "text">Service Category</h4>
    </div>
    <form ng-submit="saveServiceCategory()">
        <div class="modal-content" id="formCreateItemCategory">
            <div class = "additionalsNewCategory">
                <div class="input-field col s12">
                    <input ng-model="newServiceCategory.strServiceCategoryName" id="serviceCategoryDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Cremation" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="serviceCategoryDesc" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
                    <i class = "modalCatReqField left">*Required Fields</i>
                </div>
                <br>
            </div>

        </div>
        <div class="modal-footer">
            <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black; margin-right: 20px;">Confirm</button>
            <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
        </div>
    </form>
</div>