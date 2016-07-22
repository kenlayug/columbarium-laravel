<!-- Collection for Payment Modal-->
<div id="collectionForm" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow-y: hidden">

    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont">Collection: @{{ customer.strFullName }}</h4>
        </center>
    </div>

    <div class="modal-content" style="overflow-y: auto">
        <div class="row">
            <div class = "col s12 card material-table" style = "padding-left: 20px; margin-top: -5px; text-align: left">
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
                        <th>
                            <a ng-click="openPayCollection(payment, $index)"
                               ng-hide="payment.boolPaid == 1"
                               data-target="pay" class="waves-light btn light-green btn modal-trigger" href="#pay" style = "color: #000000;">Pay</a>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
    </div>
    <div class="modal-footer">
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000; margin-right: 10px;">Cancel</a>
    </div>
</div>