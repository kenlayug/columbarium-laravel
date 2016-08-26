<div id="scheduleService" class="modal modal-fixed-footer" style="width: 95%; max-height: 120%; overflow-y: hidden">
    <div class="modal-header1" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; font-family: myFirstFont2; color: white; padding: 20px;">Assign Schedule</h4></center>
        
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <div class="modal-content" style="overflow-y: auto">
        <div class="row" style="margin-top: -25px;">
            <button class="right add-toggle light-green nopadding btn tooltipped" data-delay="50" data-tooltip="Add New Time"
                ng-click="addScheduleTime()" style = "color: #000000"><i class="material-icons" style="color: #000000">add</i> Time</button>
        </div>
        
        <div class="z-depth-2 card material-table row" style="margin-top: -10px;">
            <div class="cmxform" id="selectTime" style="margin-top: -10px;">
                <div class="table-header">
                    <left>
                        <div class="row" style="margin-left: -15px;">
                            <div class="input-field col s4">
                                <label for="sDate" style="color: #000000;">Date:</label>
                            </div>
                            <div class="input-field col s8" style="margin-left: 55px;">
                                <input type="date"
                                       ng-change="changeScheduleDate(serviceToSchedule,dateSchedule)"
                                       ng-model="dateSchedule">
                            </div>
                        </div>
                    </left>
                </div>
                <div id="addTime" ng-show='showAddTime' style="background-color: rgba(10, 193, 232, 0.12); margin-top: 0;">
                    <form ng-submit='saveTime()' autocomplete="off">
                        <div class="row">
                            <div class="input-field col s2">
                                <label>Add Time:</label>
                            </div>
                            <div class="input-field col s3">
                                <input ng-model='newTime.timeStart' ui-time-mask='short' id="sTime" type="text" required="" aria-required="true" class="validate" pattern= "([01]?[0-9]|2[0-3]):[0-5][0-9]">
                                <label for="sTime" data-error = "24 Hrs Format">Start Time</label>
                            </div>
                            <div class="input-field col s3">
                                <input ng-model='newTime.timeEnd' ui-time-mask='short' id="eTime" type="text" class="validate" required="" aria-required="true" class="validate" pattern= "([01]?[0-9]|2[0-3]):[0-5][0-9]">
                                <label for="eTime" data-error = "24 Hrs Format">End Time</label>
                            </div>
                            <div class="input-field col s3">
                                <button type='action' name='submit' class="light-green waves-light btn" style="text-align: center; color: #000000">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <table style="width: 100% !important; table-layout: fixed">
                        <thead>
                        <tr>
                            <th class="center">Start Time</th>
                            <th class="center">End Time</th>
                            <th class="center">Status</th>
                            <th class="center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="serviceSchedule in serviceScheduleList">
                            <td class="center">@{{ serviceSchedule.timeStart | amDateFormat : 'hh:mm a' }}</td>
                            <td class="center">@{{ serviceSchedule.timeEnd | amDateFormat: 'hh:mm a' }}</td>
                            <td class="center">@{{ serviceSchedule.status }}</td>
                            <td class="center">
                                <button class="light-green waves-light btn"
                                        ng-disabled="serviceSchedule.status != 'Available'"
                                        ng-click="setTime(serviceSchedule)"
                                        style="color: #000000">Select</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
</div>
<script type="text/javascript">
    $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });
</script>>