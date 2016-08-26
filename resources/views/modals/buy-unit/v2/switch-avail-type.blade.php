
<div id="switch" class="modal modal-fixed-footer" style="width:95%; max-height: 120%; overflow-y: hidden">
    <div class="modal-header" style="overflow-y: auto;">
        <center><label style="font-size: large; font-family: myFirstFont2;">SWITCH AVAIL TYPE</label></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
        style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div class="modal-content" style="color: #000000; overflow-y: auto;">
        <div class="switch row">
            <center>
                <label style="font-size: 15px; color: #000000; font-weight: 600;">SWITCH TO: </label>
                <label style="font-size: 15px; color: #000000;">
                    Pay Once
                    <input type="checkbox">
                    <span class="lever"></span>
                    At Need
                </label>
            </center>
          </div>
        <div id="unitDetailsCol" class="row" style="margin-left: 30px; margin-right: 30px;">
            <div class="col s6" style="border: 1px solid #7b7073; height: 320px;">
                <div class="row">
                    <center><h6>Reservation Details:</h6></center>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Reservation Fee:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>P 3,000.00</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Due Date For Downpayment:</label>
                    </div>
                    <div class="col s5">
                        <label style="color: #000000; font-size: 15px;"><u>@{{ dateNow | amAdd : voidReservationNotFullPayment.deciBusinessDependencyValue : 'days' | amDateFormat : 'MM/DD/YYYY'}}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Downpayment:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>P 13,000.00</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Monthly Amortization:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>P 7,500.00</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Years to pay:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>3</u></label>
                    </div>
                </div>
            </div>
            <div class="col s6" style="border: 1px solid #7b7073; height: 320px;">
                <div class="row">
                    <center><h6>New Details:</h6></center>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Avail Type:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>At Need</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Due Date For Downpayment:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>09/12/16</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Unit Price:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>P 58,000.00</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Perpetual Care Fund:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>P 8,000.00</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Total Amount to Pay:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>P 50,000.00</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s5 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Years to Pay:</label>
                    </div>
                    <div class="input-field col s5" style="margin-top: -15px;">
                    <select material-select required>
                        <option value="" disabled selected>Number of Years<span>*</span></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <h5>Payment Details:</h5>
            </div>
            <div class="row">
                <div class="input-field col s2">
                    <select material-select ng-model="reservation.intPaymentType" required>
                        <option value="" disabled selected>Mode of Payment<span>*</span></option>
                        <option value="1">Cash</option>
                        <option value="2">Cheque</option>
                    </select>
                </div>
                <div class="input-field col s2" ng-show="reservation.intPaymentType == 2">
                    <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000; font-size: 13px;">Cheque Details</a>
                </div>
                <div class="input-field col s2">
                    <label style="color: #000000; font-size: 20px;">Total Amount to Pay:</label>
                </div>
                <div class="input-field col s2">
                    <label ng-show="reservation.intTransactionType == 2"><u>@{{ reservationFee.deciBusinessDependencyValue * reservationCart.length|currency:"₱" }}</u></label>
                    <label ng-show="reservation.intTransactionType == 3"><u>@{{ (reservation.totalUnitPrice-(reservation.totalUnitPrice*discountPayOnce.deciBusinessDependencyValue))+(pcf.deciBusinessDependencyValue * reservation.totalUnitPrice)|currency:"₱" }}</u></label>
                    <label ng-show="reservation.intTransactionType == 4"><u>@{{ pcf.deciBusinessDependencyValue * reservation.totalUnitPrice|currency:"₱" }}</u></label>
                </div>
                <div class="input-field col s2">
                    <label style="color: #000000; font-size: 20px;">Amount Paid:</label>
                </div>
                <div class="input-field col s2">
                    <input ng-model="reservation.deciAmountPaid"
                        ui-number-mask
                        id="aPaid" type="text" required="" aria-required="true" class="validate" minlength = "1">
                   <label for="aPaid"><span style = "color: red;">*</span></label>
                </div>
                
            </div>
                    
            <div class="row">
                <i class = "left" style = "color: red;">*Required Fields</i>
            </div>
        </div>
        <br><br>
    </div>
    
    <div class="modal-footer">
         <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
        <a ng-click="customer = null"
            name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>