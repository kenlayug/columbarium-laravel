        <!-- Safe Box  -->
        <div id="safeBox" class="modal modal-fixed-footer" style="width: 95%; max-height: 120%; overflow-y: hidden;">
            <div class="modal-header" style="padding: 0px;">
                <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Safe Box</h4></center>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
            </div>
            <div class="modal-content" style="overflow-y: auto;">
                <div class="z-depth-2 card material-table" style="margin-top: -10px;">
                    <table id="datatable5" datatable="ng">
                        <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Deceased Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="safeBox in safeBoxList">
                            <td>@{{ safeBox.strCustomerLast+', '+safeBox.strCustomerFirst+' '+safeBox.strCustomerMiddle }}</td>
                            <td>@{{ safeBox.strDeceasedLast+', '+safeBox.strDeceasedFirst+' '+safeBox.strDeceasedMiddle }}</td>
                            <td><a ng-click="retrieveDeceased(safeBox, $index)" data-target="retrieve" class="returnBtn waves-light btn light-green btn modal-trigger" href="#retrieve" style="color: #000000">Retrieve</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div><br><br><br>
            </div>
        </div>
        <!-- Safe Box  -->