<div id="additionalsList" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Additionals List</h4></center>
    </div>
    <div class="modal-content" style="overflow-y: auto; clear: top;">
        <div class="row" style="margin-top: -20px;">
            <div class="z-depth-2 card material-table">
                <table id="datatable7" style="color: black; background-color: white; border: 2px solid white;">
                    <thead>
                        <tr>
                            <th class="center">Package</th>
                            <th class="center">Price</th>
                            <th class="center">Quantity<span style="color: red">*</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" id="select1"/>
                                <label for="select1">Vault Lamp</label>
                            </td>
                            <td class="center">P 2,000.00</td>
                            <td>
                                <input id="qty" type="number">
                            </td>
                        </tr>          
                        <tr>
                            <td>
                                <input type="checkbox" id="select2"/>
                                <label for="select2">Candle Holder</label>
                            </td>
                            <td class="center">P 1,000.00</td>
                            <td>
                                <input id="qty" type="number">
                            </td>
                        </tr>          
                        <tr>
                            <td>
                                <input type="checkbox" id="select3"/>
                                <label for="select3">Urn</label>
                            </td>
                            <td class="center">P 3,000.00</td>
                            <td>
                                <input id="qty" type="number">
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