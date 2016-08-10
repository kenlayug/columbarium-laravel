<div id="generateReceiptDownpayment" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden;">

    <div class="modal-header" style="padding: 0;">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Generated Receipt</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div class="modal-content" style="overflow-y: auto;">
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
                        <label style="color: #000000; font-size: 15px;"><u>Unit No. @{{ downpaymentTransaction.intUnitId }}</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -10px;">
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;">Downpayment:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ reservation.detail.downpayment | currency: "₱" }}</u></label>
                    </div>
                </div>
            </div>

            <div class="col s6">
                <div class="row">
                    <div class="col s4 offset-s4">
                        <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                    </div>
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;"><u>Transaction No. @{{ downpaymentTransaction.downpayment.intDownpaymentId }}</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -10px;">
                    <div class="col s4 offset-s4">
                        <label style="color: #000000; font-size: 15px;">Date:</label>
                    </div>
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ downpaymentTransaction.downpayment.created_at }}</u></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s8 offset-s2" style="border: 3px solid #7b7073;"><br>
                <center><h6>Payment Details: </h6></center>
                <div class="row">
                    <div class="input-field col s7">
                        <label>Downpayment Balance:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ downpaymentTransaction.balance | currency: "₱"}}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <label>Amount Paid:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ downpaymentTransaction.downpayment.deciAmountPaid | currency: "₱"}}</u></label>
                    </div>
                </div>
                <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                    <div class="input-field col s7">
                        <label>Balance:</label>
                    </div>
                    <div class="input-field col s5">
                        <label ng-show="downpaymentTransaction.downpayment.deciAmountPaid < downpaymentTransaction.balance"><u style="color: red">@{{ downpaymentTransaction.balance - downpaymentTransaction.downpayment.deciAmountPaid | currency: "₱"}}</u></label>
                        <label ng-show="downpaymentTransaction.downpayment.deciAmountPaid >= downpaymentTransaction.balance"><u style="color: red">@{{ 0 | currency: "₱"}}</u></label>
                    </div><br><br><br>
                </div>
                <div ng-show="downpaymentTransaction.downpayment.deciAmountPaid >= downpaymentTransaction.balance"
                     class="row" style="border-top: 1px solid #7b7073; margin-top: 20px;">
                    <div class="input-field col s7">
                        <label>Change:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u style="color: red">@{{ downpaymentTransaction.downpayment.deciAmountPaid - downpaymentTransaction.balance | currency: "₱"}}</u></label>
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