<div id="pay" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow-y: hidden">
    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont">Pay Collection</h4>
        </center>
    </div>
    <form ng-submit="processCollection()" novalidate autocomplete="off">
        <div class="modal-content" style="overflow-y: auto;">
            <div class="row">
                <div class="col s8" >
                    <table style="table-layout: fixed; margin-bottom: 15px;">
                        <thead>
                            <tr>
                                <th><center>Due Date</center></th>
                                <th><center>Penalty</center></th>
                                <th><center>Payment</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="payment in collectionListToPay">
                                <td><center>@{{ payment.dateCollectionDay }}</center></td>
                                <td><center>@{{ payment.penalty | currency: "₱" }}</center></td>
                                <td><center>@{{ payment.deciMonthlyAmortization | currency: "₱" }}</center></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s4" style="border: 2px solid #7b7073;"><br>
                    <div class="row">
                        <center>
                            <h6>Payment Details</h6>
                        </center>
                    </div>

                    <div class="row" style="margin-left: -10px;">
                        <div class="col s7">
                            <label style="color: #000000; font-size: 15px;">Total Amount to Pay:</label>
                        </div>
                        <div class="col s5">
                            <label style="color: red; font-size: 15px;"><u>@{{ deciTotalAmountToPay | currency : 'P' }}</u></label>
                        </div>
                    </div>

                    <div class="row">
                        <select ng-model="collectionTransaction.intPaymentType" required>
                            <option value="" disabled selected>Mode of Payment<span>*</span></option>
                            <option value="1">Cash</option>
                            <option value="2">Cheque</option>
                        </select>
                        <div ng-hide="collectionTransaction.intPaymentType != 2" class="input-field col s12">
                            <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width:100%; color: #000000">Cheque Details</a>
                        </div>
                    </div>
                    
                    <div class="input-field row">
                        <input ng-model="collectionTransaction.deciAmountPaid"
                                ui-number-mask="2"
                               id="cAmount" type="text" required="" aria-required="true" class="validate">
                        <label for="cAmount">Amount Paid<span style = "color: red;">*</span></label>
                    </div>
                    <i class="left" style="color: red; margin-left: 10px;">*Required Fields</i><br><br>
                </div>
            </div>
            <br><br><br>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left:10px; margin-right: 10px;">Submit</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>