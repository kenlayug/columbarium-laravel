        <!-- Return Deceased -->
        <div id="return" class="modal modal-fixed-footer" style="overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px;">
                <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Return Deceased</h4></center>
                <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
                style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
            </div>
            <div class="modal-content" style="overflow-y: auto;">
            <div class="row">
                <div class="col s5" style="border: 3px solid #7b7073;">
                    <div class="row">
                        <center><h6>Requirement/s:</h6></center>
                    </div>
                    <div class="row">
                        <input type="checkbox" id="deathCert"/>
                        <label for="deathCert" style="font-family: Arial">Death Certificate</label><br>
                        <input type="checkbox" id="transPer"/>
                        <label for="transPer" style="font-family: Arial">Transfer Permit</label><br>
                        <input type="checkbox" id="marrCert"/>
                        <label for="marrCert" style="font-family: Arial">Marriage Certificate</label><br>
                        <input type="checkbox" id="exPer"/>
                        <label for="exPer" style="font-family: Arial">Exhumation Permit</label><br>
                        <input type="checkbox" id="idInfo"/>
                        <label for="idInfo" style="font-family: Arial">ID of Informant</label><br>
                        <input type="checkbox" id="rePer"/>
                        <label for="rePer" style="font-family: Arial">Reburial Permit</label><br>
                    </div>
                </div>

                <div class="col s7">
                    <div class="row">
                        <div class="col s5">
                            <label style="color: #000000; font-size: 15px;">Deceased Name:</label>
                        </div>
                        <div class="col s7">
                            <label style="color: #000000; font-size: 15px;">@{{ returnDeceased.strLastName+', '+returnDeceased.strFirstName+' '+returnDeceased.strMiddleName }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <label style="color: #000000; font-size: 15px;">Returned Date:</label>
                        </div>
                        <div class="col s7">
                            <label style="color: #000000; font-size: 15px;">@{{ returnDeceased.currentDate | amDateFormat : "MMM D, YYYY" }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <label style="color: #000000; font-size: 15px;">Date to Return:</label>
                        </div>
                        <div class="col s7">
                            <label style="color: #000000; font-size: 15px;">@{{ returnDeceased.return.dateReturn | amDateFormat : "MMM D, YYYY" }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <label style="color: #000000; font-size: 15px;">Penalty Charge:</label>
                        </div>
                        <div class="col s7">
                            <label ng-show="returnDeceased.penalty" style="color: #000000; font-size: 15px;">@{{ penaltyForNotReturn.deciBusinessDependencyValue | currency: "₱" }}</label>
                            <label ng-hide="returnDeceased.penalty" style="color: #000000; font-size: 15px;">@{{ 0 | currency: "₱" }}</label>
                        </div>
                    </div>
                    <div ng-show="returnDeceased.penalty">
                        <div class="row">
                            <div class="input-field col s5">
                                <select ng-model="returnDeceased.intPaymentType" required
                                        class="browser-default">
                                    <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                    <option value="1">Cash</option>
                                    <option value="2">Cheque</option>
                                </select>
                            </div>
                            <div class="input-field col s3">
                                <label>Amount Paid:<span style="color: red">*</span></label>
                            </div>
                            <div class="input-field col s4">
                                <input ng-model="returnDeceased.deciAmountPaid"
                                       ui-number-mask="2"
                                       id="paid" type="text">
                            </div>
                        </div>
                        <div class="row" style="margin-top: -25px;">
                            <div ng-show="returnDeceased.intPaymentType == 2"
                                 class="input-field col s5">
                                <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                            </div>
                        </div>
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