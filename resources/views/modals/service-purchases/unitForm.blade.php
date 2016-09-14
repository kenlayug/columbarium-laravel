<div id="unitForm" class="modal modal-fixed-footer" style="overflow-y: hidden; width: 95%; max-height: 120%;">
    <div class="modal-header" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Unit Form</h4></cesnter>
        <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <div class="modal-content" style="overflow-y: auto; clear: bottom;">
        <div class="row">
            <!-- Collapsible -->
                <div class="col s4">
                    <div class="row">
                        <ul class="collapsible" data-collapsible="accordion" watch>
                            <li>
                                <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                    <label style = "font-family: myFirstFont2; font-size: 1.5vw; color: white;">@{{ unitTypeList[unitIndex].strRoomTypeName }}</label>
                                </div>
                                <div ng-repeat="block in unitTypeList[unitIndex].blockList" class="collapsible-body @{{ block.transferColor }}" style = "max-height: 50px;">
                                    <p style = "padding-top: 15px;">@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}
                                        <button ng-click="openTransferUnits(block, $index)" id = "Button1" tooltipped class="right btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Block -->
                <div class="col s8">
                    <div ng-hide="transferShowUnit" id="transferDeceasedStart">
                        <div class="center vaults-content">
                            <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">Select a Block</h2>
                        </div>
                    </div>

                    <!-- Selected Block -->
                    <div ng-show="transferShowUnit" id="transferDeceasedShow">
                        <div class="center vaults-content">
                            <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">@{{ transferBlockName }}</h2>
                            <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                <tbody>
                                    <tr ng-repeat="unitLevel in transferUnitList">
                                        <td class="@{{ unit.color }}" ng-repeat="unit in unitLevel">
                                            <a ng-click="selectTransfer(unit)" class="waves-effect waves-light">@{{ unit.display }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Collapsible -->
    </div>
    <div class="modal-footer">
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Close</a>
    </div>
</div>