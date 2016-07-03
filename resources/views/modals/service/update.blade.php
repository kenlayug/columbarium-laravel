<!-- Modal Update -->
<div id="modalUpdateService" class="modalUpdate modal modal-fixed-footer" ng-controller="ctrl.updateRequirement">
    <div class = "modal-header">
        <h4 class = "updateService">Update Service</h4>
    </div>
    <form class="modal-content" id="formUpdate" ng-submit="SaveRequirement()">

        <div class="updateFormStyle row">
            <div class="input-field col s6">
                <input ng-model="update.intServiceId" id="serviceToBeUpdate" type="hidden">
                <input ng-model="update.strServiceName" id="serviceNameUpdate" value=" " type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
                <label id="updateName" for="serviceNameUpdate" data-error = "Check format field." data-success = "">New Name<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s6">
                <input ng-model="update.deciPrice" id="servicePriceUpdate" value="0" type="number" class="validate" min="1" max="999999" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                <label id="updatePrice" for="servicePriceUpdate" data-error = "Check format field." data-success = "">New Price<span style = "color: red;">*</span></label>
            </div>
        </div>


        <div class="serviceDesc row">
            <div class="input-field col s12">
                <input ng-model="update.strServiceDesc" id="serviceDescUpdate" value=" " type="text" class="validate">
                <label id="updateDesc" for="serviceDescUpdate" data-error = "Check format field." data-success = "">New Description</label>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; margin-left: 10px;">
            <div class="input-field col s6">
                <select class="browser-default" id="selectserviceType">
                    <option class = "serviceType" value="" disabled selected>Type</option>
                    <option class = "serviceType">Unit Servicing</option>
                    <option class = "serviceType">Others</option>
                </select>
            </div>
            <button name = "action" class="modal-trigger btn light-green left" style = "color: black; font-size: 12px; width: 220px; margin-top: 20px; margin-left: 40px;" href = "#modalRequirement">Choose Requirement</button>
        </div>
        <i class = "createReqField left" style = "padding-left: 20px;">*Required Fields</i>
        <div class="btnUpdateConfirm modal-footer" style = "height: 55px; width: 570px;">
            <button type = "submit" name = "action" class="btn light-green" style = "margin-right: 20px; color: black; margin-left: 10px; ">Confirm</button>
            <button name = "action" class="modal-close btn light-green" style = "color: black;">Cancel</button>
        </div>
    </form>
</div>