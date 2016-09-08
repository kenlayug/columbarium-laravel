<div id="generateReceiptCollection" class="modal modal-fixed-footer" style="overflow-y: hidden;">

    <div class="modal-header" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont2; color: white; padding: 20px;">Generated Receipt</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div class="modal-content" style="overflow-y: auto;">
        <div class="row">
            <center>
                <h5>Columbarium and Crematorium Management System</h5>
                <h6>La Loma Catholic Cemetery Compound C3 Road Caloocan City</h6>
                <h6>(Collection Receipt)</h6>
            </center>
        </div><br>
        <div class="row">
            <div class="col s6">
                <div class="row">
                    <div class="col s7">
                        <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                    </div>
                    <div class="col s5">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ customer.strFullName }}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s7">
                        <label style="color: #000000; font-size: 15px;">Unit Id:</label>
                    </div>
                    <div class="col s5">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.unit.intUnitId }}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s7">
                        <label style="color: #000000; font-size: 15px;">Unit Price:</label>
                    </div>
                    <div class="col s5">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.unit.deciPrice | currency : "P" }}</u></label>
                    </div>
                </div>
            </div>

            <div class="col s6">
                <div class="row">
                    <div class="col s6 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Transaction Id: </label>
                    </div>
                    <div class="col s5">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.collectionPayment.intCollectionPaymentId }}</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -10px;">
                    <div class="col s6 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Date:</label>
                    </div>
                    <div class="col s5">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.datePayment | amDateFormat : 'dddd, MMMM D, YYYY' }}</u></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="border: 1px solid #7b7073; margin-left: 30px; margin-right: 30px;"><br>
            <div class="row" style="margin-top: -30px;">
                <div class="input-field col s4 offset-s2">
                    <label style="color: #000000;">Total Amount To Pay:</label>
                </div>
                <div class="input-field col s3">
                    <label><u>@{{ lastTransaction.deciTotalAmountToPay | currency : "P" }}</u></label>
                </div><br><br><br>
            </div>
            <div class="row" style="margin-top: -45px;">
                <div class="input-field col s4 offset-s2">
                    <label style="color: #000000;">Amount Paid:</label>
                </div>
                <div class="input-field col s3">
                    <label><u>@{{ lastTransaction.collectionPayment.deciAmountPaid | currency : "P" }}</u></label>
                </div>
            </div>
            <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                <div class="input-field col s4 offset-s2">
                    <label style="color: #000000;">Change:</label>
                </div>
                <div class="input-field col s3">
                    <label><u style="color: red">@{{ lastTransaction.collectionPayment.deciAmountPaid - lastTransaction.deciTotalAmountToPay | currency : "P" }}</u></label>
                </div>
            </div><br>
        </div>

        <div class="row">
            <center><h6>Unit Collections</h6></center>
            <div class="z-depth-1 card material-table">
                <table>
                    <thead>
                        <tr>
                            <th class="center">Due Date</th>
                            <th class="center">Monthly Collection</th>
                            <th class="center">Penalty Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="collectionToPay in lastTransaction.collectionListToPay">
                            <td class="center">@{{ collectionToPay.dateCollectionDay }}</td>
                            <td class="center">@{{ collectionToPay.deciMonthlyAmortization | currency: "P" }}</td>
                            <td class="center">@{{ collectionToPay.penalty | currency : "P" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br><br><br>
    </div>
    <div class="modal-footer">
        <button ng-click="generateCollectionReceipt(lastTransaction.collectionPayment.intCollectionPaymentId)" name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
    </div>
</div>