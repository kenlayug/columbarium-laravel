<!-- Modal Update -->
<div id="modalUpdateBlock" class="modal modal-fixed-footer" style = "height: 300px; width: 450px;">
    <form ng-submit="saveUpdate()">
        <div class = "modal-header" style = "height: 55px;">
            <h4 style = "font-family: fontSketch; padding-left: 90px; padding-top: 0px; font-size: 2.3vw;">Update Block</h4>
        </div>
        <div class="modal-content">
            <div style = "padding-left: 10px;">
                <div class="input-field col s12">
                    <input ng-model="updateBlock.strBlockName" value=" " id="newBlockName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Block One" required = "" aria-required = "true" length = "50" maxlength = "50">
                    <label class = "active" for="newBlockName" data-error = "Invalid format." data-success = "">New Name<span style = "color: red;">*</span></label>
                </div>
            </div>
            <i class = "left" style = "padding-top: 10px; padding-left: 20px; color: red;">*Required Fields</i>
        </div>
        <br><br><br><br>
        <div class="modal-footer">
            <button type = "submit" name = "action" class="btn light-green" style = "margin-right: 20px; color: black; margin-left: 10px; ">Confirm</button>
            <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
        </div>
    </form>
</div>