<div id="cheque" class="modal modal-fixed-footer" style="overflow-y: hidden;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Cheque Details</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <div class="modal-content" style="overflow-y: auto;">
        <div class="row">
            <div class="input-field col s6">
                <input id="drawee" type="text" class="validate tooltipped" 
                    data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Metro bank" 
                    required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" 
                    ng-pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                <label for="drawee" data-error = "INVALID" data-success = "">Drawee(Bank)<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s6">
                <input id="receiver" type="text" class="validate tooltipped" 
                    data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Diaz, Emely" 
                    required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" 
                    ng-pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                <label for="receiver" data-error = "INVALID" data-success = "">Payee (Receiver)<span style = "color: red;">*</span></label>
               
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="chequeNumber" type="number" class="validate tooltipped" 
                    data-position = "bottom" data-delay = "30" data-tooltip = "Accepts number only.<br>*Example: 11049812341" 
                    required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                <label for="chequeNumber" data-error = "INVALID" data-success = "">Cheque Number<span style = "color: red;">*</span></label>
            </div>
            <div class="input-field col s6">
                <input id="cDueDate" type="date" class="datepicker tooltipped" validate 
                    data-position = "bottom" data-delay = "30" data-tooltip = "Format: mm/dd/yyyy.<br>*Example: 09/18/2016"
                    required = "" aria-required="true">
                <label for="cDueDate" data-error = "INVALID" data-success = "">Cheque Due Date<span style = "color: red;">*</span></label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="holderName" type="text" class="validate tooltipped" 
                    data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Diaz, Emely" 
                    required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" 
                    ng-pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                <label for="holderName" data-error = "INVALID" data-success = "">Account Holder's Name<span style = "color: red;">*</span></label>
            
            </div>
            <div class="input-field col s6">
                <input id="accountNumber" type="number" class="validate tooltipped" 
                    data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Metro bank" 
                    required = "" aria-required="true" minlength = "1" maxlength="50" length = "50">
                <label for="accountNumber" data-error = "INVALID" data-success = "">Account Number<span style = "color: red;">*</span></label>
            
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
        <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
    </div>
</div>