<!-- Modal Update -->
<form id="modalUpdatePackage" class="modalUpdate modal modal-fixed-footer" ng-controller="ctrl.updatePackage" ng-submit="SavePackage()">
    <div class = "modal-header">
        <h4 class = "updatePackageH4">Update Package</h4>
    </div>
    <div class="modal-content">

        <div class="row">
            <div class="input-field col s6">
                <input ng-model="update.intPackageId" id="packageToBeUpdated" type="hidden">
                <input ng-model="update.strPackageName" value=" " placeholder="Package Name" id="packageNameUpdate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Senior's Cremation Package" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
                <label for="packageNameUpdate" data-error = "Invalid format." data-success = "">New Name<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s6">
                <input ng-model="update.deciPrice" value=" " placeholder="Package Price" id="packagePriceUpdate" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: P 0.00" required = "" min = "1" max = "999999" aria-required="true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                <label for="packagePriceUpdate" data-error = "Invalid format." data-success = "">New Price<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s12">
                <input ng-model="update.strPackageDesc" value=" " placeholder="Package Description" id="packageDescUpdate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: This package includes: cremation service with urn.">
                <label for="packageDescUpdate">New Description</label>
            </div>

            <button type = "submit" name = "action" class="btnUpdateAdditional modal-trigger btn light-green left" href = "#modalItem" style = "font-size: .9vw; width: 230px;">Choose Additional/s</button>
            <button type = "submit" name = "action" class="btnUpdateService modal-trigger btn light-green left" href = "#modalService" style = "font-size: .9vw; width: 230px; margin-left: 60px;">Choose Service/s</button>
        </div>
        <i class = "modalUpdateReqField left">*Required Fields</i>
    </div>
    <div class="modal-footer">
        <button type = "submit" name = "action" class="btnUpdateConfirm btn light-green" style = "margin-left: 10px; margin-right: 20px;">Confirm</button>
        <a name = "action" class="btnUpdateCancel btn light-green modal-close">Cancel</a>
    </div>
</form>