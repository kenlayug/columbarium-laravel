<!-- Modal Archive Package-->
<div id="modalArchivePackage" class="modalArchive modal">
    <div class="modal-content">
        <!-- Data Grid Deactivated Package/s-->
        <div id="admin1" class="col s12">
            <div class="z-depth-2 card material-table">
                <div class="table-header">
                    <h4 class = "archiveH4">Archive Package/s</h4>
                    <a href="#" class="search-toggle btn-flat right"><i class="searchBtn material-icons right">search</i></a>
                </div>
                <table id="datatable2">
                    <thead>
                    <tr>
                        <th>Package Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="package in deactivatedPackages">
                        <td>@{{ package.strPackageName }}</td>
                        <td>
                            <button ng-click="ReactivatePackage(package.intPackageId, $index)" name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <button name = "action" class="btnArchiveDone btn light-green modal-close right">DONE</button>
    </div>

</div>