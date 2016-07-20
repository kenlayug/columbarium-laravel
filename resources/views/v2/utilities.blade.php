@extends('v2.baseLayout')
@section('title', 'Business Dependency')
@section('body')

    <script src="{!! asset('/utilities/controller.js') !!}"></script>

    <div ng-controller="ctrl.utilities">
        <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>

        <div class = "formCreate aside aside z-depth-3" id="formCreate" style = "height: 600px; margin-top: 20px; width: 1000px; margin-left: 200px;">
            <div class = "createHeader" style = "background-color: #00897b; height: 55px;">
                <h4 style = "font-family: fontSketch; font-size: 2.3vw; padding-left: 300px; color: white; padding-top: 10px;">Business Dependencies</h4>
            </div>
            <div class = "row" style = "padding-left: 20px; padding-right: 20px;">
                <div class = "downpayment">
                    <form ng-submit="save('downpayment', businessDependencyList.downpayment.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.downpayment.deciBusinessDependencyValue"
                                   ui-percentage-mask
                                   id="downpayment" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 50%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                            <label id="downpayment" for="downpayment" data-error = "Invalid format." data-success = "">Downpayment<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
                <div class = "reservationFee">
                    <form ng-submit="save('reservationFee', businessDependencyList.reservationFee.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.reservationFee.deciBusinessDependencyValue"
                                   ui-number-mask="2"
                                   id="reservationFee" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                            <label id="reservationFee" for="reservationFee" data-error = "Invalid Format." data-success = "">Reservation Fee<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
                <div class = "discountPayOnce">
                    <form ng-submit="save('discountPayOnce', businessDependencyList.discountPayOnce.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.discountPayOnce.deciBusinessDependencyValue"
                                   ui-percentage-mask="2"
                                   id="discountPayOnce" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 10%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                            <label id="discountPayOnce" for="discountPayOnce" data-error = "Invalid format." data-success = "">Discount in pay once units<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
                <div class = "penalty">
                    <form ng-submit="save('penalty', businessDependencyList.penalty.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.penalty.deciBusinessDependencyValue"
                                   ui-percentage-mask
                                   id="penalty" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 2%" required = "" min="0" max="100" aria-required = "true">
                            <label id="penalty" for="penalty" data-error = "Invalid Format." data-success = "">Penalty<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
                <div class = "discountSpotdown">
                    <form ng-submit="save('discountSpotdown', businessDependencyList.discountSpotdown.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.discountSpotdown.deciBusinessDependencyValue"
                                   ui-percentage-mask="2"
                                   id="discountSpotdown" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 20%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                            <label id="discountSpotdown" for="discountSpotdown" data-error = "Invalid format." data-success = "">Discount for downpayment spotdown<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
                <div class = "discountSeniorPWD">
                    <form ng-submit="save('discountSpecial', businessDependencyList.discountSpecial.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.discountSpecial.deciBusinessDependencyValue"
                                   ui-percentage-mask="2"
                                   id="discountSeniorPWD" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 20%" required = "" min="0" max="999999" aria-required = "true">
                            <label id="discountSeniorPWD" for="discountSeniorPWD" data-error = "Invalid Format." data-success = "">Discount for senior citizen and PWD<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
                <div class = "refundCancelCremation">
                    <form ng-submit="save('refund', businessDependencyList.refund.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.refund.deciBusinessDependencyValue"
                                   ui-percentage-mask="2"
                                   id="refundCancelCremation" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 50%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                            <label id="refundCancelCremation" for="refundCancelCremation" data-error = "Invalid format." data-success = "">Refund percentage for cancelled cremation<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
                <div class = "penaltyForNotReturn">
                    <form ng-submit="save('penaltyForNotReturn', businessDependencyList.penaltyForNotReturn.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.penaltyForNotReturn.deciBusinessDependencyValue"
                                   ui-number-mask="2"
                                   id="maxBoneBox" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s. Max input 10<br>*Example: 2" required = "" min="0" max="999999" aria-required = "true">
                            <label id="maxBoneBox" for="maxBoneBox" data-error = "Invalid Format." data-success = "">Penalty for unreturned deceased<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
                <div class = "transferOwnerCharge">
                    <form ng-submit="save('transferOwnerCharge', businessDependencyList.transferOwnerCharge.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.transferOwnerCharge.deciBusinessDependencyValue"
                                   ui-number-mask="2"
                                   id="transferOwnerCharge" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min="0" max="999999">
                            <label id="transferOwnerCharge" for="maxUrn" data-error = "Invalid format." data-success = "">Charge for transferring ownership<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
                <div class = "paymentUrnpullout">
                    <form ng-submit="save('paymentUrn', businessDependencyList.paymentUrn.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.paymentUrn.deciBusinessDependencyValue"
                                   ui-number-mask="2"
                                   id="paymentUrnPullout" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                            <label id="paymentUrnPullout" for="paymentUrnPullout" data-error = "Invalid Format." data-success = "">Payment for urn pull out<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
                <div class = "gracePeriod">
                    <form ng-submit="save('gracePeriod', businessDependencyList.gracePeriod.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.gracePeriod.deciBusinessDependencyValue"
                                   ui-number-mask="0"
                                   id="gracePeriod" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min = "1" max ="10" length = "10">
                            <label id="gracePeriod" for="gracePeriod" data-error = "Invalid format." data-success = "">Grace Period(days)<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
                <div class = "pcf">
                    <form ng-submit="save('pcf', businessDependencyList.pcf.deciBusinessDependencyValue)">
                        <div class="input-field col s4">
                            <input ng-model="businessDependencyList.pcf.deciBusinessDependencyValue"
                                   ui-percentage-mask="2"
                                   id="pcf" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min = "0" max ="10" length = "10">
                            <label id="pcf" for="pcf" data-error = "Invalid format." data-success = "">Perpetual Care Fund<span style = "color: red;">*</span></label>
                        </div>
                        <div class = "col s2">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
            <i class = "requiredField left" style = "color: red; padding-left: 30px;">*Required Fields</i>
        </div>

    </div>
@endsection