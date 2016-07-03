<!-- Modal Service -->
<div id="modalService" class="modalService modal modal-fixed-footer" ng-controller="ctrl.prepareService">
    <div class = "modal-header">
        <h4 class = "serviceInclusionH4">Service Inclusion/s</h4>
    </div>
    <div class="modal-content">
        <div class = "col s12">
            <div class="row">
                <div >
                    <div>
                        <h6 class = "servicesH4">Services</h6>
                        <div id="serviceCheckBox">
                            <p ng-repeat="service in services">
                                <input ng-click="AddService(service.price.deciPrice, $index)" ng-model="checkService[$index]" ng-true-value="true" ng-false-value="false" type="checkbox" name="services[]" id="Service@{{ service.intServiceId }}" value="@{{ service.intServiceId }}" />
                                <label for="Service@{{ service.intServiceId }}">@{{ service.strServiceName }} ( @{{ service.price.deciPrice | currency }} )</label>
                            </p>
                        </div>
                        <br><br>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
    <label class = "totalServicePriceH4">Total Service Price:</label>
    <br>
    <label class = "servicePriceH4">@{{ totalServicePrice | currency }}</label>
    <br>

    <div class="modal-footer">
        <button name = "action" class="btnServiceDone btn light-green modal-close">Done</button>
    </div>
</div>