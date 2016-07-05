<!-- Modal Additionals -->
<div id="modalItem" class="modalAdditionals modal" ng-controller="ctrl.prepareAdditional">
    <div class = "modal-header">
        <h4 class = "inclusionsH4">Additionals Inclusion/s</h4>
    </div>
    <div class = "col s12">
        <br>
        <h6 class = "modalAdditionalsH4">Additionals</h6>
        <div class = "row">
            <div class = "modalCheckbox col s6" id="itemCheckBox">
                <p ng-repeat="additional in additionals">
                    <input ng-click="AddAdditional(additional.price.deciPrice, $index)" ng-model="checkAdditional[$index]" ng-true-value="true" ng-false-value="false" type="checkbox" name="additionals[]" id="@{{ additional.intAdditionalId }}" value="@{{ additional.intAdditionalId }}" />
                    <label for="@{{ additional.intAdditionalId }}">@{{ additional.strAdditionalName }}( @{{ additional.price.deciPrice | currency }} )</label>
                </p>
            </div>
            <div class="required input-field col s6" style = "margin-top: 0px;">
                <input id="quantity" type="number" placeholder="Input Quantity" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole number only. Max input: 10<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "10">
                <label id="quantity" for="quantity" data-error = "Invalid format." data-success = "">Quantity<span style = "color: red;">*</span></label>
            </div>
            <br><br>
        </div>
    </div>

        <label class = "totalAdditionalPriceH4">Total Additionals Price:</label>
        <br>
        <label class = "totalPriceH4">@{{ totalAdditionalPrice | currency}}</label>


    <div class = "modalFooter">
        <div class="modal-footer">
            <button type = "submit" name = "action" class="btn light-green modal-close" style = "color: black; margin-top: 35px; margin-right: 10px; ">Done</button>
        </div>
    </div>
</div>