        <!-- Retrieve Deceased -->
        <div id="retrieve" class="modal modal-fixed-footer" style="overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px;">
                <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Retrieve Deceased</h4></center>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
            </div>
            <form autocomplete="off" ng-submit="processRetrieveDeceased()">
                <div class="modal-content" style="overflow-y: auto;"><br>
                    <div class="row" style="margin-top: -30px;">
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;">@{{ retrieveDeceased.strCustomerName }}</label>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Deceased Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;">@{{ retrieveDeceased.strDeceasedLast+', '+retrieveDeceased.strDeceasedFirst+' '+retrieveDeceased.strDeceasedLast }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Retrieval Fee:</label>
                        </div>
                        <div class="col s9">
                            <label style="color: #000000; font-size: 15px;">@{{ retrieveService.deciBusinessDependencyValue | currency : "P" }}</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s3">
                            <select ng-model="retrieveDeceased.intPaymentType" required material-select>
                                <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                            </select>
                        </div>
                        <div class="input-field col s4">
                            <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                        </div>
                        <div class="input-field col s2">
                            <label style="color: #000000;">Amount Paid:<span style="color: red">*</span></label>
                        </div>
                        <div class="input-field col s3">
                            <input ng-model="retrieveDeceased.deciAmountPaid"
                                ui-number-mask
                                id="paid" type="text">
                        </div>
                    </div>
                    <br><br>
                </div>
                <div class="modal-footer">
                    <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Submit</button>
                    <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
                </div>
            </form>
        </div>
        <!-- Retrieve Deceased -->