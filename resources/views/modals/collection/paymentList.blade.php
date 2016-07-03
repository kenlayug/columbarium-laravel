<!-- Collection of Payment Modal-->
<div id="modal2" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important ">
    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont2">Collection: Aaron Clyde Garil</h4>
        </center>
    </div>
    <div class="modal-content" id="collect">

        <!-- Collection Form -->
        <div id="payment">
            <form>
                <!-- Collection Info -->
                <div class="row" style="text-align: left;">
                    <div class = "col s12" style = "padding-left: 20px; margin-top: 10px; text-align: left">
                        <div class="card material-table">
                            <table id="datatable4" datatable="ng" dt-options="dtOptions">
                                <thead>
                                <tr>
                                    <th>Due Date</th>
                                    <th>Transaction Date</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="payment in paymentList">
                                    <td>@{{ payment.dateCollectionDay }}</td>
                                    <td>@{{ payment.datePayment }}</td>
                                    <td>@{{ payment.deciMonthlyAmortization|currency:"₱" }}</td>
                                    <td>
                                        <i ng-if="payment.boolPaid == 1" class="material-icons">done</i>
                                        <i ng-if="payment.boolPaid == 2" class="material-icons">error</i>
                                        <i ng-if="payment.boolPaid == 0" class="material-icons">not_interested</i>
                                    </td>
                                    <td><button ng-hide="payment.boolPaid != 2"
                                                ng-click="makePayment(payment.intCollectionId, payment, $index)"
                                                data-target="collection-pay" class="waves-light btn light-green modal-trigger" href="#collection-pay">Pay</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <i class = "left" style="margin-left: 10px; font-size: medium">Balance: <span style = " color: red;">P 54,000</span></i>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green modal-close" style = "color: #000000;">Cancel</button>
    </div>
</div>