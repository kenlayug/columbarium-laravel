<div id="addToCartServices" class="modal modal-fixed-footer" style="overflow-y: hidden; width: 95%; max-height: 120%;">
    <div class="modal-header" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Add To Cart</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <form ng-submit='addToCart(serviceToAdd)' autocomplete="off">
        <div class="modal-content" style="overflow-y: auto; position: fixed; clear: bottom;">
            <div class="row" style="margin-top: -15px;">
                <div class="col s4" style="border: 3px solid #7b7073;">
                    <div class="row"><br>
                        <center>
                            <h6>Service Details:</h6>
                        </center>
                    </div>
                    <div class="row" style="margin-top: -10px"><br>
                    	<div class="col s4">
            	            <label style="color: #000000; font-size: 15px;">Name:</label>
                        </div>
            			<div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ serviceToAdd.strServiceName }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col s4">
            	            <label style="color: #000000; font-size: 15px;">Price:</label>
                        </div>
            			<div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ serviceToAdd.deciPrice | currency: 'P' }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col s4">
            	            <label style="color: #000000; font-size: 15px;">Quantity:</label>
                        </div>
            			<div class="col s8">
                            <input ng-model='serviceToAdd.intQuantity'
                                ng-change='changeQuantityService()'
                                ui-number-mask='0'
                                id="paid" type="text">
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px">
                    	<div class="col s4">
            	            <label style="color: #000000; font-size: 15px;">Total price:</label>
                        </div>
            			<div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ serviceToAdd.intQuantity * serviceToAdd.deciPrice | currency : 'P' }}</u></label>
                        </div>
                    </div>
                </div>
                
                <div class="col s8" style="margin-top: -5px;">
                    <div class="row">
                        <center><h6>Assign Schedule: </h6></center>
                    </div>
                    <div class='row' ng-hide='transactionPurchase.boolPreNeed != 1'>
                        <div class='col s12'>
                            <center><h4>Not Applicable for Pre Need.</h4></center>
                        </div>
                    </div>
                    <div class="z-depth-2 card material-table" ng-show='transactionPurchase.boolPreNeed != 1'>
                        <table style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th><center>Name</center></th>
                                    <th ng-show='serviceToAdd.intServiceType == 1'><center>Date<span style="color: red">*</span></center></th>
                                    <th ng-show='serviceToAdd.intServiceType == 1'><center>Time<span style="color: red">*</span></center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='service in serviceScheduleToAdd'>
                                    <td>
                                        <center ng-show='service.strDeceasedName != null'>@{{ service.strDeceasedName }}</center>
                                        <center ng-hide='service.strDeceasedName != null'>N/A</center>
                                    </td>
                                    <td ng-show='serviceToAdd.intServiceType == 1'><center ng-show='service.scheduleTime != null'>@{{ service.scheduleTime.dateSchedule  }}</center></td>
                                    <td ng-show='serviceToAdd.intServiceType == 1'><center ng-show='service.scheduleTime != null'>@{{ service.scheduleTime.timeStart | amDateFormat : 'hh:mm a' }}-@{{ service.scheduleTime.timeEnd | amDateFormat : 'hh:mm a'}}</center></td>
                                    <td>
                                        <center>
                                            <a ng-show='serviceToAdd.intServiceType == 1' ng-click='scheduleService(service)' data-target="scheduleService" class="btn-floating waves-light btn @{{ service.scheduleColor }} modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Schedule" 
                                            href="#scheduleService"><i class="material-icons" style = "color: #000000;">alarm_on</i></a>
                                            <a ng-show='serviceToAdd.intServiceForm == 1' ng-click='addDeceasedForm(service)' data-target="deceasedForm" class="btn-floating waves-light btn @{{ service.deceasedColor }} modal-trigger tooltipped" href="#deceasedForm" data-position="bottom" data-delay="50" data-tooltip="Edit Deceased Form" style="clear:bottom;"><i class="material-icons" style = "color: #000000;">assignment_ind</i></a>
                                            <a ng-show='serviceToAdd.intServiceForm == 2' data-target="unitForm" class="btn-floating waves-light btn light-green modal-trigger tooltipped" href="#unitForm" data-position="bottom" data-delay="50" data-tooltip="Edit Unit Form" style="clear:bottom;"><i class="material-icons" style = "color: #000000;">dashboard</i></a>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <i class = "left" style = "color: red; margin-top: 10px; margin-left: 15px;">*Required Fields</i>
                </div>
            </div>
            <br><br><br>
        </div>
        <div class="modal-footer">
            <label style="color: #00897b; font-size: 20px; margin-left: 15px;">LEGEND:</label>
            <button name = "action" class="btn-floating green" style="margin-left: 15px;"></button>
            <label style="font-size: 15px; color: #000000; font-size: 18px; margin-left: 5px;">Configured</label>
            <button name = "action" class="btn-floating red" style="margin-left: 15px;"></button>
            <label style="font-size: 15px; color: #000000; font-size: 18px; margin-left: 5px;">Not Configured</label>
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Add</button>
            <a ng-click='clearScheduleSelected(serviceScheduleToAdd)' name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>