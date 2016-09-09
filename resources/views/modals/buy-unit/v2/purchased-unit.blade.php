<div id="purchaseduUnit" class="modal modal-fixed-footer" style="overflow-y: hidden; height: 390px;">
    <div class="modal-header" style="padding: 0px">
        <center>
            <h4 style = "font-size: 20px; color: white; padding: 20px;">Purchased Unit: 
                <u style = "font-size: 20px; color: white; padding: 20px;">Chenemer, Chenenen</u>
            </h4>
        </center>
        
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div class="modal-content" style="overflow-y: auto;">
        <div class="row" style="margin-top: -10px;">
            <div class="col s6" style="border: 1px solid #7b7073;">
                <center><h5>Unit</h5></center>
                <div class="row" style="margin-top: -30px;">
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
                        <label><b>Unit Type:</b></label>
                    </div>
                    <div class="input-field col s8">
                        <label><u>Columbary Vault</u></label>
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
                    <div class="input-field col s6">
                        <label><b>Payment Status:</b></label>
                    </div>
                    <div class="input-field col s6">
                        <label><u>Complete</u></label>
                    </div>
                </div>
                <br>
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
                        <label><u>Unit No. @{{ unit.intUnitId }}</u></label>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Close</button>
    </div>
</div>