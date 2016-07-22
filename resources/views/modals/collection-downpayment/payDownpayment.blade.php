<!-- Downpayment Modal-->
<div id="downPaymentForm" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow-y: hidden;">

    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont">Downpayment: @{{ customer.strFullName }}</h4>
        </center>
    </div>

    <form ng-submit="processDownpayment(downpayment.intDownpaymentId, dowpayment.index)" novalidate>
        <div class="modal-content" style="overflow-y: auto;">
            <br>
            <div class="row">
                <div class = "col s9 card material-table" style = "padding-left: 20px; margin-top: -5px; text-align: left">
                    <table id="datatable2" datatable="ng">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Transaction Code</th>
                            <th>Payment</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="payment in downpaymentPaymentList">
                            <td>@{{ payment.created_at }}</td>
                            <td>Transaction No.@{{ payment.intDownpaymentPaymentId }}</td>
                            <td>@{{ payment.deciAmountPaid | currency: "₱"}}</td>
                        </tr>
                        </tbody>
                    </table>
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

                        <div ng-show="newPayment.intPaymentType == 2"
                             class="input-field col s12">
                            <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                        </div>

                        <div class="input-field col s12">
                            <input ui-number-mask="2"
                                   ng-model="newPayment.deciAmountPaid" id="dAmount" type="text" required="" aria-required="true" class="validate">
                            <label for="dAmount">Amount Paid<span style = "color: red;">*</span></label>
                        </div>

                    </div>
                </div>
                <i class="left" style="margin-left: 10px">Balance:<i><u> @{{ downpayment.detail.deciBalance | currency: "₱" }}</u></i><br>
                <i class="left" style="color: red; margin-left: 10px;">*Required Fields</i>
            </div>
            <br><br><br>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left:10px; margin-right: 10px;">Submit</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>
