<div id="editCart" class="modal modal-fixed-footer" style="overflow-y: hidden; height: 350px;">
    <div class="modal-header" style="background-color: #00897b; padding: 0px;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Edit Cart</h4></center>
        <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <form autocomplete="off" ng-submit='removeObject()'>
        <div class="modal-content" >
            <div class="row" style="margin-top: -10px">
            	<div class="col s1">
    	            <label style="color: #000000; font-size: 15px;">Name:</label>
                </div>
    			<div class="col s6">
                    <label style="color: #000000; font-size: 15px;">
                        <u ng-if='objectToRemove.intAdditionalId != null'>@{{ objectToRemove.strAdditionalName }}</u>
                        <u ng-if='objectToRemove.intServiceId != null'>@{{ objectToRemove.strServiceName }}</u>
                        <u ng-if='objectToRemove.intPackageId != null'>@{{ objectToRemove.strPackageName }}</u>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col s6" style="border: 3px solid #7b7073;">
                    <div class="row"><br>
                        <div class="col s6">
                            <label style="color: #000000; font-size: 15px;">Current Quantity:</label>
                        </div>
                        <div class="col s6">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ objectToRemove.intQuantity }}</u></label>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col s6">
                            <label style="color: #000000; font-size: 15px;"> Prev. Price:</label>
                        </div>
                        <div class="col s6">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ objectToRemove.intQuantity * objectToRemove.deciPrice | currency : 'P' }}</u></label>
                        </div>
                    </div>
                </div>
                <div class="col s6" style="border: 3px solid #7b7073;">
                    <div class="row"><br>
                        <div class="col s6">
                            <label style="color: #000000; font-size: 15px;">Quantity to Remove:</label>
                        </div>
                        <div class="col s6" style="margin-top: -20px;">
                            <input ng-model='objectToRemove.intQuantityToRemove' ui-number-mask='0' id="paid" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6" style="margin-top: 3px;">
                            <label style="color: #000000; font-size: 15px;">Total price:</label>
                        </div>
                        <div class="col s6">
                            <label style="color: #000000; font-size: 15px;"><u ng-if='objectToRemove.intQuantity >= objectToRemove.intQuantityToRemove'>@{{ (objectToRemove.intQuantity - objectToRemove.intQuantityToRemove) * objectToRemove.deciPrice | currency : 'P' }}</u></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Submit</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>