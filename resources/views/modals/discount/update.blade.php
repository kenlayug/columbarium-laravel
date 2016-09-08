<!-- Modal Update -->
<div id="modalUpdateItem" class="modalUpdateItem modal modal-fixed-footer" ng-controller="ctrl.updateAdditional">
    <div class = "itemHeaderUpdate modal-header">
        <h4 class = "center updateAdditionalsH4">Update Discount</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <form id="formUpdate" ng-submit="SaveAdditional()">
        <br>
        <div class = "row" style = "padding-left: 10px; padding-right: 10px;">
            <div class="input-field col s6">
                <input ng-model="additional.strAdditionalName" id="dicountName" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Senior's Discount" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                <label id="createName" for="discountName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s6">
                <input ng-model="interest.deciInterestRate"
                       ui-percentage-mask
                       id="interestRate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: 25" name="item.dblPrice" required = "" max="100" aria-required = "true">
                <label id="createRate" for="interestRate" data-error = "Invalid Format." data-success = "">Rate<span style = "color: red;">*</span></label>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; padding-left: 10px;">
            <div class="input-field col s5 m5 l6">
                <select id="selectItemCategory" ng-model="additional.intAdditionalCategoryId" material-select watch>
                    <option class = "additionalCategory2" value="" disabled selected>Discount Type</option>
                    <option ng-repeat="additionalCategory in additionalCategories" value="@{{ additionalCategory.intAdditionalCategoryId }}">@{{ additionalCategory.strAdditionalCategoryName }}</option>
                </select>
            </div>
        </div>

        <i class = "requiredField left">*Required Fields</i>
        <br><br>

        <div class="modal-footer">
            <button type="submit" name="action" class="btnModalUpdateConfirm btn light-green" style = "margin-right: 10px; margin-left: 10px;">Confirm</button>
            <button class="btnModalUpdateCancel btn light-green modal-close">Cancel</button>
        </div>
    </form>
</div>