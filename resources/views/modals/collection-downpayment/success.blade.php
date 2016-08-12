<div id="generateReceiptCollection" class="modal modal-fixed-footer" style="width:95%; max-height: 120%; overflow-y: hidden;">

    <div class="modal-header" style="padding: 0;">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Generated Receipt</h4></center>
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
            <div class="col s6">
                <div class="row">
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ customer.strFullName }}</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -10px;">
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;">Unit Code:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>Unit No. @{{ lastTransaction.unit.intUnitId }}</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -10px;">
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;">Unit Price:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.unit.deciPrice | currency : "P" }}</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -10px;">
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;">Monthly Payment:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.collectionDetail.deciMonthlyAmortization | currency : "P" }}</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -10px;">
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;">Penalty Fee:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.collectionDetail.penalty | currency : "P" }}</u></label>
                    </div>
                </div>
            </div>

            <div class="col s6">
                <div class="row">
                    <div class="col s4 offset-s4">
                        <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                    </div>
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ lastTransaction.collectionPayment.intCollectionPaymentId }}</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -10px;">
                    <div class="col s4 offset-s4">
                        <label style="color: #000000; font-size: 15px;">Date:</label>
                    </div>
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ lastTransaction.collectionPayment.created_at | amDateFormat : 'dddd, MMMM D, YYYY' }}</u></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s4" style="border: 3px solid #7b7073;"><br>
                <center><h6>Penalty Fee Details: </h6></center>
                <div class="row">
                    <div class="input-field col s7">
                        <label style="color: #000000;">Due Date:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ lastTransaction.collectionDetail.dateCollectionDay | amDateFormat : 'MMM D, YYYY' }}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <label style="color: #000000;">Transaction Date:</label>
                    </div>
                    <div class="input-field col s5">
                        <label>@{{ lastTransaction.collectionPayment.created_at | amDateFormat : 'MMM D, YYYY' }}</label>
                    </div>
                </div>
                <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                    <div class="input-field col s7">
                        <label style="color: #000000;">Penalty Fee:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ lastTransaction.collectionDetail.penalty | currency : "P" }}</u></label>
                    </div><br><br><br>
                </div>
            </div>

            <div class="col s4" style="border: 3px solid #7b7073;"><br>
                <center><h6>Amount To Pay Details: </h6></center>
                <div class="row">
                    <div class="input-field col s7">
                        <label style="color: #000000;">Monthly Collection:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ lastTransaction.collectionDetail.deciMonthlyAmortization | currency : "P" }}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <label style="color: #000000;">Penalty Fee:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ lastTransaction.collectionDetail.penalty | currency : "P" }}</u></label>
                    </div>
                </div>
                <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                    <div class="input-field col s7">
                        <label style="color: #000000;">Total Amount To Pay:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ lastTransaction.collectionDetail.deciMonthlyAmortization + lastTransaction.collectionDetail.penalty | currency : "P" }}</u></label>
                    </div><br><br><br>
                </div>
            </div>

            <div class="col s4" style="border: 3px solid #7b7073;"><br>
                <center><h6>Payment Details: </h6></center>
                <div class="row">
                    <div class="input-field col s7">
                        <label style="color: #000000;">Total Amount to Pay:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ lastTransaction.collectionDetail.deciMonthlyAmortization + lastTransaction.collectionDetail.penalty | currency : "P" }}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <label style="color: #000000;">Amount Paid:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ lastTransaction.collectionPayment.deciAmountPaid | currency : "P" }}</u></label>
                    </div>
                </div>
                <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                    <div class="input-field col s7">
                        <label style="color: #000000;">Change:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u style="color: red">@{{ lastTransaction.collectionPayment.deciAmountPaid - (lastTransaction.collectionDetail.deciMonthlyAmortization + lastTransaction.collectionDetail.penalty) | currency : "P" }}</u></label>
                    </div><br><br><br>
                </div>
            </div>
        </div>
        <br><br><br><br>
    
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
    </div>
</div>