@extends('v2.baseLayout')
@section('title', 'Utilities')
@section('body')

    <form ng-submit="SaveNewAdditional()" class = "formCreate aside aside z-depth-3" id="formCreate" style = "height: 520px; margin-top: 20px; width: 1000px; margin-left: 200px;">
        <div class = "createHeader" style = "background-color: #00897b; height: 55px;">
            <h4 style = "font-family: fontSketch; font-size: 2.3vw; padding-left: 300px; color: white; padding-top: 10px;">Business Dependencies</h4>
        </div>
        <div class = "row" style = "padding-left: 20px; padding-right: 20px;">
            <div class = "itemName">
                <div class="input-field col s4">
                    <input ng-model="additional.strAdditionalName" id="itemName" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Metallic Urn" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                    <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Downpayment<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btnCreate btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
            <div class = "itemPrice">
                <div class="input-field col s4">
                    <input ng-model="additional.deciPrice" id="itemPrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places.<br>*Example: P 0.00" name="item.dblPrice" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                    <label id="createPrice" for="itemPrice" data-error = "Invalid Format." data-success = "">Reservation Fee<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btnCreate btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
            <div class = "itemName">
                <div class="input-field col s4">
                    <input ng-model="additional.strAdditionalName" id="itemName" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Metallic Urn" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                    <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Discount in pay once units<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btnCreate btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
            <div class = "itemPrice">
                <div class="input-field col s4">
                    <input ng-model="additional.deciPrice" id="itemPrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places.<br>*Example: P 0.00" name="item.dblPrice" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                    <label id="createPrice" for="itemPrice" data-error = "Invalid Format." data-success = "">Penalty<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btnCreate btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
            <div class = "itemName">
                <div class="input-field col s4">
                    <input ng-model="additional.strAdditionalName" id="itemName" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Metallic Urn" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                    <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Discount for downpayment spotdown<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btnCreate btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
            <div class = "itemPrice">
                <div class="input-field col s4">
                    <input ng-model="additional.deciPrice" id="itemPrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places.<br>*Example: P 0.00" name="item.dblPrice" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                    <label id="createPrice" for="itemPrice" data-error = "Invalid Format." data-success = "">Discount for senior citizen and PWD<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btnCreate btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
            <div class = "itemName">
                <div class="input-field col s4">
                    <input ng-model="additional.strAdditionalName" id="itemName" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Metallic Urn" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                    <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Refund percentage for cancelled cremation<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btnCreate btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
            <div class = "itemPrice">
                <div class="input-field col s4">
                    <input ng-model="additional.deciPrice" id="itemPrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places.<br>*Example: P 0.00" name="item.dblPrice" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                    <label id="createPrice" for="itemPrice" data-error = "Invalid Format." data-success = "">Maximum bone box capacity in a unit<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btnCreate btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
        </div>
        <div class = "row" style = "margin-top: -20px; padding-left: 20px; padding-right: 20px;">
            <div class = "itemName">
                <div class="input-field col s4">
                    <input ng-model="additional.strAdditionalName" id="itemName" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Metallic Urn" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                    <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Maximum urn capacity in a unit<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btnCreate btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
            <div class = "itemPrice">
                <div class="input-field col s4">
                    <input ng-model="additional.deciPrice" id="itemPrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places.<br>*Example: P 0.00" name="item.dblPrice" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                    <label id="createPrice" for="itemPrice" data-error = "Invalid Format." data-success = "">Payment for urn pull out<span style = "color: red;">*</span></label>
                </div>
                <div class = "col s2">
                    <button type = "submit" name = "action" class="btnCreate btn light-green right" style = "color: black; margin-top: 25px;">SAVE</button>
                </div>
            </div>
        </div>
        <i class = "requiredField left" style = "color: red; padding-left: 30px;">*Required Fields</i>
    </form>
@endsection