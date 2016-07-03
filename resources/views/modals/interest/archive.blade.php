<!-- Modal Archive Interest-->
<div id="modalArchiveInterest" class="archiveDataGrid modal" ng-controller="ctrl.deactivatedTable">
    <div class="modal-content">
        <!-- Data Grid Deactivated Interest/s-->
        <div id="admin1" class="col s12">
            <div class="z-depth-2 card material-table">
                <div class="table-header">
                    <h4 class = "archiveModalH4">Archive Interest/s</h4>
                    <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 150px; color: #ffffff;">search</i></a>
                </div>
                <table id="datatable2">
                    <thead>
                    <tr>
                        <th>No. of Year/s</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="interest in deactivatedInterests">
                        <td ng-if="interest.intAtNeed">@{{ interest.intNoOfYear }}<span ng-if="interest.intAtNeed == 1">(At Need)</span></td>
                        <td ng-if="!interest.intAtNeed">@{{ interest.intNoOfYear }}</td>
                        <td>
                            <button ng-click="ReactivateInterest(interest.intInterestId, $index)" name = "action" class="btn green modal-close">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button name = "action" class="btn green modal-close right" style = "margin-bottom: 10px; margin-right: 30px;">DONE</button>
</div>