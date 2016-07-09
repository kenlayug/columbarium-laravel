<div id="scheduleService" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden">
    <div class="modal-header1" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Assign Schedule</h4></center>
        <button class="add-toggle light-green nopadding btn tooltipped" data-delay="50" data-tooltip="Add New Time"
                style = "margin-left: 880px; margin-top: -75px; color: #000000"><i class="material-icons" style="color: #000000">add</i> Time</button>
    </div>
    <div class="modal-content" style="overflow-y: auto">
        <div class="z-depth-2 card material-table" style="margin-top: -10px;">
            <div id="addTime" style="display:none; background-color: rgba(10, 193, 232, 0.12); display: none; margin-top: 0;">
                <div class="row">
                    <div class="input-field col s2">
                        <label>Add Time:</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="sTime" type="text" required="" aria-required="true" class="validate" pattern= "([01]?[0-9]|2[0-3]):[0-5][0-9]">
                        <label for="sTime" data-error = "24 Hrs Format">Start Time</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="eTime" type="text" class="validate" required="" aria-required="true" class="validate" pattern= "([01]?[0-9]|2[0-3]):[0-5][0-9]">
                        <label for="eTime" data-error = "24 Hrs Format">End Time</label>
                    </div>
                    <div class="input-field col s3">
                        <a class="light-green waves-light btn" style="text-align: center; color: #000000">Save</a>
                    </div>
                </div>
            </div>
            <script>
                <!-- Scheduling Slide Add Time Ayaw Gumana pag external-->
                $('.add-toggle').click(function() {
                    if ($('#addTime').css('display') == 'none')
                        $('#addTime').slideDown();
                    else
                        $('#addTime').slideUp();
                });
            </script>
            <div class="cmxform" id="selectTime" method="get" autocomplete="off" style="margin-top: -10px;">
                <div class="table-header">
                    <left>
                        <div class="row" style="margin-left: -15px;">
                            <div class="input-field col s4">
                                <label for="sDate">Date:</label>
                            </div>
                            <div class="input-field col s8" style="margin-left: 55px;">
                                <input id="sDate" type="date">
                            </div>
                        </div>
                    </left>
                </div>
                <div class="row">
                    <table id="datatable1" style="width: 100% !important; table-layout: fixed">
                        <thead>
                        <tr>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>9:00 AM</td>
                            <td>11:00 AM</td>
                            <td>Reserved</td>
                            <td><button class="light-green waves-light btn" style="cursor: not-allowed; color: #000000" disabled>Select</button></td>
                        </tr>
                        <tr>
                            <td>11:00 AM</td>
                            <td>1:00 PM</td>
                            <td>Available</td>
                            <td><button class="light-green waves-light btn" style="color: #000000">Select</button></td>
                        </tr>
                        <tr>
                            <td>1:00 PM</td>
                            <td>3:00 PM</td>
                            <td>Reserved</td>
                            <td><button class="light-green waves-light btn" style="cursor: not-allowed; color: #000000" disabled>Select</button></td>
                        </tr>
                        <tr>
                            <td>3:00 PM</td>
                            <td>5:00 PM</td>
                            <td>Available</td>
                            <td><button class="light-green waves-light btn" style="color: #000000">Select</button></td>
                        </tr>
                        <tr>
                            <td>5:00 PM</td>
                            <td>7:00 PM</td>
                            <td>Available</td>
                            <td><button class="light-green waves-light btn" style="color: #000000">Select</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Save</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>