<div id="requirements" class="modal modal-fixed-footer" style="height: 300px; overflow-y: hidden">
    <div class="modal-header1" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Service Requirement/s</h4></center>
        <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div class="modal-content" style="overflow-y: auto">

        <div class="row">
            <div class="col s6">
                <div ng-repeat="requirement in requirementList">
                    <input ng-model="requirement.check" value="1" type="checkbox" id="requirement@{{ requirement.intRequirementId }}"/>
                    <label for="deathCert" style="font-family: Arial" ng-bind="requirement.strRequirementName"></label><br>
                </div>
                <div ng-if="requirementList.length == 0">
                    <h5 class="center">No requirement.</h5>
                </div>
            </div>
        </div>
        <br><br>
    </div>

    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Close</button>
    </div>
</div>