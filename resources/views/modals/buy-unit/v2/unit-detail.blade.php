<div id="unitDetails" class="modal modal-fixed-footer" style="overflow-y: hidden; height: 300px">
    <div class="modal-header">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont2; color: white;">Unit Details</h4></center>
    </div>
    <div class="modal-content">
        <div class="row">
            <div class="col s6">
                <div class="row">
                    <div class="input-field col s3">
                        <label>Unit:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>Unit No. @{{ unitView.intUnitId }}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <label>Building:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ unitView.strBuildingName }}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <label>Floor:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>Floor No. @{{ unitView.intFloorNo }}</u></label>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="row">
                    <div class="input-field col s3">
                        <label>Room:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ unitView.strRoomName }}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <label>Block:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>Block No. @{{ unitView.intBlockNo }}</u></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <label>Unit Price:</label>
                    </div>
                    <div class="input-field col s5">
                        <label><u>@{{ unitView.unitPrice.deciPrice|currency: "₱" }}</u></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Close</button>
    </div>
</div>