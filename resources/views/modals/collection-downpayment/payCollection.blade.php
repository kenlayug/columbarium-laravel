<!-- Collection for Payment Modal-->
<div id="collectionForm" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow-y: hidden">

    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont">Collection: @{{ customer.strFullName }}</h4>
        </center>
    </div>

    <div class="modal-content" style="overflow-y: auto">
        <br>
        <div class="row">
            <div class = "col s9 card material-table" style = "padding-left: 20px; margin-top: -5px; text-align: left">
                <table id="datatable5" datatable="ng">
                    <thead>
                    <tr>
                        <th>Due Date</th>
                        <th>Transaction Date</th>
                        <th>Penalty</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="payment in paymentList">
                        <th>@{{ payment.dateCollectionDay }}</th>
                        <th>@{{ payment.datePayment }}</th>
                        <th>@{{ payment.penalty | currency: "₱" }}</th>
                        <th>@{{ payment.deciMonthlyAmortization | currency: "₱" }}</th>
                        <th>
                            <i ng-show="payment.boolPaid == 1" class="material-icons">done</i>
                            <label ng-show="payment.boolPaid == 0" style="font-size: 25px;">&#10006;</label>
                            <i ng-show="payment.boolPaid == 2" class="material-icons">error</i>
                        </th>
                        <th><button ng-hide="payment.boolPaid == 1" name = "action" class="waves-light btn light-green" style = "color: #000000;">Pay</button></th>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col s3">
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
                </div>
            </div>
            <i class="left" style="margin-left: 10px">Balance:</i> <i><u>P 54,000.00<u></i><br>
            <i class="left" style="color: red; margin-left: 10px;">*Required Fields</i>
        </div>
        <br><br><br>
    </div>

    <div class="modal-footer">
        {{--<button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left:10px; margin-right: 10px;">Submit</button>--}}
        {{--<a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>--}}
    </div>
</div>