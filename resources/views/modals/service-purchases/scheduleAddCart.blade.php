<div id="scheduleAddCart" class="modal modal-fixed-footer" style="overflow-y: hidden; width:75% !important; max-height: 100% !important;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Edit Cart</h4></cesnter>
    </div>
    <div class="modal-content" style="overflow-y: auto;">

        <div class="row" style="margin-top: -10px">
            <div class="col s1">
                <label style="color: #000000; font-size: 15px;">Name:</label>
            </div>
            <div class="col s6">
                <label style="color: #000000; font-size: 15px;"><u>Fetus Package</u></label>
            </div>
        </div>

        <div class="row">
            <div class="col s6" style="border: 3px solid #7b7073;">
                <div class="row"><br>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;">Current Quantity:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>2</u></label>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"> Prev. Price:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>P 1,000.00</u></label>
                    </div>
                </div>
            </div>
            <div class="col s6" style="border: 3px solid #7b7073;">
                <div class="row"><br>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;">New Quantity:</label>
                    </div>
                    <div class="col s6" style="margin-top: -20px;">
                        <input id="paid" type="number">
                    </div>
                </div>
                <div class="row">
                    <div class="col s6" style="margin-top: 3px;">
                        <label style="color: #000000; font-size: 15px;">Total price:</label>
                    </div>
                    <div class="col s6">
                        <label style="color: #000000; font-size: 15px;"><u>P 500.00</u></label>
                    </div>
                </div>
            </div>
        </div><br>

        <div class="row" style="margin-top: -20px;">
            <div class="z-depth-2 card material-table">
                <table style="table-layout: fixed;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Fetus Cremation</td>
                            <td>12/12/12</td>
                            <td>12:30 - 2:30 pm</td>
                            <td>
                                <button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style = "color: #000000;">Reschedule</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Fetus Cremation</td>
                            <td>12/12/12</td>
                            <td>12:30 - 2:30 pm</td>
                            <td>
                                <button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style = "color: #000000;">Reschedule</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><br><br>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Submit</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>