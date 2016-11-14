<!-- Modal Archive Additionals -->
<div id="modalArchiveItem" class="modalArchive modal" ng-controller="ctrl.deactivatedTable">
    <div class = "modal-header box">
        <h4 class = "archiveH4 center">Archive Additional/s</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <div class="modalArchiveContent modal-content">
        <div class = "row">
            <div id="admin1" class="col s9">
                <div class="z-depth-2 card material-table">
                    <table datatable="ng">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="additional in archiveAdditionalList">
                            <td ng-bind="additional.strAdditionalName"></td>
                            <td>
                                <button ng-click="ReactivateAdditional(additional.intAdditionalId, $index)" name = "action" class="btnActivate btn light-green" style = "color: black;">Activate</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="headerDivider"></div>
            <div class = "col s3">
                <button ng-click="ReactivateAll()" class = "btn center red" style = "color: white; margin-top: 10px; margin-left: 20px; font-size: 12px; width: 162px;">Activate All</button>
                <button ng-click="DeactivateAll()" class = "btn center red" style = "color: white; margin-left: 20px; margin-top: 10px;font-size: 12px; width: 162px;">Deactivate All</button>
                <button class = "btn center light-green modal-close" style = "margin-left: 50px; margin-top: 120px; color: black;">Done</button>
            </div>
        </div>
    </div>
</div>