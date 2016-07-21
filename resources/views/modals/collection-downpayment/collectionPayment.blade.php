<div id="pay" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow-y: hidden">
    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont">Pay Collection</h4>
        </center>
    </div>
    <div class="modal-content">
        <div class="row">
            <div class="col s6" style="border: 3px solid #7b7073;">
                <div class="row"><br>
                    <i class="left" style="margin-left: 10px">Date:</i> <i><u>09/12/16<u></i><br><br>
                    <i class="left" style="margin-left: 10px">Collection Date:</i><i><u>09/13/16<u></i><br><br>
                    <i class="left" style="margin-left: 10px">Monthly Amortization:</i><i><u>P 4,000.00<u></i><br><br>
                    <i class="left" style="margin-left: 10px">Penalty:</i><i><u>P 2,000.00<u></i><br><br>
                    <i class="left" style="margin-left: 10px">Months To Pay:</i><i><u>4 month(s)<u></i><br>
                </div>
            </div>
            <div class="col s6">
                <div class="row">
                    <div class="input-field col s12">
                        <select ng-model="collectionPayment.intPaymentType" required>
                            <option value="" disabled selected>Mode of Payment<span>*</span></option>
                            <option value="1">Cash</option>
                            <option value="2">Cheque</option>
                        </select>
                    </div>

                    <div ng-hide="collectionPayment.intPaymentType != 2" class="input-field col s12">
                        <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                    </div>

                    <div class="input-field col s12">
                        <input ng-model="collectionPayment.deciAmount" id="cAmount" type="number" required="" aria-required="true" class="validate">
                        <label for="cAmount">Amount Paid<span style = "color: red;">*</span></label>
                    </div>
                </div><br>
                <i class="left" style="margin-left: 10px">Balance:</i> <i><u>P 54,000.00<u></i><br>
                <i class="left" style="color: red; margin-left: 10px;">*Required Fields</i>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left:10px; margin-right: 10px;">Submit</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>