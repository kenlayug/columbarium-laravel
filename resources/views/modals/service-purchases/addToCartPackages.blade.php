<div id="addToCartPackages" class="modal modal-fixed-footer" style="overflow-y: hidden; width:75% !important; max-height: 100% !important;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Add To Cart</h4></cesnter>
    </div>
    <div class="modal-content" style="overflow-y: auto;">
        <div class="row" style="margin-top: -15px;">
            <div class="col s4" style="border: 3px solid #7b7073;">
                <div class="row"><br>
                    <center>
                        <h6>Package Details:</h6>
                    </center>
                </div>
                <div class="row" style="margin-top: -10px"><br>
                	<div class="col s4">
        	            <label style="color: #000000; font-size: 15px;">Name:</label>
                    </div>
        			<div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>Fetus Cremation</u></label>
                    </div>
                </div>
                <div class="row">
                	<div class="col s4">
        	            <label style="color: #000000; font-size: 15px;">Price:</label>
                    </div>
        			<div class="col s8">
                        <label style="color: #000000; font-size: 15px;"><u>P 1,000.00</u></label>
                    </div>
                </div>
                <div class="row">
                	<div class="col s4">
        	            <label style="color: #000000; font-size: 15px;">Quantity:</label>
                    </div>
        			<div class="col s8">
                        <input id="paid" type="number">
                    </div>
                </div>
                <div class="row" style="margin-top: -10px">
                	<div class="col s5">
        	            <label style="color: #000000; font-size: 15px;">Total price:</label>
                    </div>
        			<div class="col s7">
                        <label style="color: #000000; font-size: 15px;"><u>P 1,000.00</u></label>
                    </div>
                </div>
            </div>
            
            <div class="col s8" style="margin-top: -5px;">
                <div class="row">
                    <center><h6>Additionals: </h6></center>
                </div>
                <div class="z-depth-2 card material-table">
                    <table style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th><center>Name</center></th>
                                <th><center>Quantity</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><center>Candle Holder</center></td>
                                <td><center>2</center></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <center><h6>Assign Schedule: </h6></center>
                </div>
                <div class="z-depth-2 card material-table">
                    <table style="table-layout: fixed; clear: bottom;">
                        <thead>
                            <tr>
                                <th><center>Name</center></th>
                                <th><center>Date<span style="color: red">*</span></center></th>
                                <th><center>Time<span style="color: red">*</span></center></th>
                                <th><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><center>Fetus Cremation</center></td>
                                <td><center>12/12/12</center></td>
                                <td><center>12:30 - 2:30 pm</center></td>
                                <td>
                                    <center>
                                        <button data-target="scheduleService" class="btn-floating waves-light btn light-green modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Schedule" 
                                        href="#scheduleService"><i class="material-icons" style = "color: #000000;">alarm_on</i></button>
                                        <button data-target="deceasedForm" class="btn-floating waves-light btn light-green modal-trigger tooltipped" href="#deceasedForm" data-position="bottom" data-delay="50" data-tooltip="Edit Deceased Form" style="clear:bottom;"><i class="material-icons" style = "color: #000000;">assignment_ind</i></button>
                                        <button data-target="unitForm" class="btn-floating waves-light btn light-green modal-trigger tooltipped" href="#unitForm" data-position="bottom" data-delay="50" data-tooltip="Edit Unit Form" style="clear:bottom;"><i class="material-icons" style = "color: #000000;">dashboard</i></button>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <i class = "left" style = "color: red; margin-top: 10px; margin-left: 15px;">*Required Fields</i><br><br>
            </div>
        </div>
        <br><br><br>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Add</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>