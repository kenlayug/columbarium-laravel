<div id="additionalsList" class="modal modal-fixed-footer" style="width: 95%; max-height: 120%; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Additionals List</h4></center>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <div class="modal-content" style="overflow-y: auto; clear: top;">
        <div class="row" style="margin-top: -20px;">
            <div class="z-depth-2 card material-table">
                <table id="datatable1" style="color: black; background-color: white; border: 2px solid white;" datatable="ng">
                    <thead>
                        <tr>
                            <th class="center">Additional</th>
                            <th class="center">Price</th>
                            <th class="center">Quantity<span style="color: red">*</span></th>
                            <th class="center">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="additional in additionalList">
                            <td>
                                <input type="checkbox"
                                       ng-model="additional.selected"
                                       id="additional@{{ additional.intAdditionalId }}"/>
                                <label for="additional@{{ additional.intAdditionalId }}">@{{ additional.strAdditionalName }}</label>
                            </td>
                            <td class="center">@{{ additional.price.deciPrice | currency: "P" }}</td>
                            <td>
                                <input ng-model="additional.intQuantity"
                                       ng-disabled="!additional.selected"
                                       ui-number-mask="0"
                                       type="text">
                            </td>
                            <td class="center">
                               <label ng-show="additional.selected">@{{ additional.price.deciPrice * additional.intQuantity | currency : "P" }}</label>
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