        <!-- Success Return Deceased -->
        <div id="successReturnDeceased" class="modal modal-fixed-footer" style="overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px">
                <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Generated Receipt</h4></center>
                <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
                style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
            </div>
            <div class="modal-content" style="overflow-y: auto;">
                <div class="row">
                    <center>
                        <h5>Columbarium and Crematorium Management System</h5>
                        <h6>La Loma Catholic Cemetery Compound C3 Road Caloocan City</h6>
                        <h6>(Returned Deceased Receipt)</h6>
                    </center>
                </div><br>
                <div class="row">
                    <div class="col s6" style="margin-left: -15px;">
                        <div class="row">
                            <div class="col s6">
                                <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                            </div>
                            <div class="col s6">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s6">
                                <label style="color: #000000; font-size: 15px;">Unit Code:</label>
                            </div>
                            <div class="col s6">
                                <label style="color: #000000; font-size: 15px;"><u>Unit No. E2</u></label>
                            </div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="row">
                            <div class="col s6 offset-s1">
                                <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ returnDeceasedTransaction.transactionDeceased.intTransactionDeceasedId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s6 offset-s1">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ returnDeceasedTransaction.transactionDeceased.created_at | amDateFormat:'dddd, MMMM Do YYYY'}}</u></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="border: 1px solid #7b7073; margin-left: 30px; margin-right: 30px;">
                    <div class="row" style="margin-top: -10px;">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">Date to Return:</label>
                        </div>
                        <div class="input-field col s3">
                            <label><u>@{{ returnDeceasedTransaction.returnDate.date | amDateFormat : "MMM D, YYYY" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">Deceased Name:</label>
                        </div>
                        <div class="input-field col s3">
                            <label><u>@{{ returnDeceasedTransaction.deceased.strLastName+', '+returnDeceasedTransaction.deceased.strFirstName+' '+returnDeceasedTransaction.deceased.strMiddleName }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">Penalty Fee:</label>
                        </div>
                        <div class="input-field col s3">
                            <label ng-if="returnDeceasedTransaction.penalty == null"><u>@{{ 0 | currency: "P" }}</u></label>
                            <label ng-if="returnDeceasedTransaction.penalty != null"><u>@{{ returnDeceasedTransaction.penalty.deciBusinessDependencyValue | currency: "P" }}</u></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">Amount Paid:</label>
                        </div>
                        <div class="input-field col s3">
                            <label>@{{ returnDeceasedTransaction.transactionDeceased.deciAmountPaid | currency: "P" }}</label>
                        </div>
                    </div><br>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 0px;">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">Change:</label>
                        </div>
                        <div class="input-field col s3">
                            <label ng-if="returnDeceasedTransaction.penalty != null" style="color: red"><u>@{{ returnDeceasedTransaction.transactionDeceased.deciAmountPaid - returnDeceasedTransaction.penalty.deciBusinessDependencyValue | currency: "P" }}</u></label>
                            <label ng-if="returnDeceasedTransaction.penalty == null" style="color: red"><u>@{{ 0 | currency: "P" }}</u></label>
                        </div><br><br>
                    </div>
                </div>

                <!--
                <div class="row" style="margin-top: -20px;">
                    <div class="col s6" style="border: 3px solid #7b7073;"><br>
                        <center><h6>Returned Deceased Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Date to Return:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ returnDeceasedTransaction.returnDate.date | amDateFormat : "MMM D, YYYY" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Date Returned:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ returnDeceasedTransaction.transactionDeceased.created_at | amDateFormat : "MMM D, YYYY" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Deceased Name:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>@{{ returnDeceasedTransaction.deceased.strLastName+', '+returnDeceasedTransaction.deceased.strFirstName+' '+returnDeceasedTransaction.deceased.strMiddleName }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -1px;">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Storage Type:</label>
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
                                <label style="color: #000000;">Penalty Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label ng-if="returnDeceasedTransaction.penalty == null"><u>@{{ 0 | currency: "P" }}</u></label>
                                <label ng-if="returnDeceasedTransaction.penalty != null"><u>@{{ returnDeceasedTransaction.penalty.deciBusinessDependencyValue | currency: "P" }}</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Amount Paid:</label>
                            </div>
                            <div class="input-field col s5">
                                <label>@{{ returnDeceasedTransaction.transactionDeceased.deciAmountPaid | currency: "P" }}</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label style="color: #000000;">Change:</label>
                            </div>
                            <div class="input-field col s5">
                                <label ng-if="returnDeceasedTransaction.penalty != null" style="color: red"><u>@{{ returnDeceasedTransaction.transactionDeceased.deciAmountPaid - returnDeceasedTransaction.penalty.deciBusinessDependencyValue | currency: "P" }}</u></label>
                                <label ng-if="returnDeceasedTransaction.penalty == null" style="color: red"><u>@{{ 0 | currency: "P" }}</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
                </div>
                -->
                <br><br><br><br>
            </div>
            <div class="modal-footer">
                <button ng-click="generateReceipt(returnDeceasedTransaction.transactionDeceased.intTransactionDeceasedId)" name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
            </div>
        </div>
        <!-- Return Deceased -->