<div id="receipt" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0;">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Generated Receipt</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
        <!--
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Success! your transaction is successfully processed.</h4></center>
        -->
    </div>
    <div class="modal-content" style="overflow-y: auto;">
        <div class="row">
            <div class="col s3 offset-s9">
                <label style="color: #000000; font-size: 15px; margin-top: -8px;" ng-show="lastTransaction.intTransactionType == 2">Transaction Code: @{{ lastTransaction.reservation.intReservationId }}</label>
                <label style="color: #000000; font-size: 15px; margin-top: -8px;" ng-show="lastTransaction.intTransactionType == 1">Transaction Code: @{{ lastTransaction.buy-unit.intBuyUnitId }}</label>
                <label style="color: #000000; font-size: 15px; margin-top: -8px;" ng-show="lastTransaction.intTransactionType == 3">Transaction Code: @{{ lastTransaction.atNeed.intAtNeedId }}</label>
            </div>
            <div class="col s3 offset-s9">
                <label style="color: #000000; font-size: 15px; margin-top: -8px;" ng-show="lastTransaction.intTransactionType == 1">Date: @{{ lastTransaction.buy-unit.created_at }}</label>
                <label style="color: #000000; font-size: 15px; margin-top: -8px;" ng-show="lastTransaction.intTransactionType == 2">Date: @{{ lastTransaction.reservation.created_at }}</label>
                <label style="color: #000000; font-size: 15px; margin-top: -8px;" ng-show="lastTransaction.intTransactionType == 3">Date: @{{ lastTransaction.atNeed.created_at }}</label>
            </div>
        </div>
        <label style="color: #000000; font-size: 16px; margin-top: -8px;">Customer Name: @{{ lastTransaction.customer }}</label>
        <div class="row">
            <div id="firstTable" class="col s4" style="border: 3px solid #7b7073;"><br>
                <center>
                    <h6>Transaction Details: </h6>
                </center>
                {{-- 1st table --}}
                {{-- for reservation --}}
                <div id="forReservation"
                     ng-show="lastTransaction.intTransactionType == 2">
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Reservation Fee:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ reservationFee.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>No. Of Units:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.cart.length }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Total Reservation Fee:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.cart.length * reservationFee.deciBusinessDependencyValue | currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                {{-- end for reservation --}}

                {{-- for pay once --}}
                <div ng-show="lastTransaction.intTransactionType == 1">
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Unit Price(without discount):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.reservation.totalUnitPrice|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Perpetual Care Fund(percentage):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ (pcf.deciBusinessDependencyValue*100).toFixed(2) }}%</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Perpetual Care Fund(amount):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.reservation.totalUnitPrice * pcf.deciBusinessDependencyValue |currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                {{-- end pay once --}}

                {{-- for at need --}}

                <div ng-show="lastTransaction.intTransactionType == 3">
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Unit Price:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.reservation.totalUnitPrice|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Perpetual Care Fund(percentage):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ (pcf.deciBusinessDependencyValue*100).toFixed(2) }}%</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Perpetual Care Fund(amount):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.reservation.totalUnitPrice * pcf.deciBusinessDependencyValue |currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>

                {{-- end at need --}}

            </div>
            {{-- end first table --}}

            {{-- second table --}}
            <div class="col s4" style="border: 3px solid #7b7073;"><br>
                <center><h6>Amount To Pay Details: </h6></center>

                {{-- for reservation --}}
                <div ng-show="lastTransaction.intTransactionType == 2">
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Unit Price:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.totalAmountToPay|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Reservation Fee:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.cart.length * reservationFee.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Total Amount To Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.totalAmountToPay + (lastTransaction.cart.length * reservationFee.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                {{-- end reservation --}}

                {{-- for pay once --}}
                <div ng-show="lastTransaction.intTransactionType == 1">
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Unit Price(with discount):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.reservation.totalUnitPrice - (lastTransaction.reservation.totalUnitPrice * discountPayOnce.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Perpetual Care Fund:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.reservation.totalUnitPrice * pcf.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Total Amount To Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ (lastTransaction.reservation.totalUnitPrice-(lastTransaction.reservation.totalUnitPrice * discountPayOnce.deciBusinessDependencyValue)) +  (lastTransaction.reservation.totalUnitPrice * pcf.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                {{-- end pay once --}}

                {{-- for at need --}}

                <div ng-show="lastTransaction.intTransactionType == 3">
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Unit Price:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.totalAmountToPay|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Perpetual Care Fund:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.reservation.totalUnitPrice * pcf.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Total Amount To Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.totalAmountToPay + (lastTransaction.reservation.totalUnitPrice * pcf.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>

                {{-- end at need --}}

            </div>
            {{-- end second table --}}

            {{-- third table --}}
            <div class="col s4" style="border: 3px solid #7b7073;"><br>
                <center><h6>Payment Details: </h6></center>

                {{-- for reservation --}}
                <div ng-show="lastTransaction.intTransactionType == 2">
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.totalAmountToPay + (lastTransaction.cart.length * reservationFee.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.cart.length * reservationFee.deciBusinessDependencyValue|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Balance:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u style="color: red">@{{ (lastTransaction.totalAmountToPay + (lastTransaction.cart.length * reservationFee.deciBusinessDependencyValue)) - (lastTransaction.cart.length * reservationFee.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                {{-- end reservation --}}

                {{-- for pay once --}}
                <div ng-show="lastTransaction.intTransactionType == 1">
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.reservation.deciAmountPaid|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ (lastTransaction.reservation.totalUnitPrice - (lastTransaction.reservation.totalUnitPrice * discountPayOnce.deciBusinessDependencyValue)) + (lastTransaction.reservation.totalUnitPrice * pcf.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u style="color: red">@{{ lastTransaction.reservation.deciAmountPaid-((lastTransaction.reservation.totalUnitPrice - (lastTransaction.reservation.totalUnitPrice * discountPayOnce.deciBusinessDependencyValue)) + (lastTransaction.reservation.totalUnitPrice * pcf.deciBusinessDependencyValue))|currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                {{-- end pay once --}}

                {{-- for at need --}}

                <div ng-show="lastTransaction.intTransactionType == 3">
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.reservation.totalUnitPrice * pcf.deciBusinessDependencyValue|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.reservation.deciAmountPaid|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u style="color: red">@{{ lastTransaction.reservation.deciAmountPaid-(lastTransaction.reservation.totalUnitPrice * pcf.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>

                {{-- end at need --}}

            </div>
            {{-- end third table --}}

        </div>

        <div class="row">
            <center><label style="color: #000000; font-size: 15px;">Unit Details:</label></center>
        </div>
        <div class="row">
            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px; margin-top: -15px;">
                <table id="datatable1" datatable="ng">
                    <thead>
                        <tr>
                            <th>Unit Code</th>
                            <th>Level</th>
                            <th>Column</th>
                            <th>Unit Price</th>
                            <th ng-show="lastTransaction.intTransactionType == 1">Discounted Price</th>
                            <th ng-show="lastTransaction.intTransactionType > 1">Years to Pay</th>
                            <th ng-show="lastTransaction.intTransactionType > 1" id="interest">Monthly</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="unit in lastTransaction.cart">
                            <td>Unit No. @{{ unit.intUnitId }}</td>
                            <td>@{{ unit.intLevelNo }}</td>
                            <td>@{{ unit.intColumnNo }}</td>
                            <td>@{{ unit.unitPrice.deciPrice|currency:"₱" }}</td>
                            <td ng-show="lastTransaction.intTransactionType == 1">@{{ unit.unitPrice.deciPrice - (unit.unitPrice.deciPrice * discountPayOnce.deciBusinessDependencyValue) | currency:"₱" }}</td>
                            <td ng-show="lastTransaction.intTransactionType > 1">@{{ unit.interest.intNoOfYear }}</td>
                            <td ng-show="lastTransaction.intTransactionType > 1">@{{ unit.monthly|currency:"₱" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
    </div>
    <div class="modal-footer">
        <button ng-click="generateReceipt(lastTransaction.reservation.intReservationId)"
                name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
    </div>
</div>