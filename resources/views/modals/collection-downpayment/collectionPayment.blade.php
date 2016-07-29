<div id="pay" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow-y: hidden">
    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont">Pay Collection</h4>
        </center>
    </div>
    <form ng-submit="processCollection()" novalidate>
        <div class="modal-content">
            <div class="row">
                <div class="col s6" style="border: 3px solid #7b7073;">
                    <div class="row"><br>
                        <i class="left" style="margin-left: 10px">Date:</i> <i><u>@{{ collectionToPay.dateNow | amDateFormat : 'dddd, MMMM D, YYYY' }}<u></i><br><br>
                        
                        <i class="left" style="margin-left: 10px">Balance:</i><i><u>P 9,000.00<u></i><br><br>

                        <i class="left" style="margin-left: 10px">Penalty:</i><i><u>P 90.00<u></i><br><br>

                        <i class="left" style="margin-left: 10px">Monthly Amortization:</i><i><u>@{{ collectionToPay.deciMonthlyAmortization | currency : "P" }}<u></i><br><br>

                        <i class="left" style="margin-left: 10px">Total Amount to Pay:</i><i><u>P 9,090.00<u></i><br><br>

                        <!--
                        <i class="left" style="margin-left: 10px">Collection Date:</i><i><u>@{{ collectionToPay.dateCollectionDay | amDateFormat : 'dddd, MMMM D, YYYY' }}<u></i><br><br>

                        <i class="left" style="margin-left: 10px">Penalty:</i><i><u>@{{ collectionToPay.penalty | currency : "P" }}<u></i><br><br>
                        -->
                    </div>
                </div>
                <div class="col s6">
                    <div class="row">
                        <div class="input-field col s12">
                            <select ng-model="collectionToPay.intPaymentType" required>
                                <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                            </select>
                        </div>

                        <div ng-hide="collectionToPay.intPaymentType != 2" class="input-field col s12">
                            <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                        </div>

                        <!--
                        <div class="input-field col s12">
                            <i class="left">Amount To Pay:</i> <i><u>@{{ collectionToPay.deciMonthlyAmortization + collectionToPay.penalty | currency : "P" }}</u></i><br>
                        </div>
                        -->

                        <div class="input-field col s12">
                            <input ng-model="collectionToPay.deciAmountPaid"
                                   ui-number-mask="2"
                                   id="cAmount" type="text" required="" aria-required="true" class="validate">
                            <label for="cAmount">Amount Paid<span style = "color: red;">*</span></label>
                        </div>
                    </div><br>
                    <i class="left" style="color: red; margin-left: 10px;">*Required Fields</i>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left:10px; margin-right: 10px;">Submit</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>