<div id="modalCreateBlock" class="modal modal-fixed-footer" style = "height: 400px; width: 550px;">
    <div class = "modal-header" style = "height: 55px;">
        <h4 style = "font-family: fontSketch; font-size: 2.3vw; padding-left: 150px; padding-top: 0px;">Create Block</h4>
    </div>
    <form id="createBlockForm" style = "padding-bottom: 0px;" ng-submit="createBlock()">
        <div style = "margin-top: 0px; padding-top: 0px; padding-left: 10px;">
            <div class="row" style = "padding-top: 0px;">
                <h5 style = "padding-bottom: 0px; font-family: arial; font-size: 20px;">Block size:</h5>
                <div class="input-field col s6" style = "padding-left: 10px;">
                    <input ng-model="newBlock.intLevelNo" id="blockLevel" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only. Max input: 10<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "10">
                    <label for="blockLevel" data-error = "1-10 only" data-success = "">Level/s:<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s6">
                    <input ng-model="newBlock.intColumnNo" id="blockColumn" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only. Max input: 20<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "20">
                    <label for="blockColumn" data-error = "1-20 only" data-success = "">Unit/s:<span style = "color: red">*</span></label>
                </div>
                <div class="input-field col s6" id="divUnitType">
                    <input ng-model="newBlock.intUnitType" type="radio" name="unitType" value="1" id="columbary">
                    <label for="columbary">Columbary Vault</label>
                    <input ng-model="newBlock.intUnitType" type="radio" name="unitType" value="2" id="fullbody">
                    <label for="fullbody">Full Body Crypt</label>
                </div>
            </div>
        </div>

        <i class = "left" style = "padding-top: 20px; margin-bottom: 0px; padding-left: 30px; color: red;">*Required Fields</i>
        <div style = "margin-top: 50px;">
            <div class="modal-footer">
                <button name = "action" class="btn light-green" style = "color: black; margin-left: 10px;">Confirm</button>
                <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
            </div>
        </div>
    </form>
</div>