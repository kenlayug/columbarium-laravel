@extends('v2.baseLayout')
@section('title', 'Business Dependency')
@section('body')
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script src="{!! asset('/utilities/controller.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>

    <div ng-controller="ctrl.utilities">
        <form autocomplete="off" ng-submit='save()'>

        <div class = "row">
            <div class = "center col s12 m6 l12">
                    <div class = "aside aside z-depth-3" id="formCreate" style = "height: 570px; margin-left: 15px;">
                        <div class = "createHeader" style = "background-color: #00897b; height: 55px;">
                            <h4 class = "center" style = "font-family: fontSketch; font-size: 2.3vw; color: white; padding-top: 10px;">Business Dependencies</h4>
                        </div>
                        <div class = "row" style = "margin-top: 0px; padding-left: 20px; padding-right: 20px;">
                            <div class = "downpayment">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.downpayment.deciBusinessDependencyValue"
                                           ui-percentage-mask
                                           id="downpayment" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 50%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                                    <label id="downpayment" for="downpayment" data-error = "Invalid format." data-success = "">Downpayment<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <div class = "reservationFee">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.reservationFee.deciBusinessDependencyValue"
                                           ui-number-mask="2"
                                           id="reservationFee" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                    <label id="reservationFee" for="reservationFee" data-error = "Invalid Format." data-success = "">Reservation Fee<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <div class = "discountPayOnce">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.discountPayOnce.deciBusinessDependencyValue"
                                           ui-percentage-mask="2"
                                           id="discountPayOnce" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 10%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                                    <label id="discountPayOnce" for="discountPayOnce" data-error = "Invalid format." data-success = "">Discount in pay once units<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
                            <div class = "penalty">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.penalty.deciBusinessDependencyValue"
                                           ui-percentage-mask
                                           id="penalty" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 2%" required = "" min="0" max="100" aria-required = "true">
                                    <label id="penalty" for="penalty" data-error = "Invalid Format." data-success = "">Penalty<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <div class = "discountSpotdown">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.discountSpotdown.deciBusinessDependencyValue"
                                           ui-percentage-mask="2"
                                           id="discountSpotdown" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 20%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                                    <label id="discountSpotdown" for="discountSpotdown" data-error = "Invalid format." data-success = "">Discount for downpayment spotdown<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <div class = "discountSeniorPWD">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.discountSpecial.deciBusinessDependencyValue"
                                           ui-percentage-mask="2"
                                           id="discountSeniorPWD" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 20%" required = "" min="0" max="999999" aria-required = "true">
                                    <label id="discountSeniorPWD" for="discountSeniorPWD" data-error = "Invalid Format." data-success = "">Discount for senior citizen and PWD<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
                            <div class = "refundCancelCremation">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.refund.deciBusinessDependencyValue"
                                           ui-percentage-mask="2"
                                           id="refundCancelCremation" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 50%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                                    <label id="refundCancelCremation" for="refundCancelCremation" data-error = "Invalid format." data-success = "">Refund percentage for cancelled cremation<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <div class = "penaltyForNotReturn">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.penaltyForNotReturn.deciBusinessDependencyValue"
                                           ui-number-mask="2"
                                           id="maxBoneBox" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s. Max input 10<br>*Example: 2" required = "" min="0" max="999999" aria-required = "true">
                                    <label id="maxBoneBox" for="maxBoneBox" data-error = "Invalid Format." data-success = "">Penalty for unreturned deceased<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <div class = "transferOwnerCharge">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.transferOwnerCharge.deciBusinessDependencyValue"
                                           ui-number-mask="2"
                                           id="transferOwnerCharge" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min="0" max="999999">
                                    <label id="transferOwnerCharge" for="maxUrn" data-error = "Invalid format." data-success = "">Charge for transferring ownership<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
                            <div class = "paymentUrnpullout">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.paymentUrn.deciBusinessDependencyValue"
                                           ui-number-mask="2"
                                           id="paymentUrnPullout" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                    <label id="paymentUrnPullout" for="paymentUrnPullout" data-error = "Invalid Format." data-success = "">Payment for urn pull out<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <div class = "gracePeriod">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.gracePeriod.deciBusinessDependencyValue"
                                           ui-number-mask="0"
                                           id="gracePeriod" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min = "1" max ="10" length = "10">
                                    <label id="gracePeriod" for="gracePeriod" data-error = "Invalid format." data-success = "">Grace Period(days)<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <div class = "pcf">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.pcf.deciBusinessDependencyValue"
                                           ui-percentage-mask="2"
                                           id="pcf" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min = "0" max ="10" length = "10">
                                    <label id="pcf" for="pcf" data-error = "Invalid format." data-success = "">Perpetual Care Fund<span style = "color: red;">*</span></label>
                                </div>
                            </div>

                        </div>
                        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
                            <div class = "voidReservationNoPayment">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.voidReservationNoPayment.deciBusinessDependencyValue"
                                           ui-number-mask="0"
                                           id="voidReservationNoPayment" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min = "0" max ="10" length = "10">
                                    <label id="voidReservationNoPayment" for="voidReservationNoPayment" data-error = "Invalid format." data-success = "">Days Before forfeiting Reservation w/ No downpayment Made<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <div class = "voidReservationNotFullPayment">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.voidReservationNotFullPayment.deciBusinessDependencyValue"
                                           ui-number-mask="0"
                                           id="voidReservationNotFullPayment" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min = "0" length = "10">
                                    <label id="voidReservationNotFullPayment" for="voidReservationNotFullPayment" data-error = "Invalid format." data-success = "">Days Before forfeiting reservation w/ out full downpayment<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <div class = "voidOwnershipOverDue">
                                <div class="input-field col s4">
                                    <input ng-model="businessDependencyList.voidOwnershipOverDue.deciBusinessDependencyValue"
                                           ui-number-mask="0"
                                           id="voidOwnershipOverDue" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min = "0" max ="10" length = "10">
                                    <label id="voidOwnershipOverDue" for="voidOwnershipOverDue" data-error = "Invalid format." data-success = "">Overdue Months Before forfeiting ownership<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                        
                        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
                            <div class = "partiallyOwned">
                                <div class="input-field col s4">
                                    <input 
                                           id="partiallyOwned" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min = "0" max ="12" length = "2">
                                    <label id="partiallyOwned" for="partiallyOwned" data-error = "Invalid format." data-success = "">Months Paid to be Partially Owned<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                        <i class = "requiredField left" style = "color: red; padding-left: 30px; margin-top: -10px;">*Required Fields</i>

                        <button name = "action" class="btn light-green right" style = "color: black; margin-top: 5px; margin-right: 30px; margin-top: -20px;">SAVE</button>

                    </div>
                </div>
            </div>
        </form>
    </div>





    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
@endsection