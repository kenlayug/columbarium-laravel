<!-- Modal Archive Building-->
<div id="modalArchiveBuilding" class="archiveDataGrid modal" ng-controller="ctrl.deactivatedTable">
    <div class="modal-content">
        <!-- Data Grid Deactivated Building/s-->
        <div id="admin1" class="col s12">
            <div class="z-depth-2 card material-table">
                <div class="archiveHeader table-header">
                    <h4 class = "archiveH4">Archive Building/s</h4>
                    <a href="#" class="archiveSearch search-toggle btn-flat right"><i class="material-icons right">search</i></a>
                </div>
                <table id="datatable2" datatable="ng">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="building in deactivatedBuildings">
                        <td>@{{ building.strBuildingName }}</td>
                        <td>
                            <button ng-click="ReactivateBuilding(building.intBuildingId, $index)" name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button name = "action" class="btnArchiveDone btn light-green modal-close right">DONE</button>
</div>