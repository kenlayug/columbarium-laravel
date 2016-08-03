<!-- Modal Archive Interest-->
<div id="modalArchiveInterest" class="archiveDataGrid modal">
    <div class = "modal-header">
        <h4 class = "center" style = "color: white; font-size: 2.3vw; font-family: fontSketch; margin-top: -20px;">Archive Interest/s</h4>
    </div>
    <div class="modalArchiveContent modal-content">
        <div class = "row">
            <div id="admin1" class="col s9">
                <div class="z-depth-2 card material-table">
                    <table id="datatable2" datatable='ng'>
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
                <button class = "btn center red" style = "color: white; margin-top: 10px; margin-left: 65px; font-size: 12px; width: 162px;">Activate All</button>
                <button class = "btn center red" style = "color: white; margin-left: 65px; margin-top: 10px;font-size: 12px; width: 162px;">Deactivate All</button>
                <button class = "btn center light-green modal-close" style = "margin-left: 100px; margin-top: 120px; color: black;">Done</button>
            </div>
        </div>
    </div>
</div>