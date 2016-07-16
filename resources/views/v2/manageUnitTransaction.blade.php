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
<div ng-controller="ctrl.manage-unit">
    <!-- Added Deceased -->
    <div id="successAddDeceased" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
        <div class="modal-header" style="padding: 0px">
            <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
        </div>
        <div class="modal-content" style="overflow-y: auto; margin-top: -25px;">
            <div class="row">
                <div class="col s6" style="margin-left: -15px;">
                    <div class="row">
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Owner Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Date:</label>
                        </div>
                        <div class="col s6">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.lastTransaction.created_at | amDateFormat:'dddd, MMMM Do YYYY'}}</u></label>
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
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Owner Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Date:</label>
                        </div>
                        <div class="col s6">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.transactionDeceased.created_at | amDateFormat:'dddd, MMMM Do YYYY'}}</u></label>
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
                    <table id="datatable" datatable="ng">
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
                                <td>Unit No. @{{ lastTransaction.fromUnit }}</td>
                                <td>Unit No. @{{ lastTransaction.toUnit }}</td>
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
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Owner Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>Aaron CLyde Garil</u></label>
                        </div>
                    </div>
                </div>

                <div class="col s6">
                    <div class="row">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>T312</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Date:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>07/09/16</u></label>
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
                            <label><u>Pull Out</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Service Fee</label>
                        </div>
                        <div class="input-field col s5">
                            <label>P 4,000.00</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 46px;">
                        <div class="input-field col s7">
                            <label>Storage Type:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Bone Box</u></label>
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
                            <label><u>P 4,000.00</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Quantity:</label>
                        </div>
                        <div class="input-field col s5">
                            <label>3</label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>P 12,000.00</u></label>
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
                            <label><u>P 12,000.00</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label>P 12,000.00</label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label style="color: red"><u>P 0.00</u></label>
                        </div><br><br><br>
                    </div>
                </div>
            </div>
            <div class="row">
                <center><label style="color: #000000; font-size: 15px;">Deceased Details:</label></center>
            </div>
            <div class="row">
                <div class="z-depth-2 card material-table">
                    <table id="datatable">
                        <thead>
                            <tr>
                                <th>Deceased Name</th>
                                <th>Date of Death</th>
                                <th>Date to Return Deceased</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Protacio Sangkatakutan</td>
                                <td>03/09/13</td>
                                <td>09/08/16</td>
                            </tr>
                            <tr>
                                <td>Protacio Sangkatakutan</td>
                                <td>03/09/13</td>
                                <td>09/08/16</td>
                            </tr>
                            <tr>
                                <td>Protacio Sangkatakutan</td>
                                <td>03/09/13</td>
                                <td>09/08/16</td>
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
                            <label style="color: #000000; font-size: 15px;"><u>E1</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;">Owner Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>Aaron CLyde Garil</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;">New Owner Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>John Ezekiel Martinez</u></label>
                        </div>
                    </div>
                </div>

                <div class="col s6">
                    <div class="row">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>T312</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Date:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>07/09/16</u></label>
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
                            <table id="datatable1">
                                <thead>
                                    <tr>
                                        <th>Deceased Name</th>
                                        <th>Date of Death</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Protacio Sangkatakutan</td>
                                        <td>03/09/13</td>
                                    </tr>
                                    <tr>
                                        <td>Protacio Sangkatakutan</td>
                                        <td>03/09/13</td>
                                    </tr>
                                    <tr>
                                        <td>Protacio Sangkatakutan</td>
                                        <td>03/09/13</td>
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
                            <label><u>P 4,000.00</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label>P 4,000.00</label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label style="color: red"><u>P 0.00</u></label>
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
                                        <button name = "action" class="btn-floating green";"></button>
                                        <label style="font-size: 15px; color: #000000;">Available</label>
                                    </div>
                                    <div class = "col s3">
                                        <button name = "action" class="btn-floating blue"></button>
                                        <label style="font-size: 15px; color: #000000;">Reserved</label>
                                    </div>
                                    <div class = "col s3">
                                        <button name = "action" class="btn-floating yellow""></button>
                                        <label style="font-size: 15px; color: #000000;">Partially Owned</label>
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
        @include('modals.manage-unit.addTransferPullOutForm')
        @include('modals.manage-unit.newCustomer')
    </div>
</div>
@endsection