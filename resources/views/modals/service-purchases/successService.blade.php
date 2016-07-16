<div id="successService" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
    </div>
    <div class="modal-content" style="overflow-y: auto; clear: top;">
        <div class="row">
            <div class="col s6" style="margin-left: -15px;">
                <div class="row">
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>Aaron CLyde Garil</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -15px;">
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;">Remarks:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>Company</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -15px;">
                    <div class="col s4">
                        <label style="color: #000000; font-size: 15px;">Service/s:</label>
                    </div>
                    <div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>Cremation, Exhumation, Interment</u></label>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="row">
                    <div class="col s4 offset-s6">
                        <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                    </div>
                    <div class="col s2">
                        <label style="color: #000000; font-size: 15px;"><u>T312</u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -15px;">
                    <div class="col s4 offset-s6">
                        <label style="color: #000000; font-size: 15px;">Date:</label>
                    </div>
                    <div class="col s2">
                        <label style="color: #000000; font-size: 15px;"><u>07/09/16</u></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s6" style="border: 3px solid #7b7073;">
                <center><h6>Total Amount to Pay: </h6></center>
                <div class="row">
                    <div class="input-field col s7">
                        <label>Cremation:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>P 10,000.00</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <label>Exhumation:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>P 14,000.00</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <label>Interment:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>P 20,000.00</u></label>
                    </div>
                </div>
                <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                    <div class="input-field col s7">
                        <label>Total Amount to Pay:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>P 34,000.00</u></label>
                    </div><br><br><br>
                </div>
            </div>  

            <div class="col s6" style="border: 3px solid #7b7073;">
                <center><h6>Payment Details: </h6></center>
                <div class="row">
                    <div class="input-field col s7">
                        <label>Total Amount to Pay:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>P 34,000.00</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <label>Amount Paid:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>P 34,000.00</u></label>
                    </div>
                </div>
                <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                    <div class="input-field col s7">
                        <label>Change:</label>
                    </div>
                    <div class="input-field col s5">
                        <label style="color: red"><u>P 0.00</u></label>
                    </div><br><br><br>
                </div>
            </div>
        </div>


        <div class="row">
            <center><label style="color: #000000; font-size: 15px;">Service/s Details:</label></center>
        </div>
        <div class="row">
            <div class="z-depth-2 card material-table">
                <table id="datatable3">
                    <thead>
                        <tr>
                            <th>Service/s</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Interment</td>
                            <td>03/09/13</td>
                            <td>1:00 pm</td>
                            <td>3:00 pm</td>
                            <td>P 10,000.00</td>
                        </tr>
                        <tr>
                            <td>Exhumation</td>
                            <td>03/09/13</td>
                            <td>1:00 pm</td>
                            <td>3:00 pm</td>
                            <td>P 14,000.00</td>
                        </tr>
                        <tr>
                            <td>Cremation</td>
                            <td>03/09/13</td>
                            <td>1:00 pm</td>
                            <td>3:00 pm</td>
                            <td>P 10,000.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>
