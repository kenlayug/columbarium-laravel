<!-- Modal Update -->
<div id="modalUpdateItem" class="modalUpdateItem modal modal-fixed-footer">
    <div class = "itemHeaderUpdate modal-header">
        <h4 class = "center updateAdditionalsH4">Update Discount</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <form id="formUpdate" ng-submit="fUpdateDiscount()" autocomplete="off">
        <br>
        <div class = "row" style = "padding-left: 10px; padding-right: 10px;">
            <div class="input-field col s6">
                <input ng-model="updateDiscount.strDiscountName" id="dicountName" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Senior's Discount" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                <label id="createName" for="discountName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s6">
                <div class="input-field col s5 m5 l6">
                    <select id="selectItemCategory" ng-model="updateDiscount.intDiscountType" material-select watch>
                        <option class = "additionalCategory2" value="" disabled selected>Discount Type</option>
                        <option value="1">Percentage</option>
                        <option value="2">Amount</option>
                    </select>
                </div>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; padding-left: 10px;">
            <input ng-model="updateDiscount.deciDiscountRate"
                   ng-disabled="updateDiscount.intDiscountType != 1"
                   ng-show="updateDiscount.intDiscountType == 1"
                   ui-percentage-mask
                   id="interestRate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: 25" name="item.dblPrice" required = "" max="100" aria-required = "true">
            <input ng-model="updateDiscount.deciDiscountRate"
                   ui-number-mask
                   ng-disabled="updateDiscount.intDiscountType != 2"
                   ng-show="updateDiscount.intDiscountType == 2"
                   id="interestRate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: 25" name="item.dblPrice" required = "" aria-required = "true">
            <label id="createRate" for="interestRate" data-error = "Invalid Format." data-success = "">Rate<span style = "color: red;">*</span></label>
        </div>

        <i class = "requiredField left">*Required Fields</i>
        <br><br>

        <div class="modal-footer">
            <button type="submit" name="action" class="btnModalUpdateConfirm btn light-green" style = "margin-right: 10px; margin-left: 10px;">Confirm</button>
            <a class="btnModalUpdateCancel btn light-green modal-close">Cancel</a>
        </div>
    </form>
</div>