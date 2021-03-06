<div id="scheduleService" class="modal modal-fixed-footer" style="width: 95%; max-height: 120%; overflow-y: hidden">
    <div class="modal-header1" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Assign Schedule</h4></center>
        
        <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <div class="modal-content" style="overflow-y: auto">
        <div class="row" style="margin-top: -25px;">
            <button tooltipped class="right add-toggle light-green nopadding btn" data-delay="50" data-tooltip="Add New Time"
                ng-click="addScheduleTime()" style = "color: #000000"><i class="material-icons" style="color: #000000">add</i> Time</button>
        </div>
        
        <div class="z-depth-2 card material-table row" style="margin-top: -10px;">
            <div class="cmxform" id="selectTime" style="margin-top: -10px;">
                <div class="table-header">
                    <left>
                        <div class="row" style="margin-left: -15px;">
                            <div class="input-field col s2" style="margin-top: 20px;">
                                <label for="sDate" style="color: #000000; font-weight: 900;">Date:</label>
                                <input type="date"
                                       ng-change="changeScheduleDate(serviceToSchedule,dateSchedule, scheduleLog)"
                                       ng-model="dateSchedule" style="margin-left: 55px; margin-top: 15px;">
                            </div>

                            <div class="input-field col s2" style="margin-left: 50px; margin-top: 20px;">
                                <label for="sDate" style="color: #000000; font-weight: 900;">Schedule Log:</label>
                            </div>

                            <div class="input-field col s3" style="margin-left: -20px; margin-top: 12px;">
                                <select ng-model="scheduleLog"
                                 ng-change="changeScheduleDate(serviceToSchedule,dateSchedule, scheduleLog)"
                                 ng-options="scheduleLog as scheduleLog.intScheduleLogNo for scheduleLog in scheduleLogList track by scheduleLog.intScheduleLogId" material-select watch required>
                                    <option value="" disabled selected>Select Schedule Log<span>*</span></option>
                                </select>
                            </div>

                            <div class="input-field col s2" style="margin-top: -40px; margin-left: 400px;">
                                <label for="room" style="color: #000000;"><span style="font-weight: 900;">Room: </span> 
                                <span style="padding-left: 15px;"><u ng-bind="scheduleLog.strRoomName"></u></span></label>
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
                                <input ng-model='newTime.timeStart' ui-time-mask='short' id="sTime" type="text" required="" aria-required="true" tooltipped class="validate" 
                                data-position = "bottom" data-delay = "30" data-tooltip = "24 Hours Format: Hour:Minute.<br>*Example: 13:00">
                                <label for="sTime" data-error = "24 Hrs Format">Start Time</label>
                            </div>
                            <div class="input-field col s3">
                                <input ng-model='newTime.timeEnd' ui-time-mask='short' id="eTime" type="text" tooltipped class="validate" required="" aria-required="true" 
                                data-position = "bottom" data-delay = "30" data-tooltip = "24 Hours Format: Hour:Minute.<br>*Example: 13:00">
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