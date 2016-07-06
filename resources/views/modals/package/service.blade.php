<!-- Modal Service -->
<div id="modalService" class="modalService modal">
    <div class = "modal-header">
        <h4 class = "serviceInclusionH4">Service Inclusion/s</h4>
    </div>
    <div class="modal-content">
        <div class = "col s12">
            <h6 class = "servicesH4">Services</h6>
            <div class = "row">
                <div class = "col s12" id="serviceCheckBox">
                        <div class="input-field col s6" ng-repeat="service in serviceList">
                            <input ng-click="AddService(service.price.deciPrice, $index)" ng-model="checkService[$index]" ng-true-value="true" ng-false-value="false" type="checkbox" name="services[]" id="Service@{{ service.intServiceId }}" value="@{{ service.intServiceId }}" />
                            <label for="Service@{{ service.intServiceId }}">@{{ service.strServiceName }} ( @{{ service.price.deciPrice | currency }} )</label>
                        </div>
                        <div class="required input-field col s6" style = "margin-top: 0px;">
                            <input id="quantity" type="number" placeholder="Input Quantity" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole number only. Max input: 10<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "10">
                            <label id="quantity" for="quantity" data-error = "Invalid format." data-success = "">Quantity<span style = "color: red;">*</span></label>
                        </div>
                </div>

            </div>
            <br>
        </div>
    </div>
    <br><br><br><br><br><br>
    <label class = "totalServicePriceH4">Total Service Price:</label>
    <br>
    <label class = "servicePriceH4">@{{ totalServicePrice | currency }}</label>
    <br>

    <div class="modal-footer">
        <button name = "action" class="btnServiceDone btn light-green modal-close" style = "margin-top: 20px; margin-right: 20px;">Done</button>
    </div>
</div>