<!-- Modal Archive Interest-->
<div id="modalArchiveInterest" class="archiveDataGrid modal">
    <div class = "modal-header box">
        <h4 class = "center" style = "color: white; font-family: roboto3;">Archive Interest/s</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <div class="modalArchiveContent modal-content">
        <div class = "row">
            <div id="admin1" class="col s9" style = "margin-left: -10px;">
                <div class="z-depth-2 card material-table">
                    <table id="datatable2" datatable='ng' dt-options='dtOptions'>
                        <thead>
                        <tr>
                            <th>Number of Years</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat='interest in archiveInterestList'>
                            <td>@{{ interest.intNoOfYear }}<span ng-if="interest.intAtNeed == 1">(At Need)</span></td>
                            <td>
                                <button ng-click='activateInterest(interest, $index)' name = "action" class="btnActivate btn light-green" style = "color: black;">Activate</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="headerDivider"></div>
            <div class = "col s3">
                <button ng-click='activateAll()' class = "btn center red" style = "color: white; margin-top: 10px; margin-left: 4px; font-size: 12px; width: 162px;">Activate All</button>
                <button ng-click='deactivateAll()' class = "btn center red" style = "color: white; margin-left: 4px; margin-top: 10px;font-size: 12px; width: 162px;">Deactivate All</button>
                <button class = "btn center light-green modal-close" style = "margin-left: 40px; margin-top: 120px; color: black;">Done</button>
            </div>
        </div>
    </div>
</div>