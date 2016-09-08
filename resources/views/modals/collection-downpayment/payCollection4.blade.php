<!-- Collection for Payment Modal-->
<div id="collectionForm" class="modal modal-fixed-footer" style="width: 95%; max-height: 120%; overflow-y: hidden">

    <div class="modal-header" style="background-color: #00897b;">
        <center>
            <h4 style = "font-size: 20px; color: white; padding: 20px; font-family: myFirstFont2">Collection: @{{ customer.strFullName }}</h4>
        </center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    
    </div>

    <div class="modal-content" style="overflow-y: auto">
        <div class="row">
            <div class = "col s12 card material-table" style = "padding-left: 20px; margin-top: -5px; text-align: left">
                <table id="datatable-showCollection" datatable="ng">
                    <thead>
                    <tr>
                        <td style='width: 10%;'>
                            <p ng-hide='payment.boolPaid == 1'>
                                <input ng-click='toggleAll(toggle)' ng-model='toggle' type="checkbox" class="filled-in" id="toggleAll" value="1" />
                                <label for="toggleAll"></label>
                            </p>
                        </td>
                        <th>Due Date</th>
                        <th>Transaction Date</th>
                        <th>Penalty</th>
                        <th>Payment</th>
                        <th style='width: 10%;'>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="payment in paymentList">
                        <td>
                            <p ng-hide='payment.boolPaid == 1'>
                                <input ng-model='payment.selected' type="checkbox" class="filled-in" id="@{{ payment.dateCollectionDay }}" value="1" />
                                <label for="@{{ payment.dateCollectionDay }}"></label>
                            </p>
                        </td>
                        <td>@{{ payment.dateCollectionDay | amDateFormat : "MMM D, YYYY" }}</td>
                        <td>@{{ payment.datePayment | amDateFormat : "MMM D, YYYY"}}</td>
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
        <label style="color: #00897b; font-size: 20px; margin-left: 15px;">LEGEND:</label>
        
        <label style="font-size: 15px; color: #000000; font-size: 18px; margin-left: 15px;"><i class="material-icons" style="margin-top: 10px;">done</i> =  Paid</label>
        <label style="font-size: 15px; color: #000000; font-size: 18px; margin-left: 15px;">X =  Unpaid</label>
        <label style="font-size: 15px; color: #000000; font-size: 18px; margin-left: 15px;"><i class="material-icons">error</i> =  Past Due</label>

        <button ng-click='openPayCollection()' data-target='pay' class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Pay</button>

        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000; margin-right: 10px;">Cancel</a>
    </div>
</div>