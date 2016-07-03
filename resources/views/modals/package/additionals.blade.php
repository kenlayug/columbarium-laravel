<!-- Modal Additionals -->
<div id="modalItem" class="modalAdditionals modal modal-fixed-footer" ng-controller="ctrl.prepareAdditional">
    <div class = "modal-header">
        <h4 class = "inclusionsH4">Additionals Inclusion/s</h4>
    </div>
    <div class = "col s12">
        <br>
        <h6 class = "modalAdditionalsH4">Additionals</h6>
        <div class = "modalCheckbox" id="itemCheckBox">
            <p ng-repeat="additional in additionals">
                <input ng-click="AddAdditional(additional.price.deciPrice, $index)" ng-model="checkAdditional[$index]" ng-true-value="true" ng-false-value="false" type="checkbox" name="additionals[]" id="@{{ additional.intAdditionalId }}" value="@{{ additional.intAdditionalId }}" />
                <label for="@{{ additional.intAdditionalId }}">@{{ additional.strAdditionalName }}( @{{ additional.price.deciPrice | currency }} )</label>
            </p>
        </div>
    </div>

    <br>
    <label class = "totalAdditionalPriceH4">Total Additionals Price:</label>
    <br>
    <label class = "totalPriceH4">@{{ totalAdditionalPrice | currency}}</label>

    <div class = "modalFooter">
        <div class="modal-footer">
            <button type = "submit" name = "action" class="btn light-green modal-close" style = "color: black; margin-bottom: 0px; margin-top: 6px; margin-left: 10px; ">Done</button>
        </div>
    </div>
</div>