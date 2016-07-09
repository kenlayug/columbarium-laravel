<!-- Main Form for Manage Service (Avail and Cancelation of transaction)-->
<div id="modalAddToCart" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow: hidden;">
    <center>
        <div class="modal-header">
            <label style="font-size: large">UNIT DETAILS</label>
        </div>

        <div id='viewDetails' class="modal-content" style="color: #000000">
            <div class="row" style="margin-top: -20px;">
                <div class="input-field col s5" style="margin-left: 100px;">
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Status:</b></label>
                        </div>
                        <div class="input-field col s8">
                            <label><u>@{{ unit.strUnitStatus }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Owner:</b></label>
                        </div>
                        <div class="input-field col s8">
                            <label ng-show="unit.strFirstName != null"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName}}</u></label>
                            <label ng-hide="unit.strFirstName != null"><u>N/A</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Price:</b></label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ unit.unitPrice.deciPrice|currency: "₱" }}</u></label>
                        </div>
                    </div>
                </div>
                <div class="input-field col s5" style="margin-left: 50px;">
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Building:</b></label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ unit.strBuildingName }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Floor:</b></label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Floor No. @{{ unit.intFloorNo }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Room:</b></label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>@{{ unit.strRoomName }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Block:</b></label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Block No. @{{ unit.intBlockNo }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Unit:</b></label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Unit No. @{{ unit.intUnitId }}</u></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <div class="modal-footer">
        <button ng-show="unit.intUnitStatus == 1 && unit.show && unit.unitPrice != null"
                ng-click="addToCart(unit)"
                name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px;"><i class="material-icons">shopping_cart</i>Add to Cart</button>
        <button ng-hide="unit.unitPrice != null"
                href="{!! url('/price-maintenance') !!}"
                name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px;"><i class="material-icons">not_interested</i>Price is not yet configured.</button>
        <button ng-hide="unit.show" class="btn" disabled>ALREADY SELECTED</button>
        <button ng-hide="unit.show"
                ng-click="removeToCart(unit, $index)"
                name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px;"><i class="material-icons">not_interested</i>Remove to Cart</button>
        <button ng-show="unit.intUnitStatus == 2" name = "action" class="waves-light btn red modal-close" style = "color: #000000;"><i class="material-icons">not_interested</i>Cancel Reservation</button>
    </div>
</div>