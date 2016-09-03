        <!-- Add Deceased -->
        <div id="successSafeBox" class="modal modal-fixed-footer" style="overflow-y: hidden;">
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
                        <h6>(Retrieve Deceased Receipt)</h6>
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
                                <label style="color: #000000; font-size: 15px;">Deceased Name:</label>
                            </div>
                            <div class="col s6">
                                <label style="color: #000000; font-size: 15px;"><u>Kahit, Sino Na</u></label>
                            </div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="row">
                            <div class="col s6 offset-s1">
                                <label style="color: #000000; font-size: 15px;">Transaction Id:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.transactionDeceased.intTransactionDeceasedId }}</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s6 offset-s1">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s5">
                                <label style="color: #000000; font-size: 15px;"><u>@{{ transaction.transactionDeceased.created_at | amDateFormat:'dddd, MMMM D, YYYY'}}</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-right: 30px; margin-left: 30px; border: 1px solid #7b7073;"><br>
                    <div class="row" style="margin-top: -10px;">
                        <div class="col s3 offset-s2">
                            <label style="color: #000000; font-size: 15px;">Retrieval Fee:</label>
                        </div>
                        <div class="col s4 offset-s3">
                            <label style="color: #000000; font-size: 15px;"><u>P 3,500.00</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px;">
                        <div class="col s3 offset-s2">
                            <label style="color: #000000; font-size: 15px;">Amount Paid:</label>
                        </div>
                        <div class="col s4 offset-s3">
                            <label style="color: #000000; font-size: 15px;"><u>P 3,500.00</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px; border-top: 1px solid #7b7073;"><br>
                        <div class="col s3 offset-s2">
                            <label style="color: #000000; font-size: 15px;">Change:</label>
                        </div>
                        <div class="col s4 offset-s3">
                            <label style="color: #000000; font-size: 15px;"><u>P 0.00</u></label>
                        </div>
                    </div>
                </div><br><br><br>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
            </div>
        </div>
        <!-- Added Deceased -->



                