<!-- Modal Archive Service-->
<div id="modalArchiveService" class="modalArchive modal">
    <div class="modal-content">
        <!-- Data Grid Deactivated Service/s-->
        <div id="admin1" class="col s12">
            <div class="z-depth-2 card material-table">
                <div class="table-header">
                    <h4 class = "archiveServiceH4" >Archive Service/s</h4>
                    <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 150px; color: #ffffff;">search</i></a>
                </div>
                <table id="datatable2" datatable="ng">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="service in archiveServiceList">
                        <td>@{{ service.strServiceName }}</td>
                        <td>
                            <button ng-click="enableService(service.intServiceId, $index)" name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button name = "action" class="btn light-green modal-close right" style = "margin-bottom: 10px; margin-right: 30px; color: black;">DONE</button>
</div>