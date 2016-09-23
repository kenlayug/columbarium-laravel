<div id="sched" class="modal modal-fixed-footer" style="width:95%; max-height: 120%;">
    <div class="modal-header" style="background-color: #00897b;">
        <h5 style = "color: white; text-align: center; font-size: 20px; padding: 20px; margin-top: 0px;">Aaron Clyde Garil: Pre-Need Services</h5>
        <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div id="admin" class="modal-content" style="overflow-y: auto">
        <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
            <table datatable="ng">
                <thead>
                <tr>
                    <th class="center" style="font-size: 16px;">Package Name</th>
                    <th class="center" style="font-size: 16px;">Additional/Service Name</th>
                    <th class="center" style="font-size: 16px;">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="unschedule in unscheduleList">
                    <td class="center" ng-bind="unschedule.strPackageName"></td>
                    <td class="center" ng-bind="unschedule.strName"></td>
                    <td class="center">
                        <button ng-show="unschedule.intType == 2" class="waves-light btn light-green" style="color: #000000;">Claim</button>
                        <button ng-show="unschedule.intType == 1" ng-click="schedule(unschedule)" class="btn-floating waves-light btn red modal-trigger" data-target="scheduleService" tooltipped 
                                href="#scheduleService" data-position="bottom" data-delay="30" data-tooltip="Schedule Service">
                                <i class="material-icons" style="color: #000000">schedule</i></button>
                        <button ng-show="unschedule.intType == 1" class="btn-floating waves-light btn red modal-trigger" data-target="scheduleService" tooltipped 
                                href="#deceasedForm" data-position="bottom" data-delay="30" data-tooltip="Assign Deceased">
                                <i class="material-icons" style="color: #000000">assignment_ind</i></button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <label style="color: #00897b; font-size: 20px; margin-left: 15px;">LEGEND:</label>
        <button name = "action" class="btn-floating green" style="margin-left: 15px;"></button>
        <label style="font-size: 15px; color: #000000; font-size: 18px; margin-left: 5px;">Configured</label>
        <button name = "action" class="btn-floating red" style="margin-left: 15px;"></button>
        <label style="font-size: 15px; color: #000000; font-size: 18px; margin-left: 5px;">Not Configured</label>
    </div>
</div>