<div id="configureUnitService" class="modal modal-fixed-footer" style="overflow: hidden">
    <div class="modal-header" style="background-color: #00897b;">
        <center>
            <label style="font-size: large;">Configure Unit Service</label>
        </center>
    </div>
    <form ng-submit="saveUnitService()">
        <div class="modal-content"><br>
            <div class="row">
                <div class="col s8 offset-s2">
                    <div class="row">
                        <div class="col s5">
                            <label style="font-size: 15px;">Add Deceased:</label>
                        </div>
                        <div class="col s7">
                            <select ng-model="add.intServiceIdFK"
                                    material-select>
                                <option value="" disabled selected>Select Service</option>
                                <option ng-repeat="service in serviceList"
                                        value="@{{ service.intServiceId }}">@{{ service.strServiceName }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <label style="font-size: 15px;">Transfer Deceased:</label>
                        </div>
                        <div class="col s7">
                            <select ng-model="transfer.intServiceIdFK"
                                    material-select>
                                <option value="" disabled selected>Select Service</option>
                                <option ng-repeat="service in serviceList"
                                        value="@{{ service.intServiceId }}">@{{ service.strServiceName }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <label style="font-size: 15px;">Pull Out Deceased:</label>
                        </div>
                        <div class="col s7">
                            <select ng-model="pull.intServiceIdFK"
                                    material-select>
                                <option value="" disabled selected>Select Service</option>
                                <option ng-repeat="service in serviceList"
                                        value="@{{ service.intServiceId }}">@{{ service.strServiceName }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>