<div id="modalBillOut" class="modal modal-fixed" style="width: 75% !important ; max-height: 100% !important; overflow: scroll">
    <div class="modal-header">
        <center><label style="font-size: large;">Bill Out Form</label></center>
    </div>
    <form class="modal-transfer"method="get" autocomplete="off">
        <div class="row">

            <div id="Customer">
                <div class="row">
                    <div class="input-field col s7">
                        <input ng-model="reservation.strCustomerName" name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                        <label for="cname">Customer Name<span style = "color: red;">*</span></label>
                    </div>
                    <div class="input-field col s4">
                        <select ng-model="reservation.intTransactionType"
                                ng-change="changeInterest(reservation.intTransactionType)"
                                required = "required"
                                material-select>
                            <option value="" disabled selected>Select Avail Type<span style = "color: red;">*</span></option>
                            <option value="1">Buy Unit</option>
                            <option value="2">Reserve Unit</option>
                            <option value="3">At Need</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <left>
                        <div class="input-field col s2">
                            <label><b>Details:</b></label>
                        </div>
                    </left>
                </div>
                <div class="row">
                    <div class="col s12" style="margin-top: 50px" ng-show="reservationCart.length != 0">
                        <div class="card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2;">Unit Details</h4>
                            </div>
                            <table id="datatable" style="color: black; background-color: white; border: 2px solid white;">
                                <thead>
                                <tr>
                                    <th>Unit Code</th>
                                    <th>Unit Type</th>
                                    <th>Price</th>
                                    <th ng-show="reservation.intTransactionType > 1">Years to Pay</th>
                                    <th ng-show="reservation.intTransactionType == 1">Discounted Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="cartDetail in reservationCart">
                                    <td>Unit No. @{{ cartDetail.intUnitId }}</td>
                                    <td>@{{ cartDetail.strUnitType }}</td>
                                    <td>@{{ cartDetail.unitPrice.deciPrice | currency: "₱" }}</td>
                                    <td ng-show="reservation.intTransactionType > 1">
                                        <a ng-click="setInterest($index)" data-target="modalInterest"><u>@{{ cartDetail.interest.intNoOfYear }} year/s</u></a>
                                    </td>
                                    <td ng-show="reservation.intTransactionType == 1">
                                        @{{ cartDetail.unitPrice.deciPrice-(cartDetail.unitPrice.deciPrice*.1)|currency: "₱" }}
                                    </td>
                                    <td><a ng-click="removeToCart(unit.intUnitId, $index)" class="waves-light btn light-green " style="width: 70%; color: #000000">REMOVE</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row container">
                        <div class="input-field col s6">
                            <label ng-show="reservation.intTransactionType == 2">Total Amount: <h5>@{{ reservationCart.length * 3000|currency:"₱" }}</h5></label>
                            <label ng-show="reservation.intTransactionType == 1">Total Amount: <h5>@{{ buyUnitPrice|currency:"₱" }}</h5></label>
                        </div>
                        <div class="input-field col s6">
                            <input ng-model="reservation.deciAmountPaid" type="number" id="amountPaid">
                            <label for="amountPaid">Amount Paid:</label>
                        </div>
                    </div>
                </div>
                <div class="right row">
                    <div class="input-field col s12">
                        <button ng-click="processTransaction()" name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 190px; margin-top: -5px;">Confirm</button>
                    </div>
                </div>
                {{--<div class="row">--}}
                    {{--<div class="input-field col s12">--}}
                        {{--<button name = "action" class="waves-light btn light-green modal-close" style="color: #000000; margin-left: 550px; margin-top: -140px">Cancel</button>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <!-- Autocomplete -->
                <datalist id="nameList">
                    <option ng-repeat="customer in customerList" value="@{{ customer.strFullName }}">
                </datalist>
            </div>
        </div>
    </form>
</div>

<div id="modalInterest" class="modal modal-fixed-footer">
    <div class = "modal-header">
        <h4>Years to Pay</h4>
    </div>
    <div class="modal-content">
        <div class="row">
            <div class="input-field col s12">
                <select ng-model="reservationCart[interestIndex].interest"
                        ng-options="interest.intNoOfYear for interest in interestList"
                        id="selectInterest"
                        material-select>
                    <option value="" disabled>Interest</option>
                </select>
                <label for="selectInterest">Years to Pay:</label>
            </div>
        </div>
        <div class="row" ng-show="reservationCart[interestIndex].interest != null">
            <div class="input-field col s12">
                <label>Years to pay: <span>@{{ reservationCart[interestIndex].interest.intNoOfYear }}</span></label>
            </div>
        </div>
        <div class="row" ng-show="reservationCart[interestIndex].interest != null">
            <div class="input-field col s12">
                <label>Interest Rate: <span>@{{ reservationCart[interestIndex].interest.interestRate.deciInterestRate }}%</span></label>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button name = "action" class="btnConfirmCategory btn light-green modal-close">Confirm</button>
    </div>

</div>