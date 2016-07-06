@extends('v2.baseLayout')
@section('title', 'Utilities')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>

    <form ng-submit="SaveNewAdditional()" class = "formCreate aside aside z-depth-3" id="formCreate" style = "height: 520px; margin-top: 20px; width: 1000px; margin-left: 200px;">
        <div class = "createHeader" style = "background-color: #00897b; height: 55px;">
            <h4 style = "font-family: fontSketch; font-size: 2.3vw; padding-left: 300px; color: white; padding-top: 10px;">Business Dependencies</h4>
        </div>
        <div class = "row" style = "padding-left: 20px; padding-right: 20px;">
            <div class = "downpayment">
                <div class="input-field col s4">
                    <input id="downpayment" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 50%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "(^100([.]0{1,2})?)$|(^\d{1,2}([.]\d{1,2})?)$">
                    <label id="downpayment" for="downpayment" data-error = "Invalid format." data-success = "">Downpayment<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
            <div class = "reservationFee">
                <div class="input-field col s4">
                    <input id="reservationFee" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                    <label id="reservationFee" for="reservationFee" data-error = "Invalid Format." data-success = "">Reservation Fee<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
            <div class = "discountPayOnce">
                <div class="input-field col s4">
                    <input id="discountPayOnce" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 10%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "(^100([.]0{1,2})?)$|(^\d{1,2}([.]\d{1,2})?)$">
                    <label id="discountPayOnce" for="discountPayOnce" data-error = "Invalid format." data-success = "">Discount in pay once units<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
            <div class = "penalty">
                <div class="input-field col s4">
                    <input id="penalty" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 2%" required = "" min="1" max="999999" aria-required = "true" pattern = "(^100([.]0{1,2})?)$|(^\d{1,2}([.]\d{1,2})?)$">
                    <label id="penalty" for="penalty" data-error = "Invalid Format." data-success = "">Penalty<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
            <div class = "discountSpotdown">
                <div class="input-field col s4">
                    <input id="discountSpotdown" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 20%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "(^100([.]0{1,2})?)$|(^\d{1,2}([.]\d{1,2})?)$">
                    <label id="discountSpotdown" for="discountSpotdown" data-error = "Invalid format." data-success = "">Discount for downpayment spotdown<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
            <div class = "discountSeniorPWD">
                <div class="input-field col s4">
                    <input id="discountSeniorPWD" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 20%" required = "" min="1" max="999999" aria-required = "true" pattern = "(^100([.]0{1,2})?)$|(^\d{1,2}([.]\d{1,2})?)$">
                    <label id="discountSeniorPWD" for="discountSeniorPWD" data-error = "Invalid Format." data-success = "">Discount for senior citizen and PWD<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
            <div class = "refundCancelCremation">
                <div class="input-field col s4">
                    <input id="refundCancelCremation" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid percentage format only.<br>*Example: 50%" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "(^100([.]0{1,2})?)$|(^\d{1,2}([.]\d{1,2})?)$">
                    <label id="refundCancelCremation" for="refundCancelCremation" data-error = "Invalid format." data-success = "">Refund percentage for cancelled cremation<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
            <div class = "maxBoneBox">
                <div class="input-field col s4">
                    <input id="maxBoneBox" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s. Max input 10<br>*Example: 2" required = "" min ="1" max ="10" length = "10" aria-required = "true">
                    <label id="maxBoneBox" for="maxBoneBox" data-error = "Invalid Format." data-success = "">Maximum bone box capacity in a unit<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
            <div class = "maxUrn">
                <div class="input-field col s4">
                    <input id="maxUrn" type="number" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only whole number/s.<br>*Example: 6" required = "" aria-required="true" min = "1" max ="10" length = "10">
                    <label id="maxUrn" for="maxUrn" data-error = "Invalid format." data-success = "">Maximum urn capacity in a unit<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
            <div class = "paymentUrnpullout">
                <div class="input-field col s4">
                    <input id="paymentUrnPullout" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                    <label id="paymentUrnPullout" for="paymentUrnPullout" data-error = "Invalid Format." data-success = "">Payment for urn pull out<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
        </div>
        <i class = "requiredField left" style = "color: red; padding-left: 30px;">*Required Fields</i>
    </form>

    <script>
        $('input.number').keyup(function(event) {

            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
            }

            $(this).val(function(index, value) {
                value = value.replace(/,/g,''); // remove commas from existing input
                return numberWithCommas(value); // add commas back in
            });
        });

        function numberWithCommas(x) {

            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }
    </script>
@endsection