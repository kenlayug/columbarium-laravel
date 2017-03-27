<div id="scheduleService" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden">
    <div class="modal-header1" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Assign Schedule</h4></center>
        <button class="add-toggle light-green nopadding btn tooltipped" data-delay="50" data-tooltip="Add New Time"
                ng-click="createTime(serviceToSchedule.intServiceCategoryId)"
                style = "margin-left: 880px; margin-top: -75px; color: #000000"><i class="material-icons" style="color: #000000">add</i> Time</button>
    </div>
    <div class="modal-content" style="overflow-y: auto">
        <div class="z-depth-2 card material-table" style="margin-top: -10px;">
            <div class="cmxform" id="selectTime" method="get" autocomplete="off" style="margin-top: -10px;">
                <div class="table-header">
                    <left>
                        <div class="row" style="margin-left: -15px;">
                            <div class="input-field col s4">
                                <label for="sDate">Date:</label>
                            </div>
                            <div class="input-field col s8" style="margin-left: 55px;">
                                <input type="date"
                                       ng-change="getScheduleDate(schedule.dateSchedule)"
                                       ng-model="schedule.dateSchedule">
                            </div>
                        </div>
                    </left>
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
                            <td class="center">@{{ serviceSchedule.timeStart | amAdd : serviceCategoryToSched.intMinuteOfService : 'minutes' | amDateFormat: 'hh:mm a' }}</td>
                            <td class="center">@{{ serviceSchedule.displayStatus }}</td>
                            <td class="center">
                                <button class="light-green waves-light btn"
                                        ng-disabled="serviceSchedule.status != null"
                                        ng-click="setServiceSchedule(serviceSchedule)"
                                        style="cursor: not-allowed; color: #000000">Select</button>
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