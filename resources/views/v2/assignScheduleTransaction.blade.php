@extends('v2.baseLayout')
@section('title', 'Manage Schedule')
@section('body')

<script type="text/javascript" src="{!! asset('/js/assignSchedule.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/assign-schedule/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/assignSched.css') !!}">
<script src="{!! asset('/js/tooltip.js') !!}"></script>
    
<div ng-controller='ctrl.assign-schedule'>
    <div class = "col s12" >
        
        <div class = "row" style="margin-top: -25px;">
            <div id="borderLeftSide" class = "col s8">
                <div class="row" style="margin-top: 55px;">
                    <center><h4 id="headerTitle"><span>Manage Schedule</span></h4></center>
                </div>
                <div class = "col s12">
                    <div class="input-field row" style="margin-top: 17px;">
                        <div class="input-field col s1">
                            <label for="sDate" style="color: #000000; font-size: 20px;">Date:</label>
                        </div>
                        <div class="input-field col s3">
                            <input ng-change='changeScheduleList()' ng-model='filter.dateSchedule' id="dateSchedule" type="date" required="" aria-required="true" tooltipped class="datepicker" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                        </div>
                        <div class="input-field col s1">
                            <label style="color: #000000; font-size: 20px;">Service:</label>
                        </div>
                        <div class="col s3" style="margin-top: 14px; margin-left: 20px;">
                            <select ng-change='changeServiceCategory()' ng-model='filter.intServiceCategoryId' material-select watch>
                                <option value="" disabled selected>Choose your filter</option>
                                <option ng-repeat='serviceCategory in serviceCategoryList' value="@{{ serviceCategory.intServiceCategoryId }}">@{{ serviceCategory.strServiceCategoryName }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s2">
                            <label style="color: #000000; font-size: 20px;">Schedule Log:</label>
                        </div>
                        <div class="col s2" style="margin-top: 14px;">
                            <select ng-change='changeScheduleList()' ng-model='filter.scheduleLog' ng-options="scheduleLog as scheduleLog.intScheduleLogNo for scheduleLog in scheduleLogList track by scheduleLog.intScheduleLogId" material-select watch>
                                <option value="" disabled selected>Select Log</option>
                            </select>
                        </div>
                        <div class="input-field col s4">
                            <label style="color: #000000; font-size: 20px;">Room: @{{ filter.scheduleLog.strRoomName }}</label>
                        </div>
                        <div class="col s4">
                            <button data-target="reSchedList" class="waves-light btn light-green modal-trigger" href="#reSchedList" style = "color: #000000; padding-left: 10px; padding-right: 10px; font-size: 13px; margin-top: 20px;">Unscheduled Services List</button>
                        </div>
                    </div>

                    <div class="row aside z-depth-1" style="margin-top: -10px;">
                        <div style="background-color: #00897b; border: 1px solid #b0bec5; padding: 15px;">
                            <center><label style="color: #ffffff; font-size: 20px;">Scheduled Service</label></center>
                            <label class="right" style="color: #ffffff; font-size: 18px; margin-top: -30px;">Date : <u>@{{ filter.dateSchedule }}</u></label>
                        </div>

                        <!-- Service Notification List -->
                        <div id="chatlist" class = "mousescroll" style="max-height: 515px; table-layout: fixed;">
                            <table ng-show='scheduleList.length != 0' ng-hide='loading'>
                                <thead>
                                    <br>
                                    <th class="center">Time</th>
                                    <th class="center">Customer Name</th>
                                    <th class="center">Status</th>
                                    <th class="center">Action</th>
                                </thead>
                                <tbody>
                                <tr ng-repeat='schedule in scheduleList'>
                                    <td class="center">@{{ schedule.timeStart }} - @{{ schedule.timeEnd }}</td>
                                    <td class="center">
                                        <span ng-if='schedule.strFirstName != null'>@{{ schedule.strLastName+', '+schedule.strFirstName+' '+schedule.strMiddleName }}</span>
                                    </td>
                                    <td class="center">@{{ scheduleStatusList[schedule.status] }}</td>
                                    <td class="center">
                                        <div ng-if='schedule.status == 2'>
                                            <button ng-disabled='((scheduleList[$index-1].status == 2 || scheduleList[$index-1].status == 5) && $index != 0) || dateNow != filter.dateSchedule' ng-click='processSchedule(schedule, "process")' tooltipped class="btn-floating waves-light btn light-green" data-position="bottom" data-delay="50" data-tooltip="Process"><i class="material-icons" style = "color: #000000;">work</i></button>

                                            <button ng-click='reschedule(schedule)' data-target="scheduleService" tooltipped class="btn-floating waves-light btn light-green modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Reschedule"
                                            href="#scheduleService"><i class="material-icons" style = "color: #000000;">restore</i></button>

                                            <button ng-click='cancelSchedule(schedule)' tooltipped class="btn-floating waves-light btn light-green" data-position="bottom" data-delay="50" data-tooltip="Cancel"
                                            ><i class="material-icons" style = "color: #000000;">not_interested</i></button>
                                        </div>
                                        <div ng-if='schedule.status == 5'>
                                            <button ng-click='processSchedule(schedule, "stop")' data-target="scheduleService" tooltipped
                                            class="btn waves-light btn light-green modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Reschedule"
                                            href="#scheduleService" style = "color: #000000;">Conclude</button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div ng-hide='scheduleList.length != 0' class='center'>No schedule yet for this day.<br></div>
                            <div ng-show='loading' class='center'>Fetching Schedule...<br></div>
                        </div>    
                    </div>  
                </div>
            </div>

            
            <div id="borderRightSide" class = "col s4 aside" style="margin-top: 45px; width: 400px; margin-left: 15px;">
                <div class="row">
                    <div class = "col s12">
                        <div class = "aside aside z-depth-3" style = "height: 190px;">
                            <div class="heaeder" style="background-color: #00897b; border: 1px solid #b0bec5; padding: 15px;">
                                <center><label style="color: #ffffff; font-size: 20px;">Legend</label></center>
                            </div>

                            <div class = "row" style = "margin-top: 10px;">
                                <center>
                                    <div class="row">
                                        <div class = "col s4">
                                            <i class="material-icons">offline_pin</i><br>
                                            <label style="font-size: 15px; color: #000000;">Finished</label>
                                        </div>
                                        <div class = "col s4">
                                            <i class="material-icons">query_builder</i><br>
                                            <label style="font-size: 15px; color: #000000;">Ongoing</label>
                                        </div>
                                        <div class = "col s4">
                                            <i class="material-icons">alarm_on</i><br>
                                            <label style="font-size: 15px; color: #000000;">Scheduled</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class = "col s6">
                                            <i class="material-icons">restore</i><br>
                                            <label style="font-size: 15px; color: #000000;">Rescheduled</label>
                                        </div>
                                        <div class = "col s6">
                                            <i class="material-icons">not_interested</i><br>
                                            <label style="font-size: 15px; color: #000000;">Canceled</label>
                                        </div>
                                    </div><br>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>


                

                <div class="row aside z-depth-1">
                    <div style="background-color: #00897b; border: 1px solid #b0bec5; padding: 15px;">
                            <center><label style="color: #ffffff; font-size: 20px;">Schedule Logs</label></center>
                    </div>

                    <!-- Service Notification List -->
                    <div scroll-glue id="chatlist" class = "mousescroll" style="max-height: 330px;">
                        <div ng-show='scheduleDetailLogList.length == 0' style="background-color: #fafafa; border: 1px solid #b0bec5;">
                            <div class="center row"><br>
                                <label>No schedule actions.</label>
                            </div>
                        </div>
                        <div ng-hide='scheduleDetailLogList.length == 0' ng-repeat='scheduleDetailLog in scheduleDetailLogList'>
                            <!-- Service Done -->
                            <div style="background-color: #fafafa; border: 1px solid #b0bec5;">
                                <div class="row"><br>
                                    <div class="col s2"><i class="material-icons">@{{ icons[scheduleDetailLog.intScheduleStatus] }}</i></div>
                                    <div class="col s10">
                                        <label>@{{ scheduleStatusList[scheduleDetailLog.intScheduleStatus] }}: @{{ scheduleDetailLog.strServiceCategoryName }}</label><br>
                                        <label>Date: @{{ scheduleDetailLog.dateSchedule | amDateFormat : 'MMMM DD, YYYY' }}</label><br>
                                        <label>Schedule Time: @{{ scheduleDetailLog.timeStart }} - @{{ scheduleDetailLog.timeEnd }}</label><br>
                                        <label>Customer Name: @{{ scheduleDetailLog.strLastName+', '+scheduleDetailLog.strFirstName+' '+scheduleDetailLog.strMiddleName }}</label><br>
                                        <label class='right' style='color : gray;' am-time-ago="scheduleDetailLog.created_at"></label><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>

                
            </div>
        </div>
        @include('modals.service-purchases.deceasedForm')
        @include('modals.service-purchases.newDeceasedForm')
        @include('modals.service-purchases.scheduleService')
        @include('modals.assign-schedule.scheduledServices')
        @include('modals.assign-schedule.rescheduledServices')
        @include('modals.assign-schedule.unscheduledServices')
        @include('modals.assign-schedule.successReschedService')
        @include('modals.assign-schedule.successSchedService')
    </div>

    <script>
        $('.datepicker').pickadate({
            selectMonths: true,//Creates a dropdown to control month
            selectYears: 15,//Creates a dropdown of 15 years to control year
//The title label to use for the month nav buttons
            labelMonthNext: 'Next Month',
            labelMonthPrev: 'Last Month',
//The title label to use for the dropdown selectors
            labelMonthSelect: 'Select Month',
            labelYearSelect: 'Select Year',
//Months and weekdays
            monthsFull: [ 'January', 'February', 'March', 'April', 'March', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
            monthsShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mar', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
            weekdaysFull: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ],
            weekdaysShort: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ],
//Materialize modified
            weekdaysLetter: [ 'S', 'M', 'T', 'W', 'T', 'F', 'S' ],
//Today and clear
            today: 'Today',
            clear: 'Clear',
            close: 'Close',
//The format to show on the `input` element
            format: 'mm/dd/yyyy',
        });
    </script>

</div>

@endsection