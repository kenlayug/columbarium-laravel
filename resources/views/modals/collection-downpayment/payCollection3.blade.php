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
                        <th></th>
                        <th>Due Date</th>
                        <th>Transaction Date</th>
                        <th>Penalty</th>
                        <th>Payment</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="payment in paymentList">
                        <td>
                            <p>
                                <input type="checkbox" class="filled-in" id="@{{ payment.dateCollectionDay }}" value="1" />
                                <label for="@{{ payment.dateCollectionDay }}"></label>
                            </p>
                        </td>
                        <td>@{{ payment.dateCollectionDay }}</td>
                        <td>@{{ payment.datePayment }}</td>
                        <td>@{{ payment.penalty | currency: "₱" }}</td>
                        <td>@{{ payment.deciMonthlyAmortization | currency: "₱" }}</td>
                        <td>
                            <i ng-show="payment.boolPaid == 1" class="material-icons">done</i>
                            <label ng-show="payment.boolPaid == 0" style="font-size: 25px;">&#10006;</label>
                            <i ng-show="payment.boolPaid == 2" class="material-icons">error</i>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
    </div>
    <div class="modal-footer">

        <button data-target="pay" class="waves-light btn light-green modal-trigger" href="#pay" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Pay</button>

        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000; margin-right: 10px;">Cancel</a>
    </div>
</div>