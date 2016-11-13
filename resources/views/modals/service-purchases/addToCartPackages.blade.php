<div id="addToCartPackages" class="modal modal-fixed-footer" style="overflow-y: hidden; width: 95%; max-height: 120%;">
    <div class="modal-header" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Add To Cart</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <form autocomplete="off" ng-submit='addToCart(packageToAdd)'>
        <div class="modal-content" style="overflow-y: auto; position: fixed; clear: bottom;">
            <div class="row" style="margin-top: -15px;">
                <div class="col s4" style="border: 3px solid #7b7073;">
                    <div class="row"><br>
                        <center>
                            <h6>Package Details:</h6>
                        </center>
                    </div>
                    <div class="row" style="margin-top: -10px"><br>
                    	<div class="col s4">
            	            <label style="color: #000000; font-size: 15px;">Name:</label>
                        </div>
            			<div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ packageToAdd.strPackageName }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col s4">
            	            <label style="color: #000000; font-size: 15px;">Price:</label>
                        </div>
            			<div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ packageToAdd.deciPrice | currency : 'P' }}</u></label>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col s4">
            	            <label style="color: #000000; font-size: 15px;">Quantity:</label>
                        </div>
            			<div class="col s8">
                            <input ng-model='packageToAdd.intQuantity'
                             ng-change='changePackageQuantity(packageToAdd)'
                             ui-number-mask='0' id="paid" type="text">
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px">
                    	<div class="col s5">
            	            <label style="color: #000000; font-size: 15px;">Total price:</label>
                        </div>
            			<div class="col s7">
                            <label style="color: #000000; font-size: 15px;"><u>@{{ packageToAdd.deciPrice * packageToAdd.intQuantity | currency : 'P'}}</u></label>
                        </div>
                    </div>
                </div>
                
                <div class="col s8" style="margin-top: -5px;">
                    <div class="row">
                        <center><h6>Additionals: </h6></center>
                    </div>
                    <div class="z-depth-2 card material-table">
                        <table style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th><center>Name</center></th>
                                    <th><center>Quantity</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='additional in packageToAdd.additionalList'>
                                    <td><center>@{{ additional.strAdditionalName }}</center></td>
                                    <td><center>@{{ additional.intQuantity * packageToAdd.intQuantity }}</center></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <center><h6>Assign Schedule: </h6></center>
                    </div>
                    <div class="z-depth-2 card material-table">
                        <table style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th><center>Name</center></th>
                                    <th><center>Deceased Name</center></th>
                                    <th><center>Date<span style="color: red">*</span></center></th>
                                    <th><center>Time<span style="color: red">*</span></center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='service in packageToAdd.serviceList'>
                                    <td><center>@{{ service.strServiceName }}</center></td>
                                    <td>
                                        <center ng-show='service.strDeceasedName != null'>@{{ service.strDeceasedName }}</center>
                                        <center ng-hide='service.strDeceasedName != null'>N/A</center>
                                    </td>
                                    <td ng-show='service.intServiceType == 1'><center ng-show='service.scheduleTime != null'>@{{ service.scheduleTime.dateSchedule  }}</center></td>
                                    <td ng-show='service.intServiceType == 1'><center ng-show='service.scheduleTime != null'>@{{ service.scheduleTime.timeStart | amDateFormat : 'hh:mm a' }}-@{{ service.scheduleTime.timeEnd | amDateFormat : 'hh:mm a'}}</center></td>
                                    <td>
                                        <center>
                                            <a ng-show='service.intServiceType == 1' ng-click='scheduleService(service)' data-target="scheduleService" class="btn-floating waves-light btn @{{ service.scheduleColor }} modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Schedule" 
                                            href="#scheduleService"><i class="material-icons" style = "color: #000000;">alarm_on</i></a>
                                            <a ng-show='service.intServiceForm == 1' ng-click='addDeceasedForm(service)' data-target="deceasedForm" class="btn-floating waves-light btn @{{ service.deceasedColor }} modal-trigger tooltipped" href="#deceasedForm" data-position="bottom" data-delay="50" data-tooltip="Edit Deceased Form" style="clear:bottom;"><i class="material-icons" style = "color: #000000;">assignment_ind</i></a>
                                            <a ng-show='service.intServiceForm == 2' data-target="unitForm" class="btn-floating waves-light btn light-green modal-trigger tooltipped" href="#unitForm" data-position="bottom" data-delay="50" data-tooltip="Edit Unit Form" style="clear:bottom;"><i class="material-icons" style = "color: #000000;">dashboard</i></a>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <i class = "left" style = "color: red; margin-top: 10px; margin-left: 15px;">*Required Fields</i><br><br>
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
            <a ng-click='clearScheduleSelected(packageToAdd.serviceList)' name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </form>
</div>