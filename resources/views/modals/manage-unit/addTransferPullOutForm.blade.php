<div id="modal1" class="modal modal-fixed-footer" style="width: 95%; max-height: 120%; overflow-y: hidden;">
    <div id="deceasedForm">

        <div class="modal-header">
            <center>
                <label style="font-size: x-large;">Manage Unit: @{{ unit.display }}</label>
            </center>
            <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
        </div>

        <div class="modal-content" style="overflow: auto; position: fixed; clear: bottom;">
            <div class="row">
                <div class="col s6">
                    <div class="row" style="margin-top: 0px;">
                        <div class="col s3">
                            <label style="font-size: large; color: #000000;"><b>Owner Name:</b></label>
                        </div>
                        <div class="col s4">
                            <label style="font-size: large; color: #000000;"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
                        </div>
                        <div class="right col s5">
                            <label style="font-size: medium; color: #000000;" ng-if="deceasedList.length != 0"><b>No. of Deceased: @{{ deceasedList.length }} out of @{{ maxStorage }}</b></label>
                            <label style="font-size: medium; color: #000000;" ng-if="deceasedList.length == 0"><b>No. of Deceased: 0</b></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12" style="margin-top: -20px;">
                <ul class="tabs">
                    <li class="tab col s2"><a class="orange-text" href="#listOfDeceased" style="font-weight: 700;"  >List Of Deceased</a></li>
                    <li class="tab col s2"><a ng-click="openTransaction(add)" class="orange-text" href="#addDeceased" style="font-weight: 700;">Add Deceased</a></li>
                    <li class="tab col s2"><a ng-click="openTransaction(transfer)" class="orange-text" href="#transferDeceased" style="font-weight: 700;">Transfer Deceased</a></li>
                    <li class="tab col s2"><a ng-click="openTransaction(pull)" class="orange-text" href="#pullOutDeceased" style="font-weight: 700;">Pull Out Deceased</a></li>
                    <li class="tab col s2"><a class="orange-text" href="#returnDeceased" style="font-weight: 700;">Return Deceased</a></li>
                    <li class="tab col s2"><a class="orange-text" href="#transferOwnership" style="font-weight: 700;">Transfer Ownership</a></li>
                </ul>
            </div>

            <div style="background: #fafafa">
                <!-- List Of Deceased -->
                <div id="listOfDeceased" class="col s12">
                    <div class="row" style="margin-top: 15px;">
                        <center><label style="font-size: 20px; color: #00897b; font-weight: 700;"><u>List Of Deceased</u></label></center>
                    </div>
                    <div class = "card material-table" style = "margin-top: 0px;">
                        <table datatable="ng">
                            <thead>
                                <tr>
                                    <th style="font-size:15px; color: #000000;">Deceased Name</th>
                                    <th style="font-size:15px; color: #000000;">Date of Death</th>
                                    <th style="font-size:15px; color: #000000;">Date of Birth</th>
                                    <th style="font-size:15px; color: #000000;">Age</th>
                                    <th style="font-size:15px; color: #000000;">Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="deceased in deceasedList">
                                    <td ng-bind="deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName"></td>
                                    <td ng-bind="deceased.dateDeath | amDateFormat : 'MMM D, YYYY'"></td>
                                    <td ng-bind="deceased.dateBirth | amDateFormat : 'MMM D, YYYY'"></td>
                                    <td ng-bind="deceased.intAge"></td>
                                    <td ng-bind="genderList[deceased.intGender]"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>      
                </div>

                <!-- Add Deceased Form -->
                <form ng-submit="processAddDeceased()" autocomplete="off">
                    <div id="addDeceased" class="col s12">
                        <div class="row" style="margin-top: 15px;">
                            <center><label style="font-size: 20px; color: #00897b; font-weight: 700;"><u>Add Deceased</u></label></center>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row" style="margin-top: -30px;">
                                    <div class="input-field col s2">
                                        <label for="dateOfInter">Date of Interment:<span style="color: red">*</span></label>
                                    </div>
                                    <div class="input-field col s2">      
                                        <input ng-model="addDeceased.dateInterment" id="dateOfInter" type="date" required="" aria-required="true" tooltipped 
                                        data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 09/17/2016">
                            
                                    </div>
                                    <div class="input-field col s2">
                                        <label>Time of Interment:<span style="color: red">*</span></label>
                                    </div>
                                    <div class="input-field col s2">      
                                        <label for="timepicker_ampm">Time am/pm</label>
                                        <input ng-model="addDeceased.timeInterment" id="timepicker_ampm" class="timepicker" type="time"
                                        required="" aria-required="true" ui-time-mask='short'>
                                    </div>

                                    <div class="col s3 offset-s1">
                                        <a class="waves-light btn light-green modal-trigger" style="color: #000000; margin-top: 20px;" data-target="requirements" href="#requirements">View Requirements</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s2">
                                        <label>Storage Type:</label>
                                    </div>
                                    <div class="col s2" style="margin-top: 15px;">
                                        <select ng-model="addDeceased.intStorageTypeId"
                                                material-select watch
                                                class="browser-default">
                                            <option value="" disabled selected>Select Type*</option>
                                            <option ng-repeat="storageType in storageTypeList"
                                                    value="@{{ storageType.intStorageTypeId }}" style="color: #000000; text-align: left;">
                                                @{{ storageType.strStorageTypeName }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="input-field col s4">
                                        <input ng-model='addDeceased.strDeceasedName' id="dname" type="text" required="" aria-required="true" class="validate" list="deceasedList">
                                        <label for="dname" data-error="No Existing Deceased Found!">Deceased Name<span style = "color: red;">*</span></label>
                                    </div>

                                    <datalist id="deceasedList">
                                        <option ng-repeat="deceased in customerDeceasedList" value="@{{ deceased.strFullName }}"/>
                                    </datalist>

                                    <div class="col s2">
                                        <a data-target="newDeceased" tooltipped class="waves-light btn light-green modal-trigger" data-delay="50" data-tooltip="Add New Deceased" href="#newDeceased" style="color: #000000; margin-top: 15px;"><i class="material-icons">add</i><i class="material-icons">assignment_ind</i></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s2">
                                        <label>Total Amount To Pay:</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <label><u>@{{ add.service.price.deciPrice | currency : "₱" }}</u></label>
                                    </div>
                                    <div class="input-field col s2">
                                        <select ng-model="addDeceased.intPaymentType"
                                                required
                                                material-select watch>
                                            <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                            <option value="1">Cash</option>
                                            <option value="2">Cheque</option>
                                        </select>
                                    </div>
                                    
                                    <div ng-show="addDeceased.intPaymentType == 2" class="input-field col s2">    
                                        <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000; font-size: 12px;">Cheque Details</a>
                                    </div>

                                    <div class="input-field col s2">
                                        <label>Amount Paid:<span style="color: red">*</span></label>
                                    </div>
                                    <div class="input-field col s2">
                                        <input ng-model="addDeceased.deciAmountPaid"
                                               ui-number-mask="2"
                                               id="paid" type="text">
                                    </div>
                                    
                                </div>
                                <i class = "left" style = "color: red; margin-top: 10px;">*Required Fields</i>
                            </div>
                        </div>
                        <button name="action" class="right btn wave-lights light-green" style="color: #000000; margin-right: 10px; margin-left: 10px;">Submit</button>
                        <a class="right btn waves-lige light-green modal-close" style="color: #000000">Cancel</a>
                    </div><br><br>
                </form>

                <!-- Transfer Deceased Form -->
                <form ng-submit="processTransferDeceased()" autocomplete="off">
                    <div id="transferDeceased" class="col s12">
                        <div class="row" style="margin-top: -40px;">
                            <center><label style="font-size: 20px; color: #00897b; font-weight: 700;"><u>Transfer Deceased</u></label></center>
                        </div>
                        <!-- Deceased List -->
                        <div class="row">
                            <div class="input-field col s6" style="margin-top: -25px;">
                                <h6 style="color: #000000; font-size: 23px;">Deceased Name/s:</h6>
                                <div class="row">
                                    <div ng-repeat="deceased in deceasedList">
                                        <div class="col s6">
                                            <p ng-if="$index%2 == 0 && deceased.return.dateReturn == null" >
                                                <input ng-model="deceased.selected" type="checkbox" id="deceased@{{ deceased.intDeceasedId }}"/>
                                                <label for="deceased@{{ deceased.intDeceasedId }}" style="font-family: Arial; color: #000000; font-size: 16px;">@{{ deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName }}</label>
                                            </p>
                                        </div>
                                        <div class="col s6">
                                            <p ng-if="$index%2 == 1 && deceased.return.dateReturn == null">
                                                <input ng-model="deceased.selected" type="checkbox" id="deceased@{{ deceased.intDeceasedId }}"/>
                                                <label for="deceased@{{ deceased.intDeceasedId }}" style="font-family: Arial; color: #000000; font-size: 16px;">@{{ deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName }}</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-field col s6">    
                                <a class="right waves-light btn light-green modal-trigger" style="color: #000000;" data-target="requirements" href="#requirements">View Requirements</a>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Collapsible -->
                            <div class="col s4">
                                <div class="row">
                                    <ul class="collapsible" data-collapsible="accordion" watch>
                                        <li>
                                            <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                                <label style = "font-size: 1.5vw; color: white;">@{{ unitTypeList[unitIndex].strRoomTypeName }}</label>
                                            </div>
                                            <div ng-repeat="block in unitTypeList[unitIndex].blockList" 
                                                tooltipped class="collapsible-body @{{ block.transferColor }}" 
                                                data-position="right"
                                                 data-delay="50"
                                                 data-tooltip="<u>@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}</u><br>Available: @{{ block.unitStatusCount[1] }}<br>Reserved: @{{ block.unitStatusCount[2] }}<br>At Need: @{{ block.unitStatusCount[4] }}<br>Partially Owned: @{{ block.unitStatusCount[5] }}<br>Owned: @{{ block.unitStatusCount[3] }}<br>Deactivated: @{{ block.unitStatusCount[0] }}"
                                                 style = "max-height: 50px;">
                                                <p style = "padding-top: 15px;">@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}
                                                    <button ng-click="openTransferUnits(block, $index)" id = "Button1" 
                                                    tooltipped class="right btn-floating light-green" 
                                                    data-position = "left" data-delay = "25" data-tooltip = "View" type="button" 
                                                    style="margin-top: -11px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Block -->
                            <div class="col s8" style="margin-top: 10px;">
                                <div ng-hide="transferShowUnit" id="transferDeceasedStart" class="z-depth-1">
                                    <center><h1 style = "font-size: 30px;margin-top: -5px; margin-left: 20px; padding: 20px;">Select a Block</h1></center>
                                </div>

                                <!-- Selected Block -->
                                <div ng-show="transferShowUnit" id="transferDeceasedShow">
                                    <div class="center vaults-content z-depth-3" style="background-color: #e0f2f1; margin-top: -2px;">
                                        <a ng-click="closeBlock1()" tooltipped class="left btn-floating btn-flat btn teal" data-position="right" data-delay="30" data-tooltip="Close"
                                            style="position:absolute; color: white; font-weight: 900; margin-top: 7px; margin-left: -380px;">X</a>
                                        <div class="table-header" style="background-color: #00897b;">
                                            <h2 style = "padding-left: 40px; font-size: 30px; padding: 10px; color: #ffffff;">@{{ blockName }}</h2>
                                        </div>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px; border: 2px solid #00beab; color: #000000;">
                                            <tbody>
                                            <tr ng-repeat="unitLevel in transferUnitList">
                                                <td class="@{{ unit.color }}" ng-repeat="unit in unitLevel" style="border: 2px solid #00beab; color: #000000;">
                                                    <a ng-click="selectTransfer(unit)" 
                                                        tooltipped class="waves-effect waves-light"
                                                        data-position="bottom"
                                                        data-delay="50"
                                                        data-tooltip="<u>Unit: @{{ unit.display }}</u><br>Owner: @{{ unit.strCustomerName }}<br>Price: @{{ unit.unitPrice.deciPrice | currency : 'P' }}<br>Unit Type: @{{ unit.strUnitTypeName }}<br>Status: @{{ unit.strUnitStatus }}"
                                                           >@{{ unit.display }}</a>
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
                            <div class="input-field col s2">
                                <label>Total Amount To Pay:</label>
                            </div>
                            <div class="input-field col s2">
                                <label><u>@{{ transfer.service.price.deciPrice | currency : "₱" }}</u></label>
                            </div>
                            <div class="input-field col s2">
                                <select ng-model="transferDeceased.intPaymentType"
                                        class="browser-default"
                                        required>
                                    <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                    <option value="1">Cash</option>
                                    <option value="2">Cheque</option>
                                </select>
                            </div>
                            <div ng-show="transferDeceased.intPaymentType == 2" class="input-field col s2">
                                <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000; font-size: 12px;">Cheque Details</a>
                            </div>
                            <div class="input-field col s2">
                                <label>Amount Paid:<span style="color: red">*</span></label>
                            </div>
                            <div class="input-field col s2">
                                <input ng-model="transferDeceased.deciAmountPaid"
                                       ui-number-mask="2"
                                       id="paid" type="text">
                            </div>
                        </div>

                        <i class = "left" style = "margin-top: 0px; margin-bottom: 50px; padding-left: 15px; color: red;">*Required Fields</i>

                        <button name="action" class="right btn wave-lights light-green" style="color: #000000; margin-right: 10px; margin-left: 10px;">Submit</button>
                        <a class="right btn waves-lige light-green modal-close" style="color: #000000">Cancel</a>
                    </div>
                </form>

                <!-- Pull Out Deceased -->
                <form ng-submit="processPullDeceased()" autocomplete="off" novalidate>
                    <div id="pullOutDeceased" class="col s12">
                        <div class="row" style="margin-top: -40px;">
                            <center><label style="font-size: 20px; color: #00897b; font-weight: 700;"><u>Pull Out Deceased</u></label></center>
                            <a class="right waves-light btn light-green modal-trigger" style="color: #000000; margin-top: -30px" data-target="requirements" href="#requirements">View Requirements</a>
                        </div>
                        <div style="margin-top: 10px;">
                            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                                <table id="datatable2" datatable="ng" style="table-layout: fixed;">
                                    <thead>
                                    <tr>
                                        <th>Deceased Name</th>
                                        <th>Date of Death</th>
                                        <th>Permanently Pull out?</th>
                                        <th>Date to Return Deceased<span style="color: red">*</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="deceased in deceasedList" ng-if="deceased.return.dateReturn == null">
                                        <td>
                                            <input ng-change="changePull(deceased)" ng-model="deceased.pullSelected" type="checkbox" id="pull@{{ deceased.intDeceasedId }}" name="sf"/>
                                            <label for="pull@{{ deceased.intDeceasedId }}">@{{ deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName }}</label>
                                        </td>
                                        <td>@{{ deceased.dateDeath | amDateFormat : "MMM D, YYYY"}}</td>
                                        <td>
                                            <input ng-disabled="!deceased.pullSelected" ng-change='addToPullDeceased(deceased)' ng-model='deceased.boolPermanentPull' type="checkbox" id="@{{ deceased.intDeceasedId }}yes" value=1/>
                                            <label for="@{{ deceased.intDeceasedId }}yes">Yes</label>
                                        </td>
                                        <td>
                                            <input ng-show='!deceased.boolPermanentPull' ng-disabled="!deceased.pullSelected" ng-model="deceased.dateReturn"
                                                   id="dateOfReturn" type="date">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div ng-show='pullSelected != 0' ng-disabled='pullSelected == 0'>
                            <div class="row">
                                <center>Payment Details:</center>
                            </div>
                            <div class="row" style="margin-top: -15px;">
                                <div class="input-field col s4">
                                    <select ng-model="pullDeceased.intPaymentType"
                                            class="browser-default"
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
                                    <label><u>@{{ pull.service.price.deciPrice * pullSelected | currency : "₱" }}</u></label>
                                </div>
                                <div class="input-field col s2">
                                    <label>Amount Paid:<span style="color: red">*</span></label>
                                </div>
                                <div class="input-field col s2">
                                    <input ng-model="pullDeceased.deciAmountPaid"
                                           ui-number-mask="2"
                                           id="paid" type="text">
                                </div>
                                <div ng-show="pullDeceased.intPaymentType == 2" class="input-field col s4">
                                    <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                                </div>
                            </div>
                            <i class = "left" style = "margin-top: 0px; margin-bottom: 50px; padding-left: 15px; color: red;">*Required Fields</i>
                        </div>
                        <button name="action" class="right btn wave-lights light-green" style="color: #000000; margin-right: 10px; margin-left: 10px;">Submit</button>
                        <a class="right btn waves-lige light-green modal-close" style="color: #000000">Cancel</a>
                        <br><br>
                    </div>
                </form>

                <!-- Return Deceased -->
                <div id="returnDeceased" class="col s12">
                    <div class="row" style="margin-top: -40px;">
                        <center><label style="font-size: 20px; color: #00897b; font-weight: 700;"><u>Return Deceased</u></label></center>
                    </div>
                    <div class="row">
                        <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                            <table id="datatable4" datatable="ng">
                                <thead>
                                <tr>
                                    <th>Return Date</th>
                                    <th>Deceased Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="deceased in deceasedList" ng-if="deceased.return.dateReturn != null">
                                    <td>@{{ deceased.return.dateReturn | amDateFormat : "MMM D, YYYY" }}</td>
                                    <td>@{{ deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName }}</td>
                                    <td><a ng-click="openReturnModal(deceased)" data-target="return" class="returnBtn waves-light btn light-green btn modal-trigger" style="color: #000000">Return</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br><br><br>
                </div>


                <!-- Transfer Ownership Form -->
                <div id="transferOwnership" class="col s12">
                    <div class="row" style="margin-top: -40px;">
                        <center><label style="font-size: 20px; color: #00897b; font-weight: 700;"><u>Transfer Ownership</u></label></center><br>
                    </div>
                    <form ng-submit="processTransferOwnership()" autocomplete="off">
                        <div class="row" style="margin-top: -30px;">
                            <div class="input-field col s5">
                                <input ng-model="transferOwnership.customerName" name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="customerList">
                                <label for="cname">New Owner Name<span style = "color: red;">*</span></label>
                            </div>
                            <datalist id="customerList">
                                <option ng-repeat="customer in customerList" value="@{{ customer.strFullName }}"></option>
                            </datalist>
                            <div class="input-field col s3">
                                <a ng-show="transferOwnership.customerName == null"
                                   data-target="newCustomer" tooltipped class="waves-light btn light-green modal-trigger" data-delay="50" data-tooltip="Add New Customer"
                                   href="#newCustomer" style="color: #000000;width: 100px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>

                                <a ng-hide="transferOwnership.customerName == null"
                                   ng-click="getCustomer(transferOwnership.customerName)"
                                   tooltipped class="waves-light btn light-green modal-trigger" data-delay="50" data-tooltip="Update Customer Details" style="color: #000000;width: 100px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>
                            </div>
                            <div class="col s4">
                                <a class="right waves-light btn light-green modal-trigger" style="color: #000000; margin-top: 15px;" data-target="requirements" href="#requirements">View Requirements</a>
                            </div>
                        </div>
                        <div class="row">
                            <center>Payment Details:</center>
                        </div>
                        <div class="row">
                            <div class="input-field col s2">
                                <label>Total Amount To Pay:</label>
                            </div>
                            <div class="input-field col s2">
                                <label><u>@{{ transferOwnerCharge.deciBusinessDependencyValue | currency : "P" }}</u></label>
                            </div>
                            <div class="input-field col s2">
                                <select ng-model="transferOwnership.intPaymentType"
                                        class="browser-default"
                                        required>
                                    <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                    <option value="1">Cash</option>
                                    <option value="2">Cheque</option>
                                </select>
                            </div>
                            <div class="input-field col s2">
                                <a ng-show="transferOwnership.intPaymentType == 2"
                                   data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000; font-size: 12px;">Cheque Details</a>
                            </div>
                            <div class="input-field col s2">
                                <label>Amount Paid:<span style="color: red">*</span></label>
                            </div>
                            <div class="input-field col s2">
                                <input ng-model="transferOwnership.deciAmountPaid"
                                       ui-number-mask="2"
                                       id="paid" type="text">
                            </div>
                        </div>
                        <i class = "left" style = "margin-top: 0px; margin-bottom: 50px; padding-left: 15px; color: red;">*Required Fields</i>
                        <button name="action" class="right btn wave-lights light-green" style="color: #000000; margin-right: 10px; margin-left: 10px;">Submit</button>
                        <a class="right btn waves-lige light-green modal-close" style="color: #000000">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Clockpicker -->
<script type="text/javascript">
    //am/pm
    $('#timepicker_ampm').pickatime();
    $('#timepicker_ampm_dark').pickatime({
        darktheme: true
    });
    //24
    $('#timepicker_24').pickatime({
        twelvehour: false
    });
    $('#timepicker_24_dark').pickatime({
        darktheme: true,
        twelvehour: false
    });
    //default
    $('#timepicker_default').pickatime({
        default: 'now'
    });
    //fromnow
    $('#timepicker_fromnow').pickatime({
        default: 'now',
        fromnow: 5 * 1000 * 60
    });
    //donetext
    $('#timepicker_donetext').pickatime({
        donetext: 'set'
    });
    //autoclose
    $('#timepicker_autoclose').pickatime({
        autoclose: true
    });
    //ampmclickable
    $('#timepicker_ampmclickable').pickatime({
        ampmclickable: true
    });
    $('#timepicker_ampmclickable_dark').pickatime({
        ampmclickable: true,
        darktheme: true
    });
    //vibrate
    $('#timepicker_vibrate').pickatime({
        vibrate: true
    });
</script>