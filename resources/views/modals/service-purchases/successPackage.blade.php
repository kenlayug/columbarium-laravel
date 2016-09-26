<div id="successPackage" class="modal modal-fixed-footer" style="overflow-y: hidden;">
    <div class="modal-header" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Generated Receipt</h4></center>
        <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <div class="modal-content" style="overflow-y: auto; clear: top;">
        <div class="row">
            <center>
                <h5>Columbarium and Crematorium Management System</h5>
                <h6>La Loma Catholic Cemetery Compound C3 Road Caloocan City</h6>
                <h6>(Service Purchases Receipt)</h6>
            </center>
        </div><br>
        <div class="row">
            <div class="col s6" style="margin-left: -15px;">
                <div class="row">
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u ng-bind="success.transactionPurchase.strCustomerName"></u></label>
                    </div>
                </div>
                <!-- <div class="row" style="margin-top: -15px;">
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;">Remarks:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>Company</u></label>
                    </div>
                </div> -->
            </div>
            <div class="col s6">
                <div class="row">
                    <div class="col s6 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                    </div>
                    <div class="col s5">
                        <label style="color: #000000; font-size: 15px;"><u ng-bind="success.transactionPurchase.intTransactionId"></u></label>
                    </div>
                </div>
                <div class="row" style="margin-top: -15px;">
                    <div class="col s6 offset-s1">
                        <label style="color: #000000; font-size: 15px;">Date:</label>
                    </div>
                    <div class="col s5">
                        <label style="color: #000000; font-size: 15px;"><u ng-bind="success.transactionPurchase.dateTransaction | amDateFormat : 'MMM D, YYYY'"></u></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="border: 3px solid #7b7073; margin-left: 30px; margin-right: 30px;">
            <div>
                <div ng-repeat="transactionPurchaseInfo in success.transactionPurchaseList">
                    <div class="row" ng-if="transactionPurchaseInfo.strAdditionalName != null">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">
                                <span ng-bind="transactionPurchaseInfo.strAdditionalName+'(x'+transactionPurchaseInfo.intQuantity+')'"></span>
                            </label>
                        </div>
                        <div class="input-field col s6">
                            <label><u ng-bind="transactionPurchaseInfo.deciAdditionalPrice * transactionPurchaseInfo.intQuantity | currency : 'P'"></u></label>
                        </div>
                    </div>
                    <div class="row" ng-if="transactionPurchaseInfo.strServiceName != null">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">
                                <span ng-bind="transactionPurchaseInfo.strServiceName+'(x'+transactionPurchaseInfo.intQuantity+')'"></span>
                            </label>
                        </div>
                        <div class="input-field col s6">
                            <label><u ng-bind="transactionPurchaseInfo.deciServicePrice * transactionPurchaseInfo.intQuantity | currency : 'P'"></u></label>
                        </div>
                    </div>
                    <div class="row" ng-if="transactionPurchaseInfo.strPackageName != null">
                        <div class="input-field col s4 offset-s2">
                            <label style="color: #000000;">
                                <span ng-bind="transactionPurchaseInfo.strPackageName+'(x'+transactionPurchaseInfo.intQuantity+')'"></span>
                            </label>
                        </div>
                        <div class="input-field col s6">
                            <label><u ng-bind="transactionPurchaseInfo.deciPackagePrice * transactionPurchaseInfo.intQuantity | currency : 'P'"></u></label>
                        </div>
                    </div>
                </div>
                <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                    <div class="input-field col s4 offset-s2">
                        <label style="color: #000000;">Grand Total:</label>
                    </div>
                    <div class="input-field col s6">
                        <label><u ng-bind="success.transactionPurchase.deciTotalAmountToPay | currency : 'P'"></u></label>
                    </div><br>
                    <div class="input-field col s4 offset-s2">
                        <label style="color: #000000;">Amount Paid:</label>
                    </div>
                    <div class="input-field col s6">
                        <label><u ng-bind="success.transactionPurchase.deciAmountPaid | currency : 'P'"></u></label>
                    </div><br><br>
                </div>
                <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                    <div class="input-field col s4 offset-s2">
                        <label style="color: #000000;">Change:</label>
                    </div>
                    <div class="input-field col s6">
                        <label style="color: red"><u ng-bind="success.transactionPurchase.deciAmountPaid - success.transactionPurchase.deciTotalAmountToPay | currency : 'P'"></u></label>
                    </div><br><br>
                </div>
            </div>  
        </div>

        <!-- <div class="row">
            <div class="row">
                <center><label style="color: #000000; font-size: 15px;">Purchased Details:</label></center>
            </div>
            <div class="row">
                <div class="z-depth-2 card material-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Candle holder</td>
                                <td>2</td>
                                <td>P 1,000.00</td>
                                <td>P 2,000.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: -30px;">
            <div class="row">
                <center><label style="color: #000000; font-size: 15px;">Schedule List:</label></center>
            </div>
            <div class="row">
                <div class="z-depth-2 card material-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Interment</td>
                                <td>03/09/13</td>
                                <td>1:00 pm</td>
                                <td>3:00 pm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
        
        <br><br>
    </div>
    <div class="modal-footer">
        <button ng-click="generateReceipt(success.transactionPurchase.intTransactionId)" name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Print Receipt</button>
    </div>
</div>