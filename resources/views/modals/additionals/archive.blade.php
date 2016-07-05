<!-- Modal Archive Additionals-->
<div id="modalArchiveItem" class="modalArchive modal" ng-controller="ctrl.deactivatedTable">
    <div class="modalArchiveContent modal-content">
        <!-- Data Grid Deactivated Additionals/s-->
        <div id="admin1" class="col s12">
            <div class="z-depth-2 card material-table">
                <div class="table-header">
                    <h4>Archive Additionals</h4>
                    <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 270px; color: #ffffff;">search</i></a>
                </div>
                <table id="datatable2" datatable="ng">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="additional in deactivatedAdditionals">
                        <td>@{{ additional.strAdditionalName }}</td>
                        <td>
                            <button ng-click="ReactivateAdditional(additional.intAdditionalId, $index)" name = "action" class="btnActivate btn light-green modal-close">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>