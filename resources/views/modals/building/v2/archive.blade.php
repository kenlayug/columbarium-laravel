<!-- Modal Archive Building-->
<div id="modalArchiveBuilding" class="archiveDataGrid modal">
    <div class = "modal-header">
        <h4 class = "archiveH4 center">Archive Building/s</h4>
    </div>
    <div class="modalArchiveContent modal-content">
        <div class = "row">
            <div id="admin1" class="col s9">
                <div class="z-depth-2 card material-table">
                    <table id="datatable2" datatable='ng'>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat='building in archiveBuildingList'>
                            <td>@{{ building.strBuildingName }}</td>
                            <td>
                                <button ng-click='reactivateBuilding(building, $index)' name = "action" class="btnActivate btn light-green" style = "color: black;">Activate</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="headerDivider"></div>
            <div class = "col s3">
                <button ng-click='activateAllBuilding()' class = "btn center red" style = "color: white; margin-top: 10px; margin-left: 65px; font-size: 12px; width: 162px;">Activate All</button>
                <button ng-click='deactivateAllBuilding()' class = "btn center red" style = "color: white; margin-left: 65px; margin-top: 10px;font-size: 12px; width: 162px;">Deactivate All</button>
                <button class = "btn center light-green modal-close" style = "margin-left: 100px; margin-top: 120px; color: black;">Done</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Archive Additionals -->
<div id="modalArchiveItem" class="modalArchive modal">
    <div class = "modal-header">
        <h4 class = "archiveH4 center" style = "margin-top: -20px;">Archive Additional/s</h4>
    </div>
    <div class="modalArchiveContent modal-content">
        <div class = "row">
            <div id="admin1" class="col s9">
                <div class="z-depth-2 card material-table">
                    <table id="datatable2">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Metallic urn</td>
                            <td>
                                <button name = "action" class="btnActivate btn light-green">Activate</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Metallic urn</td>
                            <td>
                                <button name = "action" class="btnActivate btn light-green">Activate</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Metallic urn</td>
                            <td>
                                <button name = "action" class="btnActivate btn light-green">Activate</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Metallic urn</td>
                            <td>
                                <button name = "action" class="btnActivate btn light-green">Activate</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="headerDivider"></div>
            <div class = "col s3">
                <button class = "btn center red" style = "color: white; margin-top: 10px; margin-left: 65px; font-size: 12px; width: 162px;">Activate All</button>
                <button class = "btn center red" style = "color: white; margin-left: 65px; margin-top: 10px;font-size: 12px; width: 162px;">Deactivate All</button>
                <button class = "btn center light-green modal-close" style = "margin-left: 100px; margin-top: 120px; color: black;">Done</button>
            </div>
        </div>
    </div>
</div>