<div id="generateReceiptDownpayment" class="modal modal-fixed-footer" style="overflow-y: hidden;">

    <div class="modal-header" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Generated Receipt</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div class="modal-content" style="overflow-y: auto;">
        <div class="row">
            <center>
                <h5>Columbarium and Crematorium Management System</h5>
                <h6>La Loma Catholic Cemetery Compound C3 Road Caloocan City</h6>
                <h6>(Downpayment Receipt)</h6>
            </center>
        </div><br>
        <div class="row">
            <div class="col s6">
                <div class="row">
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ customer.strFullName }}</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -10px;">
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;">Unit Code:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>Unit No. @{{ downpaymentTransaction.intUnitId }}</u></label>
                     </div>
                </div>
            </div>

            <div class="col s6">
                <div class="row">
                    <div class="col s6 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                    </div>
                    <div class="col s5">
                        <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ downpaymentTransaction.downpayment.intDownpaymentPaymentId }}</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -10px;">
                    <div class="col s6 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Date:</label>
                    </div>
                    <div class="col s5">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ downpaymentTransaction.downpayment.created_at }}</u></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="border: 1px solid #7b7073; margin-left: 30px; margin-right: 30px;"><br>
            
            <div class="row" style="margin-top: -10px;">
                <div class="col s4 offset-s2">
                    <label style="color: #000000; font-size: 15px;">Downpayment Balance:</label>
                </div>
                <div class="col s3">
                    <label style="color: #000000; font-size: 15px;"><u>@{{ downpaymentTransaction.prevBalance | currency: "₱" }}</u></label>
                </div>
            </div>
            <div class="row" style="margin-top: -20px;">
                <div class="input-field col s4 offset-s2">
                    <label style="color: #000000;">Amount Paid:</label>
                </div>
                <div class="input-field col s3">
                    <label><u>@{{ downpaymentTransaction.downpayment.deciAmountPaid | currency: "₱"}}</u></label>
                </div><br><br>
            </div>
            <div ng-show="downpaymentTransaction.downpayment.deciAmountPaid < downpaymentTransaction.balance" class="row" style="border-top: 1px solid #7b7073; margin-top: 0px;">
                <div class="input-field col s4 offset-s2">
                    <label style="color: #000000;">Balance:</label>
                </div>
                <div class="input-field col s3">
                    <label><u style="color: red">@{{ downpaymentTransaction.balance - downpaymentTransaction.downpayment.deciAmountPaid | currency: "₱"}}</u></label>
                </div><br>
            </div>
            <div ng-show="downpaymentTransaction.downpayment.deciAmountPaid >= downpaymentTransaction.balance"
                 class="row" style="margin-top: -10px;">
                <div class="input-field col s4 offset-s2">
                    <label>Change:</label>
                </div>
                <div class="input-field col s3">
                    <label><u style="color: red">@{{ downpaymentTransaction.downpayment.deciAmountPaid - downpaymentTransaction.balance | currency: "₱"}}</u></label>
                </div><br>
            </div><br>
        </div>
        <br><br><br><br>
    </div>
    <div class="modal-footer">
        <button ng-click="generateDownpaymentReceipt(downpaymentTransaction.downpayment.intDownpaymentPaymentId)" name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
    </div>
</div>