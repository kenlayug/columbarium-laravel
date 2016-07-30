<!-- Modal Update -->
<div id="modalUpdateInterest" class="modalUpdate modal modal-fixed-footer" ng-controller="ctrl.updateInterest">
    <div class = "modalUpdateHeader">
        <h4 class = "center modalUpdateH4">Update Interest</h4>
    </div>
    <form id="formUpdate" ng-submit="SaveInterest()">
        <br>
        <div class = "numberOfYearsUpdate row">
            <div>
                <div class="input-field col s6">
                    <input ng-model="update.intInterestId" type="hidden">
                    <input ng-model="update.intNoOfYear" id="updateNumberOfYears" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole numbers only. Max input: 10<br>*Example: 5" name="item.strNumberOfYears" required = "" aria-required="true" min = "1" max="10">
                    <label id="updateNoOfYear" for="updateNumberOfYears" data-error = "Invalid format." data-success = "">Number of Years<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div style = "padding-left: 10px;">
                <div class="input-field col s6">
                    <input ng-model="update.deciInterestRate"
                           ui-percentage-mask
                           id="updateInterestRate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: 25" name="item.dblPrice" required = "" min="0" step=".1" max="100" aria-required = "true">
                    <label id="updateRate" for="updateInterestRate" data-error = "Invalid Format." data-success = "">Rate<span style = "color: red;">*</span></label>
                </div>
            </div>
        </div>

        <!-- Checkbox if at need -->
        <div class = "checkbox" id = "checkbox" action="#">
            <p>
                <input ng-model="update.intAtNeed" name="atNeed" type="checkbox" id="updateAtNeed" value="1"/>
                <label for="updateAtNeed">At Need?</label>
            </p>
        </div>
        <br>
        <i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>

        <div class="modal-footer">
            <button type="submit" name="action" class="btn light-green" style = "color: black; margin-right: 10px; margin-left: 10px; ">Confirm</button>
            <a class="btn light-green modal-close" style = "color: black; margin-top: 6px">Cancel</a>
        </div>
    </form>
</div>