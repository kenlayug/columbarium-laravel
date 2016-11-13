<!-- Modal Archive Block-->
<div id="modalArchiveBlock" class="modal modal-fixed-footer" style = "height: 420px;  width: 54%; overflow-y: hidden;">
    <div class = "modal-header" style = "height: 55px; background-color: #00897b">
        <h4 class = "archiveH4 center" style = "color: white; font-family: roboto3; padding-top: 10px;">Archive Block/s</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <div class="modal-content">
        <!-- Data Grid Deactivated Block/s-->
        <div id="admin1" class="col s12" style = "margin-top: -10px;">
            <div class="z-depth-2 card material-table">
                <table datatable="ng">
                    <thead>
                    <tr>
                        <th>Building</th>
                        <th>Floor</th>
                        <th>Room</th>
                        <th>Block</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="block in archiveBlockList">
                        <td ng-bind="block.strBuildingName"></td>
                        <td ng-bind="block.intFloorNo"></td>
                        <td ng-bind="block.strRoomName"></td>
                        <td ng-bind="block.intBlockNo"></td>
                        <td>
                            <button ng-click="reactivateBlock(block, $index)" name = "action" class="btn light-green" style = "color: black;">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class = "btn center light-green modal-close" style = "margin-right: 10px; color: black;">Done</button>
    </div>
</div>