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


