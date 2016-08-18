@extends('v2.baseLayout')
@section('title', 'Assign Schedule')
@section('body')

<script type="text/javascript" src="{!! asset('/js/assignSchedule.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/assign-schedule/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/assignSched.css') !!}">

    
<div ng-controller='ctrl.assign-schedule'>
    <div class = "col s12" >
        <div class="row">
            <center>
                <h4 style = "margin-top: 20px; font-family: myFirstFont2;">Assign Schedule</h4>    
            </center>
        </div>
        <div class = "row" style="margin-top: -25px;">
            <div class = "col s8">
                <div class = "col s12">
                <div class="input-field row" style="margin-top: 17px;">
                    <div class="input-field col s1">
                        <label for="sDate" style="color: #000000;">Date:</label>
                    </div>
                    <div class="input-field col s3">
                        <input ng-change='changeScheduleList()' ng-model='filter.dateSchedule' id="dateSchedule" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                    </div>
                    <div class="col s4" style="margin-top: 14px;">
                        <select ng-change='changeScheduleList()' ng-model='filter.intServiceCategoryId' material-select watch>
                            <option value="" disabled selected>Choose your filter</option>
                            <option ng-repeat='serviceCategory in serviceCategoryList' value="@{{ serviceCategory.intServiceCategoryId }}">@{{ serviceCategory.strServiceCategoryName }}</option>
                        </select>
                        <label style="margin-left: 280px; margin-top: 15px;">Service Name</label>
                    </div>
                </div>

                    <div class="row aside z-depth-1" style="margin-top: -10px;">
                        <div style="background-color: #00897b; border: 1px solid #b0bec5; padding: 15px;">
                            <center><label style="font-family: myFirstFont2; color: #ffffff; font-size: 20px;">Scheduled Service</label></center>
                            <label class="right" style="color: #ffffff; font-size: 18px; margin-top: -30px;">Date : <u>@{{ filter.dateSchedule }}</u></label>
                        </div>

                        <!-- Service Notification List -->
                        <div id="chatlist" class = "mousescroll" style="max-height: 515px; table-layout: fixed;">
                            <table>
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
                                        <span ng-if='schedule.status.strFirstName != null'>@{{ schedule.status.strLastName+', '+schedule.status.strFirstName+' '+schedule.status.strMiddleName }}</span>
                                        <span ng-if='schedule.status.strFirstName == null'>N/A</span>
                                    </td>
                                    <td class="center">@{{ scheduleStatusList[schedule.status.intScheduleStatus] }}</td>
                                    <td class="center">
                                        <div ng-if='schedule.status.intScheduleStatus == 2'>
                                            <button ng-disabled='scheduleList[$index-1].status.intScheduleStatus != 6 || $index == 0' ng-click='processSchedule(schedule, "process")' class="btn-floating waves-light btn light-green btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Process"><i class="material-icons">work</i></button>

                                            <button data-target="scheduleService" class="btn-floating waves-light btn light-green modal-trigger btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reschedule"
                                            href="#scheduleService"><i class="material-icons" style = "color: #000000;">restore</i></button>

                                            <button class="btn-floating waves-light btn light-green btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cancel"
                                            ><i class="material-icons" style = "color: #000000;">not_interested</i></button>
                                        </div>
                                        <div ng-if='schedule.status.intScheduleStatus == 5'>
                                            <button ng-click='processSchedule(schedule, "stop")' data-target="scheduleService" class="btn waves-light btn light-green modal-trigger btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reschedule"
                                            href="#scheduleService">Stop</button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>    
                    </div>  
                </div>
            </div>

            
            <div class = "col s4 aside" style="margin-top: 45px; width: 400px; margin-left: 15px;">
                <div class="row">
                    <center><button data-target="reSchedList" class="waves-light btn light-green modal-trigger" href="#reSchedList" style = "color: #000000; padding-left: 20px; padding-right: 20px;">Unscheduled Services List</button></center>
                </div>

                <div class="row aside z-depth-1">
                    <div style="background-color: #00897b; border: 1px solid #b0bec5; padding: 15px;">
                            <center><label style="font-family: myFirstFont2; color: #ffffff; font-size: 20px;">Schedule Logs</label></center>
                    </div>

                    <!-- Service Notification List -->
                    <div scroll-glue id="chatlist" class = "mousescroll" style="max-height: 340px;">
                        <div ng-show='scheduleDetailLogList.length == 0' style="background-color: #fafafa; border: 1px solid #b0bec5;">
                            <div class="row"><br>
                                <div class="col s10 center">
                                    <label>No schedule actions.</label><br>
                                </div>
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

                <div class="row">
                    <div class = "col s12">
                        <div class = "aside aside z-depth-3" style = "height: 180px;">
                            <div class = "header" style = "height: 35px; background-color: #00897b">
                                <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: myFirstFont2;">Legends:</label>
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
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
            format: 'mm/dd/yyyy'
        });
    </script>

</div>

@endsection