        <!-- Retrieve Deceased -->
        <div id="retrieve" class="modal modal-fixed-footer" style="width: 95%; max-height: 120%; overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px;">
                <center><h4 style = "font-size: 20px;font-family: myFirstFont2; color: white; padding: 20px;">Retrieve Deceased</h4></center>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
            </div>
            <div class="modal-content" style="overflow-y: auto;">
                <div class="row" style="margin-top: -30px;">
                    <div class="input-field col s6">
                        <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                        <label for="cname" data-error="No Existing Customer Found!">Customer Name<span style = "color: red;">*</span></label>
                    </div>
                    <datalist id="nameList">
                        <option value="Monkey D. Luffy">
                        <option value="Roronoa Zoro">
                        <option value="Vinsmoke Sanji">
                        <option value="Tony Tony Chopper">
                        <option value="Nico Robin">
                    </datalist>

                    <div class="col s2">
                        <a data-target="newCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer" href="#newCustomer" style="color: #000000; margin-top: 15px; margin-left: -15px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>
                        <!--
                        <a data-target="updateCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Customer Details" href="#updateCustomer" style="color: #000000;width: 100px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>
                                    -->
                    </div>
                    <div class="col s4">
                        <a class="right waves-light btn light-green modal-trigger" style="color: #000000; margin-top: 15px; margin-right: 15px;" data-target="requirements" href="#requirements">View Requirements</a>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col s3">
                        <label style="color: #000000; font-size: 15px;">Deceased Name:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;">Protacio Sangkatakutan</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s3">
                        <label style="color: #000000; font-size: 15px;">Retrieval Fee:</label>
                    </div>
                    <div class="col s9">
                        <label style="color: #000000; font-size: 15px;">P 5,000.00</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <select ng-model="addDeceased.intPaymentType" required material-select>
                            <option value="" disabled selected>Mode of Payment<span>*</span></option>
                            <option value="1">Cash</option>
                            <option value="2">Cheque</option>
                        </select>
                    </div>
                    <div class="input-field col s2">
                        <label>Amount Paid:<span style="color: red">*</span></label>
                    </div>
                    <div class="input-field col s4">
                        <input id="paid" type="number">
                    </div>
                </div>
                <div class="row" style="margin-top: -40px;">
                    <div class="input-field col s4">
                        <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                    </div>
                </div>

                <br><br>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Submit</button>
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </div>
        <!-- Retrieve Deceased -->