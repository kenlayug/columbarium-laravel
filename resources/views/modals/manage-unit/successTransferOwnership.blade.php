        <!-- Transfer Ownership-->
        <div id="successTransferOwnership" class="modal modal-fixed-footer" style="overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px">
                <center><h4 style = "font-size: 20px;font-family: myFirstFont2; color: white; padding: 20px;">Generated Receipt</h4></center>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
            </div>
            <div class="modal-content" style="overflow-y: auto;">
                <div class="row">
                    <center>
                        <h5>Columbarium and Crematorium Management System</h5>
                        <h6>La Loma Catholic Cemetery Compound C3 Road Caloocan City</h6>
                        <h6>(Transfered Ownership Receipt)</h6>
                    </center>
                </div><br>
                <div class="row">
                    <div class="col s6" style="margin-left: -15px;">
                        <div class="row">
                            <div class="col s7">
                                <label style="color: #000000; font-size: 15px;">Unit Code:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>Unit No. @{{ unit.intUnitId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s7">
                                <label style="color: #000000; font-size: 15px;">Owner Name:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transferOwnershipTransaction.prevOwner.strLastName+', '+transferOwnershipTransaction.prevOwner.strFirstName+' '+transferOwnershipTransaction.prevOwner.strMiddleName }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s7">
                                <label style="color: #000000; font-size: 15px;">New Owner Name:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transferOwnershipTransaction.newOwner.strLastName+', '+transferOwnershipTransaction.newOwner.strFirstName+' '+transferOwnershipTransaction.newOwner.strMiddleName }}</u></label>
                            </div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="row">
                            <div class="col s6 offset-s1">
                                <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ transferOwnershipTransaction.transactionOwnership.intTransactionOwnershipId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s6 offset-s1">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transferOwnershipTransaction.transactionOwnership.created_at | amDateFormat:'dddd, MMMM Do YYYY' }}</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="border: 1px solid #7b7073; margin-left: 30px; margin-right: 30px;">
                    <div class="row">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">Service:</label>
                        </div>
                        <div class="input-field col s6">
                            <label><u>Transfer Deceased Service</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">Service Fee:</label>
                        </div>
                        <div class="input-field col s6">
                            <label><u>@{{ transferOwnerCharge.deciBusinessDependencyValue | currency: "P" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">Amount Paid:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ transferOwnershipTransaction.transactionOwnership.deciAmountPaid | currency: "P" }}</label>
                        </div>
                    </div><br><br>
                    <div class="row" style="border-top: 1px solid #7b7073;">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">Change:</label>
                        </div>
                        <div class="input-field col s6">
                            <label style="color: red"><u>@{{ transferOwnershipTransaction.transactionOwnership.deciAmountPaid - transferOwnerCharge.deciBusinessDependencyValue | currency: "P" }}</u></label>
                        </div><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <center><label style="color: #000000; font-size: 15px;">Unit Details:</label></center>
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
                </div><br><br>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
            </div>
        </div>
        <!-- Transfer Ownership -->


