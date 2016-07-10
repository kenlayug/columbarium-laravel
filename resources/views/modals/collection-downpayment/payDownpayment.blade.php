<!-- Downpayment Modal-->
<div id="downPaymentForm" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow-y: hidden;">

    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont">Downpayment: Aaron Clyde Garil</h4>
        </center>
    </div>

    <div class="modal-content" style="overflow-y: auto;">
        <br>
        <div class="row">
            <div class = "col s9 card material-table" style = "padding-left: 20px; margin-top: -5px; text-align: left">
                <table id="datatable2">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Transaction Code</th>
                        <th>Payment</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>01/03/16</th>
                        <th>T123</th>
                        <th>P4,000</th>
                    </tr>
                    <tr>
                        <th>01/04/16</th>
                        <th>T124</th>
                        <th>P4,000</th>
                    </tr>
                    <tr>
                        <th>01/05/16</th>
                        <th>T125</th>
                        <th>P4,000</th>
                    </tr>
                    <tr>
                        <th>01/06/16</th>
                        <th>T126</th>
                        <th>P7,000</th>
                    </tr>
                    <tr>
                        <th>01/07/16</th>
                        <th>T113</th>
                        <th>P4,000</th>
                    </tr>
                    <tr>
                        <th>01/08/16</th>
                        <th>T022</th>
                        <th>P62,000</th>
                    </tr>
                    <tr>
                        <th>01/09/16</th>
                        <th>T129</th>
                        <th>P4,000</th>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col s3">

                <div class="row">
                    <div class="input-field col s12">
                        <select ng-model="newPayment.intPaymentType" required>
                            <option value="" disabled selected>Mode of Payment<span>*</span></option>
                            <option value="1">Cash</option>
                            <option value="2">Cheque</option>
                        </select>
                    </div>

                    <div class="input-field col s12">
                        <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                    </div>

                    <div class="input-field col s12">
                        <input ng-model="newPayment.deciAmount" id="dAmount" type="number" required="" aria-required="true" class="validate">
                        <label for="dAmount">Amount Paid<span style = "color: red;">*</span></label>
                    </div>
                    
                </div>
            </div>
            <i class="left" style="margin-left: 10px">Balance:</i> <i><u>P 54,000.00<u></i><br>
            <i class="left" style="color: red; margin-left: 10px;">*Required Fields</i>
        </div>
        <br><br><br>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left:10px; margin-right: 10px;">Submit</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>
