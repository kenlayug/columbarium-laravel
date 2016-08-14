@extends('v2.baseLayout')
@section('title', 'Assign Schedule')
@section('body')

<script type="text/javascript" src="{!! asset('/js/assignSchedule.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/assignSched.css') !!}">


    <div class = "col s12" >
        <div class = "row">
            <div class = "col s4">
                <center>
                    <h4 style = "margin-top: 20px; font-family: myFirstFont">Assign Schedule</h4>    
                </center>
                <div class = "col s12">
                    <div class = "aside aside z-depth-3">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont">Unscheduled Services</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable">
                                <thead>
                                <tr>
                                    <th class="center">Customer Name</th>
                                    <th class="center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aaron Clyde Garil</td>
                                    <td class="center"><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#sched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Tiffany Banzuela</td>
                                    <td class="center"><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#sched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Alvin John Perez</td>
                                    <td class="center"><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#schedn" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class = "col s12">
                    <div class = "aside aside z-depth-3">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont">Scheduled Services</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable3">
                                <thead>
                                <tr>
                                    <th class="center">Customer Name</th>
                                    <th class="center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aaron Clyde Garil</td>
                                    <td class="center"><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>John Ezekiel Martinez</td>
                                    <td class="center"><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Aila Bianca Jacalne</td>
                                    <td class="center"><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Tiffany Banzuela</td>
                                    <td class="center"><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s5" style="margin-top: 25px;">
                
            </div>
            
            <div class = "col s3 aside" style="margin-top: 25px; width: 300px; margin-left: 15px;">
                <div class="row aside z-depth-1">
                    <div style="background-color: #00897b; border: 1px solid #b0bec5; padding: 15px;">
                            <center><label style="font-family: myFirstFont; color: #ffffff; font-size: 15px;">Service Notification</label></center>
                    </div>

                    <!-- Service Notification List -->
                    <div id="chatlist" class = "mousescroll" style="max-height: 480px;">
                        <!-- Service Done -->
                        <div style="background-color: #fafafa; border: 1px solid #b0bec5;">
                            <div class="row"><br>
                                <div class="col s2"><i class="material-icons">offline_pin</i></div>
                                <div class="col s10">
                                    <label>Done: Cremation</label><br>
                                    <label>Date: 09/12/16</label><br>
                                    <label>Time: 1:00-3:00 PM</label><br>
                                    <label>Transaction Code: 123</label><br>
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
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>

        <button data-target="successReschedService" class="right waves-light btn blue modal-trigger" href="#successReschedService" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Resched Service</button>

            <button data-target="successSchedService" class="right waves-light btn blue modal-trigger" href="#successSchedService" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Sched Service</button>

        @include('modals.service-purchases.scheduleService')
        @include('modals.assign-schedule.scheduledServices')
        @include('modals.assign-schedule.unscheduledServices')
        @include('modals.assign-schedule.successReschedService')
        @include('modals.assign-schedule.successSchedService')
    </div>

@endsection