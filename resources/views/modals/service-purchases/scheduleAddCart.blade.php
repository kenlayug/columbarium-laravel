<div id="scheduleAddCart" class="modal modal-fixed-footer" style="overflow-y: hidden; width: 95%; max-height: 120%;">
    <div class="modal-header" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Schedule Cart</h4></cesnter>
        <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <div class="modal-content" style="overflow-y: auto; position: fixed; clear: bottom;">

        <div class="row" style="margin-top: -10px">
            <div class="col s1">
                <label style="color: #000000; font-size: 15px;">Name:</label>
            </div>
            <div class="col s6">
                <label style="color: #000000; font-size: 15px;">
                    <u ng-if='updateObjectCart.intServiceId != null'>@{{ updateObjectCart.strServiceName }}</u>
                    <u ng-if='updateObjectCart.intPackageId != null'>@{{ updateObjectCart.strPackageName }}</u>
                </label>
            </div>
        </div>

        <br>

        <div class="row" style="margin-top: -20px;">
            <div ng-show="transactionPurchase.boolPreNeed == 1">
                <h4>Not Applicable</h4>
            </div>
            <div class="card material-table" ng-hide="transactionPurchase.boolPreNeed == 1">
                <table style="table-layout: fixed;">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='serviceSchedule in updateObjectCart.serviceList'>
                            <td>@{{ serviceSchedule.strServiceName }}</td>
                            <td>@{{ serviceSchedule.strDeceasedName }}</td>
                            <td>@{{ serviceSchedule.scheduleTime.dateSchedule }}</td>
                            <td>@{{ serviceSchedule.scheduleTime.timeStart | amDateFormat : 'hh:mm a'}}-@{{ serviceSchedule.scheduleTime.timeEnd | amDateFormat : 'hh:mm a'}}</td>
                            <td>
                                <center>
                                    <a ng-click='scheduleService(serviceSchedule)' ng-show='serviceSchedule.intServiceCategoryId == 1' data-target="scheduleService" class="btn-floating waves-light btn light-green modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reschedule" 
                                        href="#scheduleService"><i class="material-icons" style = "color: #000000;">alarm_on</i></a>
                                    <a ng-click='addDeceasedForm(serviceSchedule)' ng-show='serviceSchedule.intDeceasedId != null' data-target="deceasedForm" class="btn-floating waves-light btn light-green modal-trigger tooltipped" href="#deceasedForm" data-position="bottom" data-delay="50" data-tooltip="Edit Deceased Form" style="clear:bottom;"><i class="material-icons" style = "color: #000000;">assignment_ind</i></a>
                                    <a ng-show='serviceSchedule.intServiceForm == 2' data-target="unitForm" class="btn-floating waves-light btn light-green modal-trigger tooltipped" href="#unitForm" data-position="bottom" data-delay="50" data-tooltip="Edit Unit Form" style="clear:bottom;"><i class="material-icons" style = "color: #000000;">dashboard</i></a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><br><br>
    </div>
    <div class="modal-footer">
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Close</a>
    </div>
</div>