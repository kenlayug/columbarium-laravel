<!-- Mode of Payment Modal-->
<div id="collection-pay" class = "modal modal-fixed-footer" style="height: 50%">
    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont2">Collection Payment</h4>
        </center>
    </div>
    <div class="modal-content" style="margin-top: 10px;">
        <div class="row">
            <div class="col s5">
                <select ng-model="newPayment.intPaymentType" required>
                    <option value="" disabled selected>Mode of Payment<span>*</span></option>
                    <option value="1">Cash</option>
                    <option value="2">Cheque</option>
                </select>
            </div>
        </div>
        <i class = "left" style="margin-left: 10px; font-size: medium">Amount: <span style="color: green">@{{ payment.deciMonthlyAmortization|currency:"₱" }}</span></i>
    </div>
    <div class="modal-footer">
        <button ng-click="processPayment()" name = "action" class="waves-light btn light-green" style = "color: #000000;">Submit</button>
        <button name = "action" class="wav  es-light btn light-green modal-close" style = "color: #000000; margin-right: 10px">Cancel</button>
    </div>
</div>