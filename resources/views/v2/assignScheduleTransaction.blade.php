@extends('v2.baseLayout')
@section('title', 'Assign Schedule')
@section('body')

<script type="text/javascript" src="{!! asset('/js/assignSchedule.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/assignSched.css') !!}">

    

    <div class = "col s12" >
        <div class="row">
            <center>
                <h4 style = "margin-top: 20px; font-family: myFirstFont">Assign Schedule</h4>    
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
                        <input type="date">
                    </div>
                    <div class="col s4" style="margin-top: 14px;">
                        <select>
                            <option value="" disabled selected>Choose your filter</option>
                            <option value="1">Exhumation</option>
                            <option value="2">Cremation</option>
                            <option value="3">Installation</option>
                        </select>
                        <label style="margin-left: 280px; margin-top: 15px;">Service Name</label>
                    </div>
                </div>

                    <div class="row aside z-depth-1" style="margin-top: -10px;">
                        <div style="background-color: #00897b; border: 1px solid #b0bec5; padding: 15px;">
                            <center><label style="font-family: myFirstFont; color: #ffffff; font-size: 15px;">Scheduled Service</label></center>
                            <label class="right" style="font-family: myFirstFont; color: #ffffff; font-size: 13px; margin-top: -20px;">Date : <u>09/09/16</u></label>
                        </div>

                        <!-- Service Notification List -->
                        <div id="chatlist" class = "mousescroll" style="max-height: 335px; table-layout: fixed;">
                            <table>
                                <thead>
                                <tr>
                                    <br>
                                    <th class="center">Customer Name</th>
                                    <th class="center">Time</th>
                                    <th class="center">Service</th>
                                    <th class="center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="center">Aaron Clyde Garil</td>
                                    <td class="center">3:00 - 5:00 PM</td>
                                    <td class="center">Exhumation</td>
                                    <td class="center">
                                        <button class="btn-floating waves-light btn light-green btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Process"><i class="material-icons" style = "color: #000000;">work</i></button>

                                        <button data-target="scheduleService" class="btn-floating waves-light btn light-green modal-trigger btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reschedule"
                                        href="#scheduleService"><i class="material-icons" style = "color: #000000;">restore</i></button>

                                        <button class="btn-floating waves-light btn light-green btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cancel"
                                        ><i class="material-icons" style = "color: #000000;">not_interested</i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">Tiffany Banzuela</td>
                                    <td class="center">5:00 - 7:00 PM</td>
                                    <td class="center">Cremation</td>
                                    <td class="center">
                                        <button class="btn-floating waves-light btn light-green btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Process"><i class="material-icons" style = "color: #000000;">work</i></button>

                                        <button data-target="scheduleService" class="btn-floating waves-light btn light-green modal-trigger btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reschedule"
                                        href="#scheduleService"><i class="material-icons" style = "color: #000000;">restore</i></button>

                                        <button class="btn-floating waves-light btn light-green btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cancel"
                                        ><i class="material-icons" style = "color: #000000;">not_interested</i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">Alvin John Perez</td>
                                    <td class="center">9:00 - 11:00 AM</td>
                                    <td class="center">Exhumation</td>
                                    <td class="center">Finished</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>    
                    </div>  
                </div>
                <div class="row">
                    <div class = "col s8">
                            <div class = "aside aside z-depth-3" style = "height: 130px;">
                                <div class = "header" style = "height: 35px; background-color: #00897b">
                                    <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: myFirstFont2;">Legend:</label>
                                </div>

                                <div class = "row" style = "margin-top: 10px;">
                                    <center>
                                        <div class = "col s2" style = "margin-left: 10px;">
                                            <i class="material-icons">offline_pin</i>
                                            <label style="font-size: 15px; color: #000000;">Finished</label>
                                        </div>
                                        <div class = "col s2" style = "margin-left: 10px;">
                                            <i class="material-icons">query_builder</i>
                                            <label style="font-size: 15px; color: #000000;">Ongoing</label>
                                        </div>
                                        <div class = "col s2" style = "margin-left: 10px;">
                                            <i class="material-icons">alarm_on</i>
                                            <label style="font-size: 15px; color: #000000;">Scheduled</label>
                                        </div>
                                        <div class = "col s2" style = "margin-left: 10px;">
                                            <i class="material-icons" style="margin-left: 15px;">restore</i>
                                            <label style="font-size: 15px; color: #000000;">Rescheduled</label>
                                        </div>
                                        <div class = "col s2" style = "margin-left: 10px;">
                                            <i class="material-icons">not_interested</i>
                                            <label style="font-size: 15px; color: #000000;">Canceled</label>
                                        </div>
                                    </center>
                                </div>
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
                            <center><label style="font-family: myFirstFont; color: #ffffff; font-size: 15px;">Service Notification</label></center>
                    </div>

                    <!-- Service Notification List -->
                    <div id="chatlist" class = "mousescroll" style="max-height: 340px;">
                        <!-- Service Done -->
                        <div style="background-color: #fafafa; border: 1px solid #b0bec5;">
                            <div class="row"><br>
                                <div class="col s2"><i class="material-icons">offline_pin</i></div>
                                <div class="col s10">
                                    <label>Done: Cremation</label><br>
                                    <label>Date: 09/12/16</label><br>
                                    <label>Time: 1:00-3:00 PM</label><br>
                                    <label>Transaction Code: 123</label><br>
                                    <label>Customer Name: Layug, Ken</label><br>
                                </div>
                            </div>
                        </div>

                        <!-- Ongoing Service -->
                        <div style="background-color: #fafafa; border: 1px solid #b0bec5;">
                            <div class="row"><br>
                                <div class="col s2"><i class="material-icons">query_builder</i></div>
                                <div class="col s10">
                                    <label>Ongoing: Cremation</label><br>
                                    <label>Date: 09/12/16</label><br>
                                    <label>Time: 1:00-3:00 PM</label><br>
                                    <label>Transaction Code: 123</label><br>
                                    <label>Customer Name: Layug, Ken</label><br>
                                </div>
                            </div>
                        </div>

                        <!-- Scheduled Service -->
                        <div style="background-color: #fafafa; border: 1px solid #b0bec5;">
                            <div class="row"><br>
                                <div class="col s2"><i class="material-icons">alarm_on</i></div>
                                <div class="col s10">
                                    <label>Scheduled: Cremation</label><br>
                                    <label>Date: 09/12/16</label><br>
                                    <label>Time: 1:00-3:00 PM</label><br>
                                    <label>Transaction Code: 123</label><br>
                                    <label>Customer Name: Layug, Ken</label><br>
                                </div>
                            </div>
                        </div>

                        <!-- Rescheduled Service -->
                        <div style="background-color: #fafafa; border: 1px solid #b0bec5;">
                            <div class="row"><br>
                                <div class="col s2"><i class="material-icons">restore</i></div>
                                <div class="col s10">
                                    <label>Rescheduled: Cremation</label><br>
                                    <label>Date: 09/12/16</label><br>
                                    <label>Time: 1:00-3:00 PM</label><br>
                                    <label>Transaction Code: 123</label><br>
                                    <label>Customer Name: Layug, Ken</label><br>
                                </div>
                            </div>
                        </div>

                        <!-- Canceled Service -->
                        <div style="background-color: #fafafa; border: 1px solid #b0bec5;">
                            <div class="row"><br>
                                <div class="col s2"><i class="material-icons">not_interested</i></div>
                                <div class="col s10">
                                    <label>Canceled: Cremation</label><br>
                                    <label>Date: 09/12/16</label><br>
                                    <label>Time: 1:00-3:00 PM</label><br>
                                    <label>Transaction No.: 123</label><br>
                                    <label>Customer Name: Layug, Ken</label><br>
                                </div>
                            </div>
                        </div>

                        <div style="background-color: #fafafa; border: 1px solid #b0bec5;">
                            <div class="row"><br>
                                <div class="col s2"><i class="material-icons">alarm_on</i></div>
                                <div class="col s10">
                                    <label>Scheduled: Cremation</label><br>
                                    <label>Date: 09/12/16</label><br>
                                    <label>Time: 1:00-3:00 PM</label><br>
                                    <label>Transaction Code: 123</label><br>
                                    <label>Customer Name: Layug, Ken</label><br>
                                </div>
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

@endsection