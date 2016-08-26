<!-- Buy, Reserve, At Need Form -->
<div id="availUnit" class="modal modal-fixed-footer" style="width:95%; max-height: 120%; overflow-y: hidden">
    <div class="modal-header" style="background-color: #00897b;">
        <center><label style="font-size: large;">Bill Out Form</label></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <form ng-submit="processTransaction()" autocomplete="off" novalidate>
        <div class="modal-content" style="overflow-y: auto;">
            <div class="row">
                <div class="input-field col s6">
                    <input ng-model="reservation.strCustomerName"
                           name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="customerList">
                    <label for="cname">Customer Name<span style = "color: red;">*</span></label>
                    <datalist id="customerList">
                        <option ng-repeat="customer in customerList" value="@{{ customer.strFullName }}"></option>
                    </datalist>
                </div>
                <div class="input-field col s3">
                    <a ng-show="reservation.strCustomerName == null"
                       data-target="newCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer"
                       href="#newCustomer" style="color: #000000;width: 100px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>

                    <a ng-hide="reservation.strCustomerName == null"
                       ng-click="getCustomer()"
                       data-target="updateCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Customer Details"
                       href="#newCustomer" style="color: #000000;width: 100px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>

                </div>
                <div class="input-field col s3">
                    <select ng-model="reservation.intTransactionType"
                            ng-change="changeInterest(reservation.intTransactionType)"
                            material-select
                            required = "required">
                        <option value="" disabled selected>Select Avail Type<span style = "color: red;">*</span></option>
                        <option value="3">Pay Once</option>
                        <option value="2">Reserve Unit</option>
                        <option value="4">At Need</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-top: -20px; margin-bottom: 10px;">
                <div class="card material-table">
                    <table id="datatable" style="color: black; background-color: white; border: 2px solid white;" datatable="ng">
                        <thead>
                        <tr>
                            <th style="color: #000000; font-size: 15px;">Unit Code</th>
                            <th style="color: #000000; font-size: 15px;">Unit Details</th>
                            <th style="color: #000000; font-size: 15px;" ng-show="reservation.intTransactionType != 3 && reservation.intTransactionType != null">Years To Pay</th>
                            <th style="color: #000000; font-size: 15px;">Price</th>
                            <th style="color: #000000; font-size: 15px;" ng-show="reservation.intTransactionType != 3 && reservation.intTransactionType != null">Monthly</th>
                            <th style="color: #000000; font-size: 15px;" ng-show="reservation.intTransactionType == 3">Discounted Price</th>
                            <th style="color: #000000; font-size: 15px;" ng-show="reservation.intTransactionType != 3 && reservation.intTransactionType != null">Downpayment(@{{ downpayment.deciBusinessDependencyValue | percentage : 2 }})</th>
                            <th style="color: #000000; font-size: 15px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="unit in reservationCart">
                            <th>Unit No. @{{ unit.intUnitId }}</th>
                            <th><a ng-click="viewUnitDetail(unit)"
                                   data-target="unitDetails" class="waves-light btn light-green btn modal-trigger" style="width: 100%; color: #000000">View</a></th>
                            <th ng-show="reservation.intTransactionType != 3 && reservation.intTransactionType != null">
                                <select ng-model="unit.interest"
                                        ng-options="interest.intNoOfYear for interest in interestList"
                                        ng-change="getMonthly(unit)"
                                        class="browser-default">
                                    <option value="" disabled selected><span style = "color: red;">*</span></option>
                                </select>
                            </th>
                            <th>@{{ unit.unitPrice.deciPrice|currency: "₱" }}</th>
                            <th ng-show="reservation.intTransactionType != 3 && reservation.intTransactionType != null">@{{ unit.monthly|currency: "₱" }}</th>
                            <th ng-show="reservation.intTransactionType == 3">@{{ unit.unitPrice.deciPrice-(unit.unitPrice.deciPrice * discountPayOnce.deciBusinessDependencyValue)|currency:"₱" }}</th>
                            <th ng-show="reservation.intTransactionType != 3 && reservation.intTransactionType != null">@{{ unit.unitPrice.deciPrice * downpayment.deciBusinessDependencyValue|currency: "₱" }}</th>
                            <th><a ng-click="removeToCart(unit)"
                                   class="waves-light btn light-green" style="width: 100%; color: #000000">REMOVE</a></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                {{-- for reservation --}}
                <div ng-show="reservation.intTransactionType == 2"
                    class="col s6">
                    <div class="row"
                         style="margin-top: -10px;">
                        <div class="input-field col s6">
                            <label>Due Date for Dowpayment:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ dateNow | amAdd : voidReservationNotFullPayment.deciBusinessDependencyValue : 'days' | amDateFormat : 'MM/DD/YYYY'}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <label>Reservation Fee:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ reservationFee.deciBusinessDependencyValue|currency:"₱" }}</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <div class="input-field col s6">
                            <label>No. of Unit/s:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ reservationCart.length }}</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 40px; border-top: 2px solid #ad9ea2">
                        <div class="input-field col s6">
                            <label style="color: #000000">Total Amount:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ reservationFee.deciBusinessDependencyValue * reservationCart.length|currency:"₱" }}</label>
                        </div>
                    </div>
                </div>
                {{-- for pay once --}}
                <div ng-show="reservation.intTransactionType == 3"
                     class="col s6">
                    <div class="row"
                         style="margin-top: -10px;">
                        <div class="input-field col s6">
                            <label>Total Unit Price:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ reservation.totalUnitPrice-(reservation.totalUnitPrice * discountPayOnce.deciBusinessDependencyValue)|currency:"₱" }}</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <div class="input-field col s6">
                            <label>Perpetual Care Fund(@{{ (pcf.deciBusinessDependencyValue * 100).toFixed(2) }}%):</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ reservation.totalUnitPrice * pcf.deciBusinessDependencyValue |currency:"₱" }}</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 40px; border-top: 2px solid #ad9ea2">
                        <div class="input-field col s6">
                            <label style="color: #000000">Total Amount:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ (reservation.totalUnitPrice-(reservation.totalUnitPrice*discountPayOnce.deciBusinessDependencyValue))+(pcf.deciBusinessDependencyValue * reservation.totalUnitPrice)|currency:"₱" }}</label>
                        </div>
                    </div>
                </div>
                {{-- for at need --}}
                <div ng-show="reservation.intTransactionType == 4"
                     class="col s6">
                    <div class="row"
                         style="margin-top: -10px;">
                        <div class="input-field col s6">
                            <label>Due Date for Downpayment:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ dateNow | amAdd : voidReservationNotFullPayment.deciBusinessDependencyValue : 'days' | amDateFormat : 'MM/DD/YYYY'}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <label>Total Unit Price:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ reservation.totalUnitPrice|currency:"₱" }}</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <div class="input-field col s6">
                            <label>Perpetual Care Fund:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ (pcf.deciBusinessDependencyValue * 100).toFixed(2) }}%</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 40px; border-top: 2px solid #ad9ea2">
                        <div class="input-field col s6">
                            <label style="color: #000000">Total Amount To Pay:</label>
                        </div>
                        <div class="input-field col s6">
                            <label>@{{ pcf.deciBusinessDependencyValue * reservation.totalUnitPrice|currency:"₱" }}</label>
                        </div>
                    </div>
                </div>

                <div class="col s6" style="border-left: 3px solid #7b7073;">
                    <div class="row">
                        <div class="input-field col s6">
                            <select material-select
                                    ng-model="reservation.intPaymentType" required>
                                <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                            </select>
                        </div>
                        <div class="input-field col s6">
                            <a ng-show="reservation.intPaymentType == 2"
                               data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px;">
                        <div class="input-field col s6">
                            <label style="color: #000000; font-size: 20px;">Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s6">
                            <label ng-show="reservation.intTransactionType == 2"><u>@{{ reservationFee.deciBusinessDependencyValue * reservationCart.length|currency:"₱" }}</u></label>
                            <label ng-show="reservation.intTransactionType == 3"><u>@{{ (reservation.totalUnitPrice-(reservation.totalUnitPrice*discountPayOnce.deciBusinessDependencyValue))+(pcf.deciBusinessDependencyValue * reservation.totalUnitPrice)|currency:"₱" }}</u></label>
                            <label ng-show="reservation.intTransactionType == 4"><u>@{{ pcf.deciBusinessDependencyValue * reservation.totalUnitPrice|currency:"₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <div class="input-field col s6">
                            <label style="color: #000000; font-size: 20px;">Amount Paid:</label>
                        </div>
                        <div class="input-field col s6">
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
            </div>
            <br>

        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>

</div>