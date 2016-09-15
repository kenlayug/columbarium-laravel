<!-- Main Form for Manage Service (Avail and Cancelation of transaction)-->
<div id="modalAddToCart" class="modal modal-fixed-footer" style="overflow: hidden; height: 390px;">
        <div class="modal-header">
            <center><label style="font-size: large">UNIT DETAILS</label></center>
            <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
        </div>

        <div id='viewDetails' class="modal-content" style="color: #000000;">
            <div class="row" style="margin-top: -20px;"><br>
                <div class="col s6" style="border: 1px solid #7b7073;">
                    <center><h5>Unit</h5></center>
                    <div class="row" style="margin-top: -40px;">
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
                        <div class="input-field col s8">
                            <label><u>@{{ unit.unitPrice.deciPrice|currency: "₱" }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Unit Type:</b></label>
                        </div>
                        <div class="input-field col s8">
                            <label><u>@{{ unit.strUnitTypeName }}</u></label>
                        </div>
                    </div>
                    <br><br><br>
                </div>
                <div class="col s6" style="border: 1px solid #7b7073;">
                    <center><h5>Location:</h5></center>
                    <div class="row" style="margin-top: -30px;">
                        <div class="input-field col s4">
                            <label><b>Building:</b></label>
                        </div>
                        <div class="input-field col s8">
                            <label><u>@{{ unit.strBuildingName }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Floor:</b></label>
                        </div>
                        <div class="input-field col s8">
                            <label><u>Floor No. @{{ unit.intFloorNo }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Room:</b></label>
                        </div>
                        <div class="input-field col s8">
                            <label><u>@{{ unit.strRoomName }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Block:</b></label>
                        </div>
                        <div class="input-field col s8">
                            <label><u>Block No. @{{ unit.intBlockNo }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <label><b>Unit:</b></label>
                        </div>
                        <div class="input-field col s8">
                            <label><u>@{{ unit.display }}</u></label>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>

    <div class="modal-footer">
        <div ng-show="unit != null">
            <button ng-show="unit.intUnitStatus == 1 && unit.show && unit.unitPrice != null
                        && downpayment != null && reservationFee != null && discountPayOnce != null
                        && pcf != null"
                    ng-click="addToCart(unit)"
                    name = "action" class="waves-light btn light-green modal-close" style = "color: #000000; margin-left: 10px; margin-right: 10px;"><i class="material-icons">shopping_cart</i>Add to Cart</button>
            <button ng-hide="unit.unitPrice != null"
                    href="{!! url('/price-maintenance') !!}"
                    name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px;"><i class="material-icons">not_interested</i>Price is not yet configured.</button>
            <button ng-hide="unit.show" class="btn" disabled>ALREADY SELECTED</button>
            <button ng-show="downpayment == null || reservationFee == null || discountPayOnce == null
                            || pcf == null" class="btn" disabled>BUSINESS DEPENDENCIES NEEDED IS NOT YET CONFIGURED!</button>
            <button ng-hide="unit.show"
                    ng-click="removeToCart(unit, $index)"
                    name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px;"><i class="material-icons">not_interested</i>Remove to Cart</button>
            <button ng-show="unit.intUnitStatus == 2"
                    ng-click='cancelReservation(unit)'
                    name = "action" class="waves-light btn red" style="margin-right: 10px;"><i class="material-icons">not_interested</i>Cancel Reservation</button>
            <button ng-click="switchAvailType(unit)" data-target="switch" ng-show="unit.intUnitStatus == 2" name = "action" class="waves-light btn light-green modal-trigger" href="#switch" style = "color: #000000; margin-right: 15px;"><i class="material-icons">swap_horiz</i>Switch Avail Type</button>
        </div>
    </div>
</div>