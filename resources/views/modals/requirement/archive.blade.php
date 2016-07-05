<!-- Modal Archive Requirement-->
<div id="modalArchiveRequirement" class="modalArchive modal" ng-controller="ctrl.deactivateTable">
    <div class="modal-content">
        <!-- Data Grid Deactivated Requirement/s-->
        <div id="admin1" class="col s12">
            <div class="z-depth-2 card material-table">
                <div class="table-header">
                    <h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 1.5vw; color: white; padding-left: 0px;">Archive Requirement/s</h4>
                    <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 60px; color: #ffffff;">search</i></a>
                </div>
                <table id="datatable2" datatable="ng">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="requirement in deactivatedRequirements">
                        <td>@{{ requirement.strRequirementName }}</td>
                        <td>
                            <button ng-click="ReactivateRequirement(requirement.intRequirementId, $index)" name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button name = "action" class="btn light-green modal-close right" style = "color: black; margin-bottom: 10px; margin-right: 30px;">DONE</button>
</div>