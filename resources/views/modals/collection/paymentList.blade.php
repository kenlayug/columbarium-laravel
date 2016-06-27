<!-- Collection of Payment Modal-->
<div id="modal2" class="modal modal-fixed-footer" style="">
    <div class="modal-header">
        <center>
            <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont2">Collection: Aaron Clyde Garil</h4>
        </center>
    </div>
    <div class="modal-content" id="collect" action="Collection_Transaction.html" method="get" autocomplete="off">

        <!-- Collection Form -->
        <div id="payment">
            <form>
                <!-- Collection Info -->
                <div class="row" style="text-align: left;">
                    <div class = "col s12" style = "padding-left: 20px; margin-top: 10px; text-align: left">
                        <div class="card material-table">
                            <table id="datatable4">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Transaction</th>
                                    <th>Principal</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>01/03/16</th>
                                    <th>T123</th>
                                    <th>P82,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">done</i></th>
                                    <th><button data-target="collection-pay" class="waves-light btn light-green modal-trigger" href="#collection-pay">Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/04/16</th>
                                    <th>T124</th>
                                    <th>P78,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">done</i></th>
                                    <th><button data-target="collection-pay" class="waves-light btn light-green modal-trigger" href="#collection-pay">Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/05/16</th>
                                    <th>T125</th>
                                    <th>P74,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">done</i></th>
                                    <th><button data-target="collection-pay" class="waves-light btn light-green modal-trigger" href="#collection-pay">Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/06/16</th>
                                    <th>T126</th>
                                    <th>P70,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">done</i></th>
                                    <th><button data-target="collection-pay" class="waves-light btn light-green modal-trigger" href="#collection-pay">Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/07/16</th>
                                    <th>T113</th>
                                    <th>P66,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">done</i></th>
                                    <th><button data-target="collection-pay" class="waves-light btn light-green modal-trigger" href="#collection-pay">Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/08/16</th>
                                    <th>T022</th>
                                    <th>P62,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">error</i></th>
                                    <th><button data-target="collection-pay" class="waves-light btn light-green modal-trigger" href="#collection-pay">Pay</button></th>
                                </tr>
                                <tr>
                                    <th>01/09/16</th>
                                    <th>T129</th>
                                    <th>P58,000</th>
                                    <th>P4,000</th>
                                    <th><i class="material-icons">error</i></th>
                                    <th><button data-target="collection-pay" class="waves-light btn light-green modal-trigger" href="#collection-pay">Pay</button></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <i class = "left" style="margin-left: 10px; font-size: medium">Balance: <span style = " color: red;">P 54,000</span></i>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button name = "action" class="wav  es-light btn light-green modal-close" style = "color: #000000;">Cancel</button>
    </div>
</div>