<div id="receipt" class="modal modal-fixed-footer" style="width:95%; max-height: 120%; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Generated Receipt</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
        
    </div>
    <div class="modal-content" style="overflow-y: auto;">
        <div class="row">
            <center>
                <h5>Columbarium and Crematorium Management System</h5>
                <h6>La Loma Catholic Cemetery Compound C3 Road Caloocan City</h6>
                <h6 ng-show="lastTransaction.intTransactionType == 3">(Buy Unit Receipt)</h6>
                <h6 ng-show="lastTransaction.intTransactionType == 2">(Unit Reservation Receipt)</h6>
                <h6 ng-show="lastTransaction.intTransactionType == 4">(At Need Unit Receipt)</h6>
            </center>
        </div><br>
        <div class="row">
            <div class="col s5 offset-s7">
                <label style="color: #000000; font-size: 15px; margin-top: -8px;" ng-show="lastTransaction.intTransactionType == 1">Date: @{{ lastTransaction.created_at | amDateFormat : 'dddd, MMMM Do YYYY' }}</label>
            </div>
        </div>
        <label style="color: #000000; font-size: 16px; margin-top: -8px; margin-left: 30px;">Customer Name: @{{ lastTransaction.strLastName+', '+lastTransaction.strFirstName+' '+lastTransaction.strMiddleName }}</label>
        <label class="right" style="color: #000000; font-size: 15px; margin-right: 30px;">Transaction Code: @{{ lastTransaction.intTransactionUnitId }}</label><br><br>

        <div class="row" style="border: 1px solid #7b7073; margin-left: 30px; margin-right: 30px;">
            {{-- for reservation --}}
                <div id="forReservation"
                    ng-show="lastTransaction.intTransactionType == 2">
                    <div class="row">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Due Date for Downpayment:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.created_at | amAdd : voidReservationNotFullPayment.deciBusinessDependencyValue : 'days' | amDateFormat: 'MMMM D,  YYYY' }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Reservation Fee:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ reservationFee.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">No. Of Units:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.detailList.length }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.detailList.length * reservationFee.deciBusinessDependencyValue | currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciAmountPaid | currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u style="color: red">@{{ lastTransaction.deciAmountPaid - (lastTransaction.detailList.length * reservationFee.deciBusinessDependencyValue) | currency:"₱" }}</u></label>
                        </div><br><br>
                    </div>
                </div>
            {{-- end for reservation --}}
                

            {{-- for pay once --}}
                <div ng-show="lastTransaction.intTransactionType == 3">
                    <div class="row">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Total Unit Price(with discount):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice - lastTransaction.deciTotalDiscount|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Perpetual Care Fund:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Total Amount To Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice-(lastTransaction.deciTotalDiscount) +  (lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciAmountPaid | currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u style="color: red">@{{ lastTransaction.deciAmountPaid-((lastTransaction.deciTotalUnitPrice - lastTransaction.deciTotalDiscount) + (lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue)) | currency:"₱" }}</u></label>
                        </div><br><br>
                    </div>
                </div>
            {{-- end pay once --}}

            {{-- for at need --}}

                <div ng-show="lastTransaction.intTransactionType == 4">
                    <div class="row">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Total Unit Price:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Total Perpetual Care Fund(@{{ pcf.deciBusinessDependencyValue | percentage : 2 }}):</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label style="color: #000000;"><u>@{{ lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ lastTransaction.deciAmountPaid|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s5 offset-s2">
                            <label style="color: #000000;">Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u style="color: red">@{{ lastTransaction.deciAmountPaid-(lastTransaction.deciTotalUnitPrice * pcf.deciBusinessDependencyValue)|currency:"₱" }}</u></label>
                        </div><br><br>
                    </div>
                </div>

            {{-- end at need --}}

        </div>

        <div class="row">
            <center><label style="color: #000000; font-size: 15px;">Unit Details:</label></center>
        </div>
        <div class="row">
            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px; margin-top: -15px;">
                <table id="datatable2" datatable="ng">
                    <thead>
                        <tr>
                            <th>Unit Code</th>
                            <th>Unit Price</th>
                            <th ng-show="lastTransaction.intTransactionType == 3">Discounted Price</th>
                            <th ng-show="lastTransaction.intTransactionType != 3">Years to Pay</th>
                            <th ng-show="lastTransaction.intTransactionType != 3">Downpayment</th>
                            <th ng-show="lastTransaction.intTransactionType != 3" id="interest">Monthly</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="unit in lastTransaction.cartList">
                            <td>@{{ unit.display }}</td>
                            <td>@{{ unit.unitPrice.deciPrice|currency:"₱" }}</td>
                            <td ng-show="lastTransaction.intTransactionType == 3">@{{ unit.unitPrice.deciPrice - unit.deciDiscount | currency:"₱" }}</td>
                            <td ng-show="lastTransaction.intTransactionType != 3">@{{ unit.interest.intNoOfYear }}</td>
                            <td ng-show="lastTransaction.intTransactionType != 3">@{{ unit.unitPrice.deciPrice * downpayment.deciBusinessDependencyValue | currency : "₱" }}</td>
                            <td ng-show="lastTransaction.intTransactionType != 3">@{{ unit.monthly | currency:"₱" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <center><label style="color: #000000; font-size: 15px;">Unit Location:</label></center>
        </div>
        <div class="row">
            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px; margin-top: -15px;">
                <table id="datatable3" datatable="ng">
                    <thead>
                        <tr>
                            <th>Building</th>
                            <th>Floor No</th>
                            <th>Room</th>
                            <th>Block No</th>
                            <th>Unit Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="unit in lastTransaction.cartList">
                            <td ng-bind="unit.strBuildingName"></td>
                            <td ng-bind="unit.intFloorNo"></td>
                            <td ng-bind="unit.strRoomName"></td>
                            <td ng-bind="unit.intBlockNo"></td>
                            <td ng-bind="unit.display"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br><br>
    </div>
    <div class="modal-footer">
        <button ng-click="generateReceipt(lastTransaction.intTransactionUnitId)"
                name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
    </div>
</div>