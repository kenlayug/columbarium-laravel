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
