<div id="modal1" class="modal modal-fixed-footer" style="width: 75% !important ; overflow-y: hidden;">
    <div id="deceasedForm">

        <div class="modal-header">
            <center>
                <label style="font-size: large; font-family: myFirstFont">MANAGE UNIT: @{{ unit.display }}</label>
            </center>
        </div>

        <div class="modal-content" style="overflow: auto; position: fixed; clear: bottom;">
            <div class="row">
                <div class="col s6">
                    <div class="row" style="margin-top: -20px;">
                        <div class="input-field col s4">
                            <label style="font-size: large"><b>Owner Name:</b></label>
                        </div>
                        <div class="input-field col s8">
                            <label style="font-size: large">  <u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12" style="margin-top: 50px;">
                <ul class="tabs">
                    <li class="tab col s2"><a class="orange-text" href="#addDeceased">|| Add Deceased</a></li>
                    <li class="tab col s2"><a class="orange-text" href="#transferDeceased">|| Transfer Deceased</a></li>
                    <li class="tab col s2"><a class="orange-text" href="#pullOutDeceased">|| Pull Out Deceased</a></li>
                    <li class="tab col s3"><a class="orange-text" href="#transferOwnership">|| Transfer Ownership ||</a></li>
                </ul>
            </div>

            <div style="background: #fafafa">
                <!-- Add Deceased Form -->
                <form ng-submit="processAddDeceased()">
                    <div id="addDeceased" class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row">
                                    <div class="col s9">
                                        <label style="font-size: 30px; font-family: myFirstFont2; margin-left: 230px; color: #00897b">Add Deceased</label>
                                    </div>
                                    <div class="input-field col s3 offset-s9">
                                        <select ng-model="addDeceased.intStorageTypeId"
                                                material-select>
                                            <option value="" disabled selected>Storage Type*</option>
                                            <option ng-repeat="storageType in storageTypeList"
                                                    value="@{{ storageType.intStorageTypeId }}">
                                                @{{ storageType.strStorageTypeName }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4">
                                        <input ng-model="addDeceased.strFirstName"
                                               id="dFirstName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                        <label for="dFirstName">Deceased First Name<span style = "color: red;">*</span></label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input ng-model="addDeceased.strMiddleName"
                                               id="dMidName" type="text" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                        <label for="dMidName">Deceased Middle Name</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input ng-model="addDeceased.strLastName"
                                               id="dLastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                        <label for="dLastName">Deceased Last Name<span style = "color: red;">*</span></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s2">
                                        <label for="dateOfDeath">Date of Death:<span style="color: red">*</span></label>
                                    </div>
                                    <div class="input-field col s2">
                                        <input ng-model="addDeceased.dateDeath"
                                               materialize-date-picker
                                               id="dateOfDeath" type="text" class="datepicker" required="" aria-required="true">
                                    </div>
                                    <div class="input-field col s4">
                                        <input ng-model="addDeceased.newRelationship" type="checkbox" id="addRelationship" name="colorCheckbox" value="addRel"/>
                                        <label for="addRelationship">Add New Relationship Type</label>
                                    </div>

                                    <div class="addRelationship input-field col s4" style="display:none;">
                                        <input ng-model="addDeceased.strRelationshipName" id="daLastName" type="text" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                        <label for="daLastName">Add New Relationship Type:<span style = "color: red;">*</span></label>
                                    </div>

                                    <div class="input-field col s4 oldRel">
                                        <select ng-model="addDeceased.intRelationshipId"
                                                material-select>
                                            <option value="" disabled selected>Relationship to the deceased:<span style = "color: red;">*</span></option>
                                            <option ng-repeat="relationship in relationshipList"
                                                    value="@{{ relationship.intRelationshipId }}">
                                                @{{ relationship.strRelationshipName }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s4">
                                        <select ng-model="addDeceased.intPaymentType"
                                                required
                                                material-select>
                                            <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                            <option value="1">Cash</option>
                                            <option value="2">Cheque</option>
                                        </select>
                                    </div>
                                    <div class="input-field col s2">
                                        <label>Total Amount To Pay:</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <label><u>@{{ add.service.price.deciPrice | currency : "₱" }}</u></label>
                                    </div>
                                    <div class="input-field col s2">
                                        <label>Amount Paid:<span style="color: red">*</span></label>
                                    </div>
                                    <div class="input-field col s2">
                                        <input ng-model="addDeceased.deciAmountPaid"
                                               ui-number-mask="2"
                                               id="paid" type="text">
                                    </div>
                                    <div class="input-field col s4">
                                        <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                                    </div>
                                </div>
                                <i class = "left" style = "color: red; margin-top: 10px;">*Required Fields</i>
                            </div>
                        </div>
                        <div class="row container">

                            <div class="input-field col s4 offset-s8">
                                <button name="action" class="btn wave-lights light-green">Submit</button>
                                <a class="btn waves-lige light-green">Cancel</a>
                            </div>

                        </div>
                    </div>
                </form>

                <!-- Transfer Deceased Form -->
                <form ng-submit="processTransferDeceased()">
                    <div id="transferDeceased" class="col s12">
                        <!-- Deceased List -->
                        <div class="row">
                            <div class="input-field col s6">
                                <h6 style="color: #000000;">Deceased Name/s:</h6>
                                <div class="row">
                                    <div ng-repeat="deceased in deceasedList">
                                        <div class="col s6">
                                            <p ng-if="$index%2 == 0">
                                                <input ng-model="deceased.selected" type="checkbox" id="deceased@{{ deceased.intDeceasedId }}"/>
                                                <label for="deceased@{{ deceased.intDeceasedId }}" style="font-family: Arial">@{{ deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName }}</label>
                                            </p>
                                        </div>
                                        <div class="col s6">
                                            <p ng-if="$index%2 == 1">
                                                <input ng-model="deceased.selected" type="checkbox" id="deceased@{{ deceased.intDeceasedId }}"/>
                                                <label for="deceased@{{ deceased.intDeceasedId }}" style="font-family: Arial">@{{ deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName }}</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--
                            <div class="col s6">
                                <label style="font-size: 30px; font-family: myFirstFont2; color: #00897b">Transfer Deceased</label>
                            </div>
                            -->
                        </div>

                        <div class="row">
                            <!-- Collapsible -->
                            <div class="col s4">
                                <div class="row">
                                    <ul class="collapsible" data-collapsible="accordion" watch>
                                        <li>
                                            <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                                <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">@{{ unitTypeList[unitIndex].strRoomTypeName }}</label>
                                            </div>
                                            <div ng-repeat="block in unitTypeList[unitIndex].blockList" class="collapsible-body @{{ block.transferColor }}" style = "max-height: 50px;">
                                                <p style = "padding-top: 15px;">@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}
                                                    <button ng-click="openTransferUnits(block, $index)" id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Block -->
                            <div class="col s8" style="margin-top: -70px;">
                                <div ng-hide="transferShowUnit" id="transferDeceasedStart">
                                    <div class="center vaults-content">
                                        <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont">Select a Block</h2>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                            <tbody>
                                                <tr>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                    <td><a class="waves-light"></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Selected Block -->
                                <div ng-show="transferShowUnit" id="transferDeceasedShow">
                                    <div class="center vaults-content">
                                        <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont">@{{ transferBlockName }}</h2>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                            <tbody>
                                                <tr ng-repeat="unitLevel in transferUnitList">
                                                    <td class="@{{ unit.color }}" ng-repeat="unit in unitLevel">
                                                        <a ng-click="selectTransfer(unit)" class="waves-effect waves-light">@{{ unit.display }}</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <center>Payment Details:</center>
                        </div>
                        <div class="row" style="margin-top: -15px;">
                            <div class="input-field col s4">
                                <select ng-model="transferDeceased.intPaymentType"
                                        material-select
                                        required>
                                    <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                    <option value="1">Cash</option>
                                    <option value="2">Cheque</option>
                                </select>
                            </div>
                            <div class="input-field col s2">
                                <label>Total Amount To Pay:</label>
                            </div>
                            <div class="input-field col s2">
                                <label><u>@{{ transfer.service.price.deciPrice | currency : "₱" }}</u></label>
                            </div>
                            <div class="input-field col s2">
                                <label>Amount Paid:<span style="color: red">*</span></label>
                            </div>
                            <div class="input-field col s2">
                                <input ng-model="transferDeceased.deciAmountPaid"
                                       ui-number-mask="2"
                                       id="paid" type="text">
                            </div>
                            <div class="input-field col s4">
                                <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                            </div>
                        </div>

                        <i class = "left" style = "margin-top: 0px; margin-bottom: 50px; padding-left: 15px; color: red;">*Required Fields</i>

                        <div class="row container">

                            <div class="input-field col s4 offset-s8">
                                <button name="action" class="btn wave-lights light-green">Submit</button>
                                <a class="btn waves-lights light-green">Cancel</a>
                            </div>

                        </div>

                    </div>
                </form>

                <!-- Pull Out Deceased -->
                <div id="pullOutDeceased" class="col s12"><br>
                    <center>
                        <!--
                        <label style="font-size: 30px; font-family: myFirstFont2; color: #00897b">Pull Out Deceased</label>
                        -->
                        <div style="margin-top: 10px;">
                            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                                <table id="datatable2">
                                    <thead>
                                        <tr>
                                            <th>Deceased Name</th>
                                            <th>Date of Death</th>
                                            <th>Date to Return Deceased</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="safeBoxs" name="sf"/>
                                                <label for="safeBoxs">Protacio Sangkatakutan</label>
                                            </td>
                                            <td>12/02/09</td>
                                            <td><input type="date"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="safeBoxq" name="sfq"/>
                                                <label for="safeBoxq">Protacio Sangkatakutan</label>
                                            </td>
                                            <td>12/02/09</td>
                                            <td><input type="date"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="safeBoxw" name="sfw"/>
                                                <label for="safeBoxw">Protacio Sangkatakutan</label>
                                            </td>
                                            <td>12/02/09</td>
                                            <td><input type="date"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </center>
                    <br>
                    <div class="row">
                        <center>Payment Details:</center>
                    </div>
                    <div class="row" style="margin-top: -15px;">
                        <div class="input-field col s4">
                            <select ng-model="newPayment.intPaymentType" required>
                                <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                            </select>
                        </div>
                        <div class="input-field col s2">
                            <label>Total Amount To Pay:</label>
                        </div>
                        <div class="input-field col s2">
                            <label><u>P 68,400.00</u></label>
                        </div>
                        <div class="input-field col s2">
                            <label>Amount Paid:<span style="color: red">*</span></label>
                        </div>
                        <div class="input-field col s2">
                            <input id="paid" type="number">
                        </div>
                        <div class="input-field col s4">
                            <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                        </div>
                    </div>
                    <i class = "left" style = "margin-top: 0px; margin-bottom: 50px; padding-left: 15px; color: red;">*Required Fields</i>
                </div>

                <!-- Transfer Ownership Form -->
                <div id="transferOwnership" class="col s12">
                    <!-- 
                    <center>
                        <label style="font-size: 30px; font-family: myFirstFont2; color: #00897b">Transfer Ownership</label>
                    </center>
                    -->
                    <div class="row" style="margin-top: 30px;">
                        <div class="input-field col s8">
                            <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                            <label for="cname">New Owner Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <a data-target="newCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer"
                               href="#newCustomer" style="color: #000000;width: 100px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>

                            <a data-target="updateCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Customer Details"
                               href="#updateCustomer" style="color: #000000;width: 100px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>
                        </div>
                    </div>
                    <div class="row">
                        <center>Payment Details:</center>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <select ng-model="newPayment.intPaymentType" required>
                                <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                            </select>
                        </div>
                        <div class="input-field col s2">
                            <label>Total Amount To Pay:</label>
                        </div>
                        <div class="input-field col s2">
                            <label><u>P 68,400.00</u></label>
                        </div>
                        <div class="input-field col s2">
                            <label>Amount Paid:<span style="color: red">*</span></label>
                        </div>
                        <div class="input-field col s2">
                            <input id="paid" type="number">
                        </div>
                        <div class="input-field col s4">
                            <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                        </div>
                    </div>
                    <i class = "left" style = "margin-top: 0px; margin-bottom: 50px; padding-left: 15px; color: red;">*Required Fields</i>
                </div><br><br>
            </div>
        </div>
    </div>
</div>