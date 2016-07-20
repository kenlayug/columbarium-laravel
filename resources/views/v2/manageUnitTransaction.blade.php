@extends('v2.baseLayout')
@section('title', 'Manage Unit')
@section('body')

    <link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/vaults.css') !!}">
    <script type="text/javascript" src="{!! asset('/js/manageUnit.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/manage-unit/controller.js') !!}"></script>

    <button data-target="successAddDeceased" class="right waves-light btn blue modal-trigger" href="#successAddDeceased" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">add deceased</button>

    <button data-target="successTransferDeceased" class="right waves-light btn blue modal-trigger" href="#successTransferDeceased" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Transfer deceased</button>

    <button data-target="successPullOutDeceased" class="right waves-light btn blue modal-trigger" href="#successPullOutDeceased" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Pull Out deceased</button>

    <button data-target="successTransferOwnership" class="right waves-light btn blue modal-trigger" href="#successTransferOwnership" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Transfer Ownership</button>

    <button data-target="successReturnDeceased" class="right waves-light btn blue modal-trigger" href="#successReturnDeceased" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Return deceased</button>

    <button data-target="safeBox" class="right waves-light btn blue modal-trigger" href="#safeBox" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Safe Box</button>

    <button data-target="modal1" class="right waves-light btn blue modal-trigger" href="#modal1" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">modal1</button>

    <div ng-controller="ctrl.manage-unit">

        <!-- Retrieve Deceased -->
        <div id="retrieve" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px;">
                <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Retrieve Deceased</h4></center>
                <a class="right waves-light btn light-green modal-trigger" style="color: #000000; margin-top: -63px; margin-right: 15px;" data-target="requirements" href="#requirements">View Requirements</a>
            </div>
            <div class="modal-content" style="overflow-y: auto;">
                <div class="row" style="margin-top: -30px;">
                    <div class="input-field col s6">
                        <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                        <label for="cname" data-error="No Existing Customer Found!">Customer Name<span style = "color: red;">*</span></label>
                    </div>
                    <datalist id="nameList">
                        <option value="Monkey D. Luffy">
                        <option value="Roronoa Zoro">
                        <option value="Vinsmoke Sanji">
                        <option value="Tony Tony Chopper">
                        <option value="Nico Robin">
                    </datalist>

                    <div class="col s2">
                        <a data-target="newCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer" href="#newCustomer" style="color: #000000; margin-top: 15px; margin-left: -15px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>
                        <!--
                        <a data-target="updateCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Customer Details" href="#updateCustomer" style="color: #000000;width: 100px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>
                                    -->
                    </div>
                </div>
                <div class="row">
                    <div class="col s3">
                        <label style="color: #000000; font-size: 15px;">Deceased Name:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;">Protacio Sangkatakutan</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s3">
                        <label style="color: #000000; font-size: 15px;">Retrieval Fee:</label>
                    </div>
                    <div class="col s9">
                        <label style="color: #000000; font-size: 15px;">P 5,000.00</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <select ng-model="addDeceased.intPaymentType" required material-select>
                            <option value="" disabled selected>Mode of Payment<span>*</span></option>
                            <option value="1">Cash</option>
                            <option value="2">Cheque</option>
                        </select>
                    </div>
                    <div class="input-field col s2">
                        <label>Amount Paid:<span style="color: red">*</span></label>
                    </div>
                    <div class="input-field col s4">
                        <input id="paid" type="number">
                    </div>
                </div>
                <div class="row" style="margin-top: -40px;">
                    <div class="input-field col s4">
                        <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                    </div>
                </div>

                <br><br>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Submit</button>
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </div>
        <!-- Retrieve Deceased -->

        <!-- Safe Box  -->
        <div id="safeBox" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px;">
                <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Safe Box</h4></center>
            </div>
            <div class="modal-content" style="overflow-y: auto;">
                <div class="z-depth-2 card material-table" style="margin-top: -10px;">
                    <table id="datatable5">
                        <thead>
                        <tr>
                            <th>Deceased Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Protacio Sangkatakutan</td>
                            <td><a data-target="retrieve" class="returnBtn waves-light btn light-green btn modal-trigger" href="#retrieve" style="color: #000000">Retrieve</a></td>
                        </tr>
                        <tr>
                            <td>Protacio Sangkatakutan</td>
                            <td><a data-target="retrieve" class="returnBtn waves-light btn light-green btn modal-trigger" href="#retrieve" style="color: #000000">Retrieve</a></td>
                        </tr>
                        <tr>
                            <td>Protacio Sangkatakutan</td>
                            <td><a data-target="retrieve" class="returnBtn waves-light btn light-green btn modal-trigger" href="#retrieve" style="color: #000000">Retrieve</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div><br><br><br>
            </div>
            <div class="modal-footer">
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </div>
        <!-- Safe Box  -->

        <!-- Return Deceased -->
        <div id="return" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px;">
                <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Return Deceased</h4></center>
            </div>
            <div class="modal-content">
                <div class="row">
                    <a class="right waves-light btn light-green modal-trigger" style="color: #000000;" data-target="requirements" href="#requirements">View Requirements</a>
                </div>
                <div class="row">
                    <div class="col s2">
                        <label style="color: #000000; font-size: 15px;">Deceased Name:</label>
                    </div>
                    <div class="col s3">
                        <label style="color: #000000; font-size: 15px;">@{{ returnDeceased.strLastName+', '+returnDeceased.strFirstName+' '+returnDeceased.strMiddleName }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s2">
                        <label style="color: #000000; font-size: 15px;">Returned Date:</label>
                    </div>
                    <div class="col s3">
                        <label style="color: #000000; font-size: 15px;">@{{ returnDeceased.currentDate | amDateFormat : "MMM D, YYYY" }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s2">
                        <label style="color: #000000; font-size: 15px;">Date to Return:</label>
                    </div>
                    <div class="col s3">
                        <label style="color: #000000; font-size: 15px;">@{{ returnDeceased.return.dateReturn | amDateFormat : "MMM D, YYYY" }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s2">
                        <label style="color: #000000; font-size: 15px;">Penalty Charge:</label>
                    </div>
                    <div class="col s3">
                        <label ng-show="returnDeceased.penalty" style="color: #000000; font-size: 15px;">@{{ penaltyForNotReturn.deciBusinessDependencyValue | currency: "₱" }}</label>
                        <label ng-hide="returnDeceased.penalty" style="color: #000000; font-size: 15px;">@{{ 0 | currency: "₱" }}</label>
                    </div>
                </div>
                <div ng-show="returnDeceased.penalty">
                    <div class="row">
                        <div class="input-field col s4">
                            <select ng-model="returnDeceased.intPaymentType" required
                                    class="browser-default">
                                <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                            </select>
                        </div>
                        <div class="input-field col s2">
                            <label>Amount Paid:<span style="color: red">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <input ng-model="returnDeceased.deciAmountPaid"
                                   ui-number-mask="2"
                                   id="paid" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div ng-show="returnDeceased.intPaymentType == 2"
                             class="input-field col s4">
                            <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button ng-click="processReturnDeceased()" name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Return</button>
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </div>
        <!-- return deceased -->

        <!-- Success Return Deceased -->
        <div id="successReturnDeceased" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px">
                <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
            </div>
            <div class="modal-content" style="overflow-y: auto; margin-top: -25px;">
                <div class="row">
                    <div class="col s6" style="margin-left: -15px;">
                        <div class="row">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
                            </div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="row">
                            <div class="col s4 offset-s4">
                                <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                            </div>
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ returnDeceasedTransaction.transactionDeceased.intTransactionDeceasedId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -25px;">
                            <div class="col s4 offset-s4">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ returnDeceasedTransaction.transactionDeceased.created_at | amDateFormat:'dddd, MMMM Do YYYY'}}</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: -20px;">
                    <div class="col s6" style="border: 3px solid #7b7073;"><br>
                        <center><h6>Returned Deceased Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Date to Return:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ returnDeceasedTransaction.returnDate.date | amDateFormat : "MMM D, YYYY" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Date Returned:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ returnDeceasedTransaction.transactionDeceased.created_at | amDateFormat : "MMM D, YYYY" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Deceased Name:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ returnDeceasedTransaction.deceased.strLastName+', '+returnDeceasedTransaction.deceased.strFirstName+' '+returnDeceasedTransaction.deceased.strMiddleName }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -1px;">
                            <div class="input-field col s7">
                                <label>Storage Type:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ returnDeceasedTransaction.deceased.strStorageTypeName }}</u></label>
                            </div>
                        </div><br><br>
                    </div>
                    <div class="col s6" style="border: 3px solid #7b7073;"><br>
                        <center><h6>Payment Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Penalty Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label ng-if="returnDeceasedTransaction.penalty == null"><u>@{{ 0 | currency: "P" }}</u></label>
                                <label ng-if="returnDeceasedTransaction.penalty != null"><u>@{{ returnDeceasedTransaction.penalty.deciBusinessDependencyValue | currency: "P" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Amount Paid:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ returnDeceasedTransaction.transactionDeceased.deciAmountPaid | currency: "P" }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label>Change:</label>
                            </div>
                            <div class="input-field col s5">
                                <label ng-if="returnDeceasedTransaction.penalty != null" style="color: red"><u>@{{ returnDeceasedTransaction.transactionDeceased.deciAmountPaid - returnDeceasedTransaction.penalty.deciBusinessDependencyValue | currency: "P" }}</u></label>
                                <label ng-if="returnDeceasedTransaction.penalty == null" style="color: red"><u>@{{ 0 | currency: "P" }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </div>
        <!-- Return Deceased -->



        <!-- Add Deceased -->
        <div id="successAddDeceased" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px">
                <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
            </div>
            <div class="modal-content" style="overflow-y: auto; margin-top: -25px;">
                <div class="row">
                    <div class="col s6" style="margin-left: -15px;">
                        <div class="row">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
                            </div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="row">
                            <div class="col s4 offset-s4">
                                <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                            </div>
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ transaction.lastTransaction.intTransactionDeceasedId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -25px;">
                            <div class="col s4 offset-s4">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.lastTransaction.created_at | amDateFormat:'dddd, MMMM Do YYYY'}}</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: -20px;">
                    <div class="col s6" style="border: 3px solid #7b7073;"><br>
                        <center><h6>Added Deceased Details: </h6></center><br>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Deceased Name:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.deceased.strLastName+', '+transaction.deceased.strFirstName+' '+transaction.deceased.strMiddleName }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Date of Death:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.deceased.dateDeath.date | amDateFormat:'dddd, MMMM Do YYYY'}}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Storage Type:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.storageType.strStorageTypeName }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Service:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.service.strServiceName }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Service Fee:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.service.price.deciPrice | currency : "₱" }}</u></label>
                            </div>
                        </div>
                    </div>
                    <div class="col s6" style="border: 3px solid #7b7073;"><br>
                        <center><h6>Payment Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Service Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ transaction.service.price.deciPrice | currency : "₱" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Amount Paid:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ transaction.lastTransaction.deciAmountPaid | currency : "₱" }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label>Change:</label>
                            </div>
                            <div class="input-field col s5">
                                <label style="color: red"><u>@{{ transaction.lastTransaction.deciAmountPaid - transaction.service.price.deciPrice | currency : "₱" }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </div>
        <!-- Added Deceased -->



        <!-- Transfer Deceased -->
        <div id="successTransferDeceased" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px">
                <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
            </div>
            <div class="modal-content" style="overflow: auto; clear: top;">
                <div class="row">
                    <div class="col s6" style="margin-left: -15px;">
                        <div class="row">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
                            </div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="row">
                            <div class="col s4 offset-s4">
                                <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                            </div>
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ lastTransaction.transactionDeceased.intTransactionDeceasedId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -25px;">
                            <div class="col s4 offset-s4">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.transactionDeceased.created_at | amDateFormat:'dddd, MMMM Do YYYY'}}</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s4" style="border: 3px solid #7b7073;">
                        <center><h6>Transfer Deceased Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Service:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ lastTransaction.service.strServiceName }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Service Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ lastTransaction.service.deciPrice | currency : "₱" }}</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 46px;">
                            <div class="input-field col s7">
                                <label>Storage Type:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ lastTransaction.storageType.strStorageTypeName }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                    <div class="col s4" style="border: 3px solid #7b7073;">
                        <center><h6>Total Amount To Pay: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Service Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ lastTransaction.service.deciPrice | currency : "₱" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Quantity:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ lastTransaction.deceasedList.length }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label>Total Amount to Pay:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ lastTransaction.service.deciPrice * lastTransaction.deceasedList.length | currency: "₱" }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                    <div class="col s4" style="border: 3px solid #7b7073;">
                        <center><h6>Payment Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Total Amount to Pay:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ lastTransaction.service.deciPrice * lastTransaction.deceasedList.length | currency : "₱" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Amount Paid:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ lastTransaction.transactionDeceased.deciAmountPaid | currency : "₱" }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label>Change:</label>
                            </div>
                            <div class="input-field col s5">
                                <label style="color: red"><u>@{{ lastTransaction.transactionDeceased.deciAmountPaid - (lastTransaction.service.deciPrice * lastTransaction.deceasedList.length) | currency : "₱" }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <center><label style="color: #000000; font-size: 15px;">Deceased Details:</label></center>
                </div>
                <div class="row">
                    <div class="z-depth-2 card material-table">
                        <table id="datatable1" datatable="ng">
                            <thead>
                            <tr>
                                <th>Deceased Name</th>
                                <th>From Unit</th>
                                <th>To Unit</th>
                                <th>Date of Death</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="deceased in lastTransaction.deceasedList">
                                <td>@{{ deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName }}</td>
                                <td>@{{ lastTransaction.fromUnit }}</td>
                                <td>@{{ lastTransaction.toUnit }}</td>
                                <td>@{{ deceased.dateDeath | amDateFormat:'MMM D YYYY' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </div>
        <!-- Transfer Deceased -->



        <!-- Pull Out Deceased -->
        <div id="successPullOutDeceased" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px">
                <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
            </div>
            <div class="modal-content" style="overflow: auto; clear: top;">
                <div class="row">
                    <div class="col s6" style="margin-left: -15px;">
                        <div class="row">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
                            </div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="row">
                            <div class="col s4 offset-s4">
                                <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                            </div>
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ pullDeceasedTransaction.transactionDeceased.intTransactionDeceasedId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -25px;">
                            <div class="col s4 offset-s4">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ pullDeceasedTransaction.transactionDeceased.created_at | amDateFormat:'dddd, MMMM Do YYYY' }}</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s4" style="border: 3px solid #7b7073;">
                        <center><h6>Pull Out Deceased Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Service:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ pullDeceasedTransaction.service.strServiceName }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Service Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ pullDeceasedTransaction.service.deciPrice | currency : "P" }}</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 46px;">
                            <div class="input-field col s7">
                                <label>Storage Type:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ pullDeceasedTransaction.storageType.strStorageTypeName }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                    <div class="col s4" style="border: 3px solid #7b7073;">
                        <center><h6>Total Amount To Pay: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Service Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ pullDeceasedTransaction.service.deciPrice | currency : "P" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Quantity:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ pullDeceasedTransaction.deceasedList.length }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label>Total Amount to Pay:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ pullDeceasedTransaction.totalAmountToPay | currency: "P" }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                    <div class="col s4" style="border: 3px solid #7b7073;">
                        <center><h6>Payment Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Total Amount to Pay:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ pullDeceasedTransaction.totalAmountToPay | currency: "P" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Amount Paid:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ pullDeceasedTransaction.transactionDeceased.deciAmountPaid | currency: "P" }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label>Change:</label>
                            </div>
                            <div class="input-field col s5">
                                <label style="color: red"><u>@{{ pullDeceasedTransaction.transactionDeceased.deciAmountPaid - pullDeceasedTransaction.totalAmountToPay | currency: "P" }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <center><label style="color: #000000; font-size: 15px;">Deceased Details:</label></center>
                </div>
                <div class="row">
                    <div class="z-depth-2 card material-table">
                        <table id="datatable3" datatable="ng">
                            <thead>
                            <tr>
                                <th>Deceased Name</th>
                                <th>Date of Death</th>
                                <th>Date to Return Deceased</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="deceased in pullDeceasedTransaction.pullDeceasedList">
                                <td>@{{ deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName }}</td>
                                <td>@{{ deceased.dateDeath | amDateFormat:'MMM D YYYY' }}</td>
                                <td>@{{ deceased.dateReturn | amDateFormat:'MMM D YYYY' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </div>
        <!-- Pull Out Deceased -->


        <!-- Transfer Ownership-->
        <div id="successTransferOwnership" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px">
                <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
            </div>
            <div class="modal-content" style="overflow-y: auto;">
                <div class="row">
                    <div class="col s6" style="margin-left: -15px;">
                        <div class="row">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Unit Code:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>Unit No. @{{ unit.intUnitId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -25px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Owner Name:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transferOwnershipTransaction.prevOwner.strLastName+', '+transferOwnershipTransaction.prevOwner.strFirstName+' '+transferOwnershipTransaction.prevOwner.strMiddleName }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -25px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">New Owner Name:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transferOwnershipTransaction.newOwner.strLastName+', '+transferOwnershipTransaction.newOwner.strFirstName+' '+transferOwnershipTransaction.newOwner.strMiddleName }}</u></label>
                            </div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="row">
                            <div class="col s4 offset-s6">
                                <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                            </div>
                            <div class="col s2">
                                <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ transferOwnershipTransaction.transactionOwnership.intTransactionOwnershipId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -25px;">
                            <div class="col s4 offset-s6">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s2">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transferOwnershipTransaction.transactionOwnership.created_at | amDateFormat:'dddd, MMMM Do YYYY' }}</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col s8" style="margin-top: -40px;">
                        <div class="row">
                            <label style="color: #000000; font-size: 15px;">Unit Details:</label>
                        </div>
                        <div class="row">
                            <div class="z-depth-2 card material-table">
                                <table id="datatable" datatable="ng">
                                    <thead>
                                    <tr>
                                        <th>Deceased Name</th>
                                        <th>Date of Death</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="deceased in transferOwnershipTransaction.deceasedList">
                                        <td>@{{ deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName }}</td>
                                        <td>@{{ deceased.dateDeath | amDateFormat:'MMM D YYYY' }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col s4" style="border: 3px solid #7b7073;">
                        <center><h6>Payment Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Service Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ transferOwnerCharge.deciBusinessDependencyValue | currency: "P" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Amount Paid:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ transferOwnershipTransaction.transactionOwnership.deciAmountPaid | currency: "P" }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label>Change:</label>
                            </div>
                            <div class="input-field col s5">
                                <label style="color: red"><u>@{{ transferOwnershipTransaction.transactionOwnership.deciAmountPaid - transferOwnerCharge.deciBusinessDependencyValue | currency: "P" }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                </div>

                <br><br>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </div>
        <!-- Transfer Ownership -->



        <div class = col s12 >
            <div class = "row">
                <div class = "col s4">
                    <h4 style = "margin-top: 20px; margin-left: 20px; font-family: myFirstFont">Manage Unit</h4>

                    <div style = "overflow: auto;height: 370px;">
                        <div class = "col s12">
                            <div class = "aside aside ">
                                <ul class="collapsible" data-collapsible="accordion" watch>
                                    <li ng-repeat="unitType in unitTypeList">
                                        <div ng-click="getBlocks(unitType, $index)"
                                             class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                            <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">@{{ unitType.strRoomTypeName }}</label>
                                        </div>
                                        <div ng-repeat="block in unitType.blockList"
                                             class="collapsible-body @{{ block.color }}" style = "max-height: 50px;">
                                            <p style = "padding-top: 15px;">@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}
                                                <button ng-click="getUnits(block, $index)"
                                                        id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                            </p>
                                        </div>
                                        <div ng-if="unitType.blockList.length == 0"
                                             class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                            <p style = "padding-top: 15px;">
                                                No blocks available for this unit type.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Legends -->
                    <div class = "row" style="margin-top: -80px;">
                        <div class = "col s12">
                            <div class = "aside aside z-depth-3" style = "height: 130px;">
                                <div class = "header" style = "height: 35px; background-color: #00897b">
                                    <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: myFirstFont2;">Legend:</label>
                                </div>

                                <div class = "row" style = "margin-top: 10px;">
                                    <center>
                                        <div class = "col s3">
                                            <button name = "action" class="btn-floating green"></button>
                                            <label style="font-size: 15px; color: #000000;">Available</label>
                                        </div>
                                        <div class = "col s3">
                                            <button name = "action" class="btn-floating blue"></button>
                                            <label style="font-size: 15px; color: #000000;">Reserved</label>
                                        </div>
                                        <div class = "col s3">
                                            <button name = "action" class="btn-floating yellow"></button>
                                            <label style="font-size: 15px; color: #000000;">AtNeed</label>
                                        </div>
                                        <div class = "col s3">
                                            <button name = "action" class="btn-floating red"></button>
                                            <label style="font-size: 15px; color: #000000;">Owned</label>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class = "col s8">
                    <div class = "col s4 z-depth-2 " style = "margin-top: 20px; width: 100%;">
                        <div ng-hide="showUnit" id="tableStart">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3">
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
                            </div>
                        </div>
                        <div ng-show="showUnit" class="responsive" id="tableUnit">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3">
                                    <div class="center vaults-content">
                                        <h2 style = "padding-left: 40px; font-size: 30px; margin-top: 20px; font-family:  myFirstFont">@{{ blockName }}</h2>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                            <tbody>
                                            <tr ng-repeat="unitLevel in unitList">
                                                <td ng-repeat="unit in unitLevel"
                                                    class="@{{ unit.color }}">
                                                    <a ng-click="openModal(unit)"
                                                       data-target="modal1" class="waves-effect waves-light modal-trigger">@{{ unit.display }}</a>
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
            @include('modals.collection-downpayment.cheque')
            @include('modals.service-purchases.requirements')
            @include('modals.manage-unit.addTransferPullOutForm')
            @include('modals.manage-unit.newCustomer')

        </div>
    </div>
@endsection