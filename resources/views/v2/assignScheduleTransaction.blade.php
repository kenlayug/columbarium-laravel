@extends('v2.baseLayout')
@section('title', 'Assign Schedule')
@section('body')

<script type="text/javascript" src="{!! asset('/js/assignSchedule.js') !!}"></script>

    <button data-target="successReschedService" class="right waves-light btn blue modal-trigger" href="#successReschedService" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Resched Service</button>

    <button data-target="successSchedService" class="right waves-light btn blue modal-trigger" href="#successSchedService" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Sched Service</button>


    <!-- Success Modals -->
    <div id="successSchedService" class="modal modal-fixed-footer" style="width:75% !important;">
        <div class="modal-header" style="padding: 0px">
            <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
        </div>
        <div class="modal-content" style="overflow-y: auto; margin-top: -25px;">
            <div class="row">
                <div class="col s6" style="margin-left: -15px;">
                    <div class="row">
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>Aaron Clyde Garil</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;">Service Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>Exhumation</u></label>
                        </div>
                    </div>
                </div>

                <div class="col s6">
                    <div class="row">
                        <div class="col s4 offset-s4">
                            <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                        </div>
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;"><u>T312</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4 offset-s4">
                            <label style="color: #000000; font-size: 15px;">Date:</label>
                        </div>
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;"><u>09/12/16</u></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                    <div class="col s8 offset-s2" style="border: 3px solid #7b7073;"><br>
                        <center><h6>Schedule Details: </h6></center><br>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s3 offset-s2">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s4 offset-s3">
                                <label style="color: #000000; font-size: 15px;"><u>09/12/16</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s3 offset-s2">
                                <label style="color: #000000; font-size: 15px;">Start Time:</label>
                            </div>
                            <div class="col s4 offset-s3">
                                <label style="color: #000000; font-size: 15px;"><u>3:00 PM</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s3 offset-s2">
                                <label style="color: #000000; font-size: 15px;">End Time:</label>
                            </div>
                            <div class="col s4 offset-s3">
                                <label style="color: #000000; font-size: 15px;"><u>4:00 PM</u></label>
                            </div>
                        </div>
                        <br><br>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </div>


    <div id="successReschedService" class="modal modal-fixed-footer" style="width:75% !important;">
        <div class="modal-header" style="padding: 0px">
            <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
        </div>
        <div class="modal-content" style="overflow-y: auto; margin-top: -25px;">
            <div class="row">
                <div class="col s6" style="margin-left: -15px;">
                    <div class="row">
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;">Customer Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>Aaron Clyde Garil</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;">Service Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>Exhumation</u></label>
                        </div>
                    </div>
                </div>

                <div class="col s6">
                    <div class="row">
                        <div class="col s4 offset-s4">
                            <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                        </div>
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;"><u>T312</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4 offset-s4">
                            <label style="color: #000000; font-size: 15px;">Date:</label>
                        </div>
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;"><u>09/12/16</u></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                    <div class="col s6" style="border: 3px solid #7b7073;"><br>
                        <center><h6>Old Schedule Details: </h6></center><br>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;"><u>09/12/16</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;">Start Time:</label>
                            </div>
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;"><u>3:00 PM</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;">End Time:</label>
                            </div>
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;"><u>4:00 PM</u></label>
                            </div>
                        </div><br><br>
                    </div>
                    <div class="col s6" style="border: 3px solid #7b7073;"><br>
                        <center><h6>New Schedule Details: </h6></center><br>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;">Date:</label>
                            </div>
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;"><u>09/12/16</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;">Start Time:</label>
                            </div>
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;"><u>3:00 PM</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;">End Time:</label>
                            </div>
                            <div class="col s4 offset-s2">
                                <label style="color: #000000; font-size: 15px;"><u>4:00 PM</u></label>
                            </div>
                        </div><br><br>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </div>
    <!-- Success Modals -->

    <div class = "col s12" >
        <h4 style = "margin-top: 20px; margin-left: 25px; font-family: myFirstFont">Assign Schedule</h4>
        <div class = "row">
            <div class = "col s5">
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
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aaron Clyde Garil</td>
                                    <td><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#sched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>John Ezekiel Martinez</td>
                                    <td><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#sched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Aila Bianca Jacalne</td>
                                    <td><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#sched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Tiffany Banzuela</td>
                                    <td><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#sched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Alvin John Perez</td>
                                    <td><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#schedn" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
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
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aaron Clyde Garil</td>
                                    <td><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>John Ezekiel Martinez</td>
                                    <td><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Aila Bianca Jacalne</td>
                                    <td><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Tiffany Banzuela</td>
                                    <td><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Alvin John Perez</td>
                                    <td><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "col s7" style="margin-top: 20px;">

            </div>
        </div>
        @include('modals.service-purchases.scheduleService')
        @include('modals.assign-schedule.scheduledServices')
        @include('modals.assign-schedule.unscheduledServices')
    </div>

@endsection