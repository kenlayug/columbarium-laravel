<div id="cheque" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Cheque Details</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <div class="modal-content">
        <div class="row">
            <div class="input-field col s6">
                <input id="drawee" type="text">
                <label for="drawee">Drawee<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s6">
                <input id="chequeNumber" type="text">
                <label for="chequeNumber">Cheque Number<span style = "color: red;">*</span></label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="holderName" type="text">
                <label for="holderName">Account Holder's Name<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s6">
                <input id="accountNumber" type="text">
                <label for="accountNumber">Account Number<span style = "color: red;">*</span></label>
            </div>
        </div>
        <i class = "left" style = "margin-top: 0px; margin-bottom: 50px; padding-left: 15px; color: red;">*Required Fields</i>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>