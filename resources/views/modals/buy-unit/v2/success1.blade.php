<div id="receipt" class="modal modal-fixed-footer" style="width:95%; max-height: 120%; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0;">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont2; color: white; padding: 20px;">Generated Receipt</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
        
    </div>
    <div class="modal-content" style="overflow-y: auto;">
        <div class="row">
            <center>
                <h5>Columbarium and Crematorium Management System</h5>
                <h6>La Loma Catholic Cemetery Compound C3 Road Caloocan City</h6>
            </center>
        </div><br>
        <div class="row">
            <div class="col s3 offset-s9">
                <label style="color: #000000; font-size: 15px; margin-top: -8px;">Transaction Code: @{{ lastTransaction.intTransactionUnitId }}</label>
            </div>
            <div class="col s3 offset-s9">
                <label style="color: #000000; font-size: 15px; margin-top: -8px;">Date: @{{ lastTransaction.created_at | amDateFormat:'dddd, MMMM Do YYYY' }}</label>
            </div>
        </div>
        <label style="color: #000000; font-size: 16px; margin-top: -8px;">Customer Name: @{{ lastTransaction.strLastName+', '+lastTransaction.strFirstName+' '+lastTransaction.strMiddleName }}</label>
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
                            <label style="color: #000000;">Reservation Fee:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ reservationFee.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">No. Of Units:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.detailList.length }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Total Reservation Fee:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.detailList.length * reservationFee.deciBusinessDependencyValue | currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                {{-- end for reservation --}}

                {{-- for pay once --}}
                <div ng-show='lastTransaction.intTransactionType == 3'>
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Total Unit Price(without discount):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice | currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Perpetual Care Fund(percentage):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ (pcf.deciBusinessDependencyValue*100).toFixed(2) }}%</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Perpetual Care Fund(amount):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue |currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                {{-- end pay once --}}

                {{-- for at need --}}

                <div ng-show="lastTransaction.intTransactionType == 4">
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Total Unit Price:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Perpetual Care Fund(percentage):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ (pcf.deciBusinessDependencyValue*100).toFixed(2) }}%</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Perpetual Care Fund(amount):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue |currency:"₱" }}</u></label>
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
                            <label style="color: #000000;">Total Reservation Fee:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.detailList.length * reservationFee.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
                    </div>
                </div>
                {{-- end reservation --}}

                {{-- for pay once --}}
                <div ng-show='lastTransaction.intTransactionType == 3'>
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Total Unit Price(with discount):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice - (lastTransaction.deciTotalUnitPrice * discountPayOnce.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Perpetual Care Fund:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Total Amount To Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ (lastTransaction.deciTotalUnitPrice-(lastTransaction.deciTotalUnitPrice * discountPayOnce.deciBusinessDependencyValue)) +  (lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue) | currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                {{-- end pay once --}}

                {{-- for at need --}}

                <div ng-show="lastTransaction.intTransactionType == 4">
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Total Unit Price:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice | currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Total Perpetual Care Fund:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
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
                            <label style="color: #000000;">Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciAmountPaid | currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u style="color: red">@{{ lastTransaction.deciAmountPaid - (lastTransaction.detailList.length * reservationFee.deciBusinessDependencyValue) | currency:"₱" }}</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                {{-- end reservation --}}

                {{-- for pay once --}}
                <div >
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciAmountPaid | currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ (lastTransaction.deciTotalUnitPrice - (lastTransaction.deciTotalUnitPrice * discountPayOnce.deciBusinessDependencyValue)) + (lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u style="color: red">@{{ lastTransaction.deciAmountPaid-((lastTransaction.deciTotalUnitPrice - (lastTransaction.deciTotalUnitPrice * discountPayOnce.deciBusinessDependencyValue)) + (lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue)) | currency:"₱" }}</u></label>
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
                            <label style="color: #000000;"><u>@{{ lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciAmountPaid|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label style="color: #000000;">Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u style="color: red">@{{ lastTransaction.deciAmountPaid-(lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue) | currency:"₱" }}</u></label>
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
                            <th ng-show="lastTransaction.intTransactionType == 3">Discounted Price</th>
                            <th ng-show="lastTransaction.intTransactionType != 3">Years to Pay</th>
                            <th ng-show="lastTransaction.intTransactionType != 3" id="interest">Monthly</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="unit in lastTransaction.cartList">
                            <td>Unit No. @{{ unit.intUnitId }}</td>
                            <td>@{{ unit.intLevelNo }}</td>
                            <td>@{{ unit.intColumnNo }}</td>
                            <td>@{{ unit.deciPrice|currency:"₱" }}</td>
                            <td ng-show="lastTransaction.intTransactionType == 3">@{{ unit.unitPrice.deciPrice - (unit.unitPrice.deciPrice * discountPayOnce.deciBusinessDependencyValue) | currency:"₱" }}</td>
                            <td ng-show="lastTransaction.intTransactionType != 3">@{{ unit.interest.intNoOfYear }}</td>
                            <td ng-show="lastTransaction.intTransactionType != 3">@{{ unit.monthly|currency:"₱" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br><br>
    </div>
    <div class="modal-footer">
        <button ng-click="generateReceipt(lastTransaction.reservation.intReservationId)"
                name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
    </div>
</div>