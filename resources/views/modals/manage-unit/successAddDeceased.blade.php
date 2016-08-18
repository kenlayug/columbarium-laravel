        <!-- Add Deceased -->
        <div id="successAddDeceased" class="modal modal-fixed-footer" style="overflow-y: hidden;">
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
                        <h6>(Added Deceased Receipt)</h6>
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
                                <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ transaction.lastTransaction.intTransactionDeceasedId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s6 offset-s1">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.lastTransaction.created_at | amDateFormat:'dddd, MMMM Do YYYY'}}</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row" style="border: 1px solid #7b7073; margin-left: 30px; margin-right: 30px;"><br>
                    <div class="row" style="margin-top: -10px;">
                        <div class="col s4 offset-s2">
                            <label style="color: #000000; font-size: 15px;">Deceased Name:</label>
                        </div>                            <div class="col s3">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.deceased.strLastName+', '+transaction.deceased.strFirstName+' '+transaction.deceased.strMiddleName }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px;">
                        <div class="col s4 offset-s2">
                            <label style="color: #000000; font-size: 15px;">Storage Type:</label>
                        </div>
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.storageType.strStorageTypeName }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px;">
                        <div class="col s4 offset-s2">
                            <label style="color: #000000; font-size: 15px;">Service:</label>
                        </div>
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.service.strServiceName }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px;">
                        <div class="col s4 offset-s2">
                            <label style="color: #000000; font-size: 15px;">Service Fee:</label>
                        </div>
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.service.price.deciPrice | currency : "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px;">
                        <div class="col s4 offset-s2">
                            <label style="color: #000000; font-size: 15px;">Amount Paid:</label>
                        </div>
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.lastTransaction.deciAmountPaid | currency : "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073;"><br>
                        <div class="col s4 offset-s2">
                            <label style="color: #000000; font-size: 15px;">Change:</label>
                        </div>
                        <div class="col s3">
                            <label style="color: #red; font-size: 15px;"><u>@{{ transaction.lastTransaction.deciAmountPaid - transaction.service.price.deciPrice | currency : "₱" }}</u></label>
                        </div><br>
                    </div>
                    <!--
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
                    </div>
                    -->
                </div><br><br><br><br>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
            </div>
        </div>
        <!-- Added Deceased -->



                