<div id="modalStorageType" class="modal modal-fixed-footer" style="max-height: 700px;; width: 670px; overflow: hidden">
    <div class="modal-header" style = "width: 755px; height: 55px;">
        <h4 style="padding-left: 230px;font-size: 2.2vw; font-family: fontSketch; color: white;">Storage Type</h4>
    </div>
    <form ng-submit="updateUnitStorageType()">
        <div class="modal-content">
            <div class = "col s12">
                <a ng-click="openCreateStorageType()" name = "action" class="right tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "New Type" style = "margin-top: -20px;"><i class="material-icons" style = "color: black">add</i></a>
                <div class = "row">
                    <!-- Data Grid -->
                    <div class = "center col s10" style = "margin-left: 35px; width: 550px;">
                        <div style = "margin-top: -10px; margin-left: -10px;">
                            <div id="admin2">
                                <div class="z-depth-2 card material-table">
                                    <table id="datatable2" datatable="ng">
                                        <thead style = "max-height: 35px;">
                                        <tr style = "max-height: 35px;">
                                            <th></th>
                                            <th>Type</th>
                                            <th style = "width: 10px; font-size: 12px; padding-left: 10px;">Quantity</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="storageType in storageTypeList"
                                            style = "max-height: 30px;">
                                            <td>
                                                <form action="#" style = "margin-top: 10px;">
                                                    <p>
                                                        <input ng-model="storageType.selected"
                                                               ng-change="required(storageType)"
                                                               type="checkbox"
                                                               class="filled-in"
                                                               id="storageType@{{ storageType.intStorageTypeId }}"/>
                                                        <label for="storageType@{{ storageType.intStorageTypeId }}"></label>
                                                    </p>
                                                </form>
                                            </td>
                                            <td style = "margin-top: 0px;">@{{ storageType.strStorageTypeName }}</td>
                                            <td>
                                                <div class="@{{ storageType.required }} input-field col s6" style = "margin-top: 0px; padding-left: -20px;">
                                                    <input ng-model="storageType.intQuantity"
                                                           ui-number-mask="0"
                                                           id="quantity"
                                                           type="text"
                                                           placeholder="Input Quantity"
                                                           class="validate tooltipped"
                                                           data-position = "bottom"
                                                           data-delay = "30"
                                                           data-tooltip = "Accepts whole number only. Max input: 10<br>*Example: 5"
                                                           aria-required = "true"
                                                           min = "1"
                                                           max = "10">
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

<div id="modalNewStorageType" class="modal modal-fixed-footer" style="width: 500px; height: 300px; overflow: hidden">
    <div class="modal-header" style = "width: 755px; height: 55px;">
        <h4 style="padding-left: 85px; font-size: 2.2vw; font-family: fontSketch; color: white;">New Storage Type</h4>
    </div>
    <form ng-submit="createStorageType()">
        <div class="modal-content">
            <div class="input-field col s6">
                <input ng-model="newStorage.strStorageTypeName" id="storageName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Bone Box" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                <label for="storageName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
            </div>
            <i class = "createReqField left" style = "color: red;">Note: All fields with * are required.</i>

        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>