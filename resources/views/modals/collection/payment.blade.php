<!-- Collection of Payment Modal-->
<div id="modal2" class="modal modal-fixed" style="">
    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont">Collection</h4>
        </center>
    </div>
    <div class="cmxform" id="collect" action="Collection_Transaction.html" method="get" autocomplete="off">

        <!-- Collection Form -->
        <div id="payment">
            <form>
                <!-- Collection Info -->
                <div class="row" style="text-align: left;">
                    <div class = "col s9" style = "padding-left: 20px; margin-top: 10px; text-align: left">
                        <div class="card material-table">
                            <table id="datatable4">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Principal</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>01/03/16</th>
                                    <th>P82,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">done</i></th>
                                    <th><button name = "action" class="waves-light btn light-green" disabled>Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/04/16</th>
                                    <th>P78,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">done</i></th>
                                    <th><button name = "action" class="waves-light btn light-green" disabled>Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/05/16</th>
                                    <th>P74,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">done</i></th>
                                    <th><button name = "action" class="waves-light btn light-green" disabled>Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/06/16</th>
                                    <th>P70,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">done</i></th>
                                    <th><button name = "action" class="waves-light btn light-green" disabled>Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/07/16</th>
                                    <th>P66,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">done</i></th>
                                    <th><button name = "action" class="waves-light btn light-green" disabled>Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/08/16</th>
                                    <th>P62,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">error</i></th>
                                    <th><button name = "action" class="waves-light btn light-green">Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/09/16</th>
                                    <th>P58,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">error</i></th>
                                    <th><button name = "action" class="waves-light btn light-green">Pay</button></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <i class = "left" style="margin-left: 10px; font-size: medium">Balance: <span style = " color: red;">P 54,000</span></i>
                    </div>
                    <div class="col s3">
                        <div class="row">
                            <div class="input-field col s12">
                                <select required>
                                    <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <label for="amount" data-error = "Invalid Format!">Amount:</label>
                            </div>
                            <div class="input-field col s8">
                                        <span class="input-peso left">
                                            <label for="amountPay"><u> P8,000</u></label>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Collection -->

                <div class="right row" style="margin-top: -100px;">
                    <div class="input-field col s12">
                        <br>
                        <button name = "action" class="waves-light btn light-green" style = "margin-left: 10px; margin-right: 10px; color: #000000; margin-top: 10px;">Submit</button>
                        <button name = "action" class="wav  es-light btn light-green modal-close" style = "color: #000000; margin-top: 10px;">Cancel</button>
                    </div>
                </div>
                <i class = "left" style = "margin-top: -110px; margin-bottom: 50px; padding-left: 580px; color: red;">*Required Fields</i>
            </form>
        </div>
    </div>
</div>