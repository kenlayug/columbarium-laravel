<!-- Modal Update -->
<div id="modalUpdateItem" class="modalUpdateItem modal modal-fixed-footer" ng-controller="ctrl.updateAdditional">
    <div class = "itemHeaderUpdate modal-header">
        <h4 class = "updateAdditionalsH4">Update Additionals</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <form id="formUpdate" ng-submit="SaveAdditional()">
        <br>
        <div class = "col s12">
            <div class = "row">
                <div class = "itemNameUpdate">
                    <div class="input-field col s6">
                        <input ng-model="update.intAdditionalId" id="itemNameToBeUpdated" type="hidden"/>
                        <input ng-model="update.strAdditionalName" value=" " id="itemNameUpdate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Metallic Urn" name="item.strItemName" required = ""  minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                        <label id="lblUpdateName" class="active" for="itemNameUpdate" data-error = "Invalid format." data-success = "">New Name<span style = "color: red;">*</span></label>
                    </div>
                </div>
                <div class = "itemPriceUpdate">
                    <div class="input-field col s6">
                        <input ng-model="update.deciPrice" value="0" id="itemPriceUpdate" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places.<br>*Example: P 0.00" name="item.dblPrice" required = "" min="1" max = "999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                        <label id="lblUpdatePrice" class="active" for="itemPriceUpdate" data-error = "Invalid format." data-success = "">New Price<span style = "color: red;">*</span></label>
                    </div>
                </div>
            </div>
        </div>

        <div class = "itemDescUpdate">
            <div class="input-field col s12">
                <input ng-model="update.strAdditionalDesc" value=" " id="itemDescUpdate" type="text" class="validate" name="item.strItemDesc">
                <label id="lblUpdateDesc" class="active" for="itemDescUpdate" data-error = "Invalid format." data-success = "">New Description</label>
            </div>
        </div>

        <i class = "requiredField left">*Required Fields</i>
        <br>

        <div class="modal-footer">
            <button type="submit" name="action" class="btnModalUpdateConfirm btn light-green" style = "margin-left: 10px;">Confirm</button>
            <button class="btnModalUpdateCancel btn light-green modal-close">Cancel</button>
        </div>
    </form>
</div>