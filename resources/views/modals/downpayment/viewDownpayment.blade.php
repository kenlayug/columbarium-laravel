<div id="modalViewDownpayments" class="modal modal-fixed-footer" style="overflow: hidden; width: 75% !important ; max-height: 100% !important">
    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont">Collection: @{{ customer.strFullName }}</h4>
        </center>
    </div>
    <div class="modal-content" id="collect">

        <!-- Collection Form -->
        <div id="payment">
            <form ng-submit="processPayment(reservation.intReservationDetailId, reservation.index)">
                <!-- Collection Info -->
                <div class="row" style="text-align: left;">
                    <div class = "col s9" style = "padding-left: 20px; margin-top: 10px; text-align: left">
                        <div class="card material-table">
                            <table id="datatable2">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Transaction Code</th>
                                    <th>Payment</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="downpayment in downpaymentList">
                                    <th>@{{ downpayment.created_at }}</th>
                                    <th>Downpayment @{{ downpayment.intDownpaymentId }}</th>
                                    <th>@{{ downpayment.deciAmount|currency: "₱" }}</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <i class = "left" style="margin-left: 10px; font-size: medium">Downpayment Balance: <span style = " color: red;">@{{ reservation.balance|currency: "₱" }}</span></i>
                    </div>
                    <div class="col s3">
                        <div class="row">
                            <div class="input-field col s12">
                                <select ng-model="newPayment.intPaymentType" required>
                                    <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                    <option value="1">Cash</option>
                                    <option value="2">Cheque</option>
                                </select>
                            </div>
                            <div class="input-field col s12">
                                <input id="dChequeNumber" type="text" disabled>
                                <label for="dChequeNumber">Cheque Account Number<span style = "color: red;">*</span></label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="newPayment.deciAmount" id="dAmount" type="number" required="" aria-required="true" class="validate">
                                <label for="dAmount">Amount to pay<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="systemName">Columbarium and Crematory Management System<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;">Submit</button>
        <a name = "action" class="wav  es-light btn light-green modal-close" style = "color: #000000; margin-right: 10px">Cancel</a>
    </div>
    </form>
</div>