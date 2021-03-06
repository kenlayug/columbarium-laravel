<!-- Downpayment Modal-->
<div id="downPaymentForm" class="modal modal-fixed-footer" style="width: 95%; max-height: 120%; overflow-y: hidden; overflow-x: hidden;">

    <div class="modal-header" style="background-color: #00897b;">
        <center>
            <h4 style = "font-size: 20px; color: white; padding: 20px; margin-top: 0px;">Downpayment: @{{ customer.strFullName }}</h4>
        </center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <form ng-submit="processDownpayment(downpayment.intDownpaymentId, dowpayment.index)" novalidate autocomplete="off">
        <div class="modal-content" style="overflow-y: auto;">
            <br>
            <div class="row">
                <div class = "col s9 card material-table" style = "padding-left: 20px; margin-top: -5px; text-align: left">
                    <table id="datatable-downpaymentForm" datatable="ng">
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
                
                    <div class="row" style="margin-left: 15px;">
                        <i class="left" style="font-size: 16px;">Balance:<i><u> @{{ downpayment.detail.deciBalance | currency: "₱" }}</u></i>
                    </div>

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
