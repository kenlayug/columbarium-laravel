<div id="purchaseduUnit" class="modal modal-fixed-footer" style="width:95%; max-height: 120%; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0px">
        <center>
            <h4 style = "font-size: 20px; color: white; padding: 20px;">Purchased Unit: 
                <u style = "font-size: 20px; color: white; padding: 20px;" ng-bind="customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName"></u>
            </h4>
        </center>
        
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div class="modal-content" style="overflow-y: auto;">
        <div class = "card material-table" style = "text-align: center; margin-top: -20px;">
            <table id="datatable-purchase" datatable="ng">
                <thead>
                    <tr>
                        <th style="font-size:15px; color: #000000;">Transaction Type</th>
                        <th style="font-size:15px; color: #000000;">Unit Code</th>
                        <th style="font-size:15px; color: #000000;">Building</th>
                        <th style="font-size:15px; color: #000000;">Floor</th>
                        <th style="font-size:15px; color: #000000;">Room</th>
                        <th style="font-size:15px; color: #000000;">Block</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="unit in purchasedUnitList">
                        <td ng-bind="transactionList[unit.intTransactionType]"></td>
                        <td ng-bind="unit.display"></td>
                        <td ng-bind="unit.strBuildingName"></td>
                        <td ng-bind="unit.intFloorNo"></td>
                        <td ng-bind="unit.strRoomName"></td>
                        <td ng-bind="unit.intBlockNo"></td>
                    </tr>
                </tbody>
            </table>
        </div>   
        <br><br><br><br>  
    </div>

    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Close</button>
    </div>
</div>