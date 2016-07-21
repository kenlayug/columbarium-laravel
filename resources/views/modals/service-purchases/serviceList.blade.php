<div id="serviceList" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Service List</h4></center>
    </div>
    <div class="modal-content" style="overflow-y: auto; clear: top;">
        <div class="row" style="margin-top: -20px;">
            <div class="z-depth-2 card material-table">
                <table id="datatable6" style="color: black; background-color: white; border: 2px solid white;">
                    <thead>
                        <tr>
                            <th class="center">Service</th>
                            <th class="center">Price</th>
                            <th class="center">Quantity<span style="color: red">*</span></th>
                            <th class="center">Grant Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" id="select1"/>
                                <label for="select1">Service 1</label>
                            </td>
                            <td class="center">P 8,000.00</td>
                            <td>
                                <input id="qty" type="number">
                            </td>
                            <td class="center">
                                <input type="checkbox" id="discount1"/>
                                <label for="discount1">Yes</label>
                            </td>
                        </tr>          
                        <tr>
                            <td>
                                <input type="checkbox" id="select2"/>
                                <label for="select2">Service 2</label>
                            </td>
                            <td class="center">P 8,000.00</td>
                            <td>
                                <input id="qty" type="number">
                            </td>
                            <td class="center">
                                <input type="checkbox" id="discount2"/>
                                <label for="discount2">Yes</label>
                            </td>
                        </tr>          
                        <tr>
                            <td>
                                <input type="checkbox" id="select3"/>
                                <label for="select3">Service 3</label>
                            </td>
                            <td class="center">P 8,000.00</td>
                            <td>
                                <input id="qty" type="number">
                            </td>
                            <td class="center">
                                <input type="checkbox" id="discount3"/>
                                <label for="discount3">Yes</label>
                            </td>
                        </tr>                    
                    </tbody>
               </table>
            </div>
        </div>
        <div class="row" style="margin-top: -15px;">
            <i class = "left" style = "color: red;">*Required Fields</i>
        </div>
        <br><br>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Submit</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>