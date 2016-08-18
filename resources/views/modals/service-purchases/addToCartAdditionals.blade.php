<div id="addToCartAdditionals" class="modal modal-fixed-footer" style="overflow-y: hidden; width: 500px; height: 350px;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont2; color: white; padding: 20px;">Add To Cart</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <form autocomplete="off" ng-submit='addToCart(additionalToAdd)'>
        <div class="modal-content" >
            <div class="row" style="margin-top: -10px">
            	<div class="col s4">
    	            <label style="color: #000000; font-size: 15px;">Name:</label>
                </div>
    			<div class="col s8">
                    <label style="color: #000000; font-size: 15px;"><u>@{{ additionalToAdd.strAdditionalName }}</u></label>
                </div>
            </div>
            <div class="row">
            	<div class="col s4">
    	            <label style="color: #000000; font-size: 15px;">Price:</label>
                </div>
    			<div class="col s8">
                    <label style="color: #000000; font-size: 15px;"><u>@{{ additionalToAdd.deciPrice | currency : 'P'}}</u></label>
                </div>
            </div>
            <div class="row">
            	<div class="col s4">
    	            <label style="color: #000000; font-size: 15px;">Quantity:</label>
                </div>
    			<div class="col s8">
                    <input ng-model='additionalToAdd.intQuantity'
                        ui-number-mask='0'
                        id="paid" type="text">
                </div>
            </div>
            <div class="row" style="margin-top: -10px">
            	<div class="col s4">
    	            <label style="color: #000000; font-size: 15px;">Total price:</label>
                </div>
    			<div class="col s8">
                    <label style="color: #000000; font-size: 15px;"><u>@{{ additionalToAdd.intQuantity * additionalToAdd.deciPrice | currency : 'P'}}</u></label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green modal-close" style = "color: #000000;margin-left: 15px; margin-right: 15px">Add</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>