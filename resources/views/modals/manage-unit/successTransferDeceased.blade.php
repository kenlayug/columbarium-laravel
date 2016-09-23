        <!-- Transfer Deceased -->
        <div id="successTransferDeceased" class="modal modal-fixed-footer" style="overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px">
                <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Generated Receipt</h4></center>
                <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
                style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
            </div>
            <div class="modal-content" style="overflow: auto; clear: top;">
                <div class="row">
                    <center>
                        <h5>Columbarium and Crematorium Management System</h5>
                        <h6>La Loma Catholic Cemetery Compound C3 Road Caloocan City</h6>
                        <h6>(Transfered Deceased Receipt)</h6>
                    </center>
                </div><br>
                <div class="row">
                    <div class="col s6" style="margin-left: -15px;">
                        <div class="row">
                            <div class="col s7">
                                <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
                            </div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="row">
                            <div class="col s6 offset-s1">
                                <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ lastTransaction.transactionDeceased.intTransactionDeceasedId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -25px;">
                            <div class="col s6 offset-s1">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.transactionDeceased.created_at | amDateFormat:'dddd, MMMM Do YYYY'}}</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="border: 1px solid #7b7073; margin-left: 30px; margin-right: 30px;">
                        <div class="row">
                            <div class="input-field col s4 offset-s2">
                                <label style="color: #000000;">Service:</label>
                            </div>
                            <div class="input-field col s3">
                                <label><u>@{{ lastTransaction.service.strServiceName }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4 offset-s2">
                                <label style="color: #000000;">Service Fee:</label>
                            </div>
                            <div class="input-field col s3">
                                <label>@{{ lastTransaction.service.deciPrice | currency : "₱" }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4 offset-s2">
                                <label style="color: #000000;">Quantity:</label>
                            </div>
                            <div class="input-field col s3">
                                <label>@{{ lastTransaction.deceasedList.length }}</label>
                            </div><br><br>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 0px;">
                            <div class="input-field col s4 offset-s2">
                                <label style="color: #000000;">Total Amount to Pay:</label>
                            </div>
                            <div class="input-field col s3">
                                <label><u>@{{ lastTransaction.service.deciPrice * lastTransaction.deceasedList.length | currency: "₱" }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 0px;">
                            <div class="input-field col s4 offset-s2">
                                <label style="color: #000000;">Amount Paid:</label>
                            </div>
                            <div class="input-field col s3">
                                <label>@{{ lastTransaction.transactionDeceased.deciAmountPaid | currency : "₱" }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s4 offset-s2">
                                <label style="color: #000000;">Change:</label>
                            </div>
                            <div class="input-field col s3">
                                <label style="color: red"><u>@{{ lastTransaction.transactionDeceased.deciAmountPaid - (lastTransaction.service.deciPrice * lastTransaction.deceasedList.length) | currency : "₱" }}</u></label>
                            </div><br><br>
                        </div>
                    </div>
                <!--
                <div class="row">
                    <div class="col s4" style="border: 3px solid #7b7073;">
                        <center><h6>Transfer Deceased Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Service:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ lastTransaction.service.strServiceName }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Service Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ lastTransaction.service.deciPrice | currency : "₱" }}</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 46px;">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Storage Type:</label>
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
                                <label style="color: #000000;">Service Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ lastTransaction.service.deciPrice | currency : "₱" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Quantity:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ lastTransaction.deceasedList.length }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Total Amount to Pay:</label>
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
                                <label style="color: #000000;">Total Amount to Pay:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ lastTransaction.service.deciPrice * lastTransaction.deceasedList.length | currency : "₱" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Amount Paid:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ lastTransaction.transactionDeceased.deciAmountPaid | currency : "₱" }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Change:</label>
                            </div>
                            <div class="input-field col s5">
                                <label style="color: red"><u>@{{ lastTransaction.transactionDeceased.deciAmountPaid - (lastTransaction.service.deciPrice * lastTransaction.deceasedList.length) | currency : "₱" }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                </div>
                -->
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

                <br><br><br>
            </div>
            <div class="modal-footer">
                <button ng-click="generateReceipt(lastTransaction.transactionDeceased.intTransactionDeceasedId)" name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
            </div>
        </div>
        <!-- Transfer Deceased -->
