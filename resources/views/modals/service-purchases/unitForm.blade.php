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
                            <li ng-repeat="unitType in unitTypeList">
                                <div ng-click="getBlocks(unitType, $index)" class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                    <label style = "font-size: 1.5vw; color: white;" ng-bind="unitType.strUnitTypeName"></label>
                                </div>
                                <div ng-repeat="block in unitType.blockList" 
                                tooltipped class="collapsible-body @{{ block.color }}"
                                data-position="right"
                                data-delay="50"
                                data-tooltip="<u>@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}</u><br>Available: @{{ block.unitStatusCount[1] }}<br>Reserved: @{{ block.unitStatusCount[2] }}<br>At Need: @{{ block.unitStatusCount[4] }}<br>Partially Owned: @{{ block.unitStatusCount[5] }}<br>Owned: @{{ block.unitStatusCount[3] }}<br>Deactivated: @{{ block.unitStatusCount[0] }}"
                                style = "max-height: 50px;">
                                    <p style = "padding-top: 15px;">@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}
                                        <button ng-click="getUnits(block, $index)" id = "Button1" 
                                        tooltipped class="right btn-floating light-green" 
                                        data-position = "left" data-delay = "25" data-tooltip = "View" type="button" 
                                        style="margin-top: -10px;"><i class="material-icons" 
                                        style="color: #000000">visibility</i></button>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            <!-- Collapsible -->
                <!-- Block -->
                <div class="col s8">
                    <div ng-hide="block != null" id="transferDeceasedStart">
                        <div class="z-depth-1 center vaults-content">
                            <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; padding: 20px;">Select a Block</h2>
                        </div>
                    </div>

                    <!-- Selected Block -->
                    <div ng-show="block != null" id="transferDeceasedShow">
                        <div class="z-depth-3 center vaults-content" style="background-color: #e0f2f1; margin-top: -20px;">
                            <a ng-click="closeBlock()" tooltipped class="left btn-floating btn-flat btn teal" data-position="right" data-delay="30" data-tooltip="Close" style="position:absolute; color: white; font-weight: 900; margin-top: 17px; margin-left: -380px;">X</a>
                            <div class="table-header" style="background-color: #00897b;">
                                <h2 style = "font-size: 30px; margin-top: 30px; margin-left: 20px; padding: 20px;">@{{ blockName }}</h2>
                            </div>
                            <table id="unitFormBorder" style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                <tbody>
                                    <tr ng-repeat="unitLevel in unitList">
                                        <td class="@{{ unit.color }}" ng-repeat="unit in unitLevel" style="border: 2px solid #00beab;">
                                            <a ng-click="selectUnit(unit)" style="color: #000000;" 
                                            tooltipped class="waves-effect waves-light"
                                            data-position="bottom"
                                                            data-delay="50"
                                                            data-tooltip="<u>Unit: @{{ unit.display }}</u><br>Owner: @{{ unit.strCustomerName }}<br>Price: @{{ unit.unitPrice.deciPrice | currency : 'P' }}<br>Unit Type: @{{ unit.strUnitTypeName }}<br>Status: @{{ unit.strUnitStatus }}"
                                                           
                                            >@{{ unit.display }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Legends -->
                        <div class = "row" style="margin-top: -30px; margin-right: -10px; margin-left: -10px;">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3" style = "height: 155px;">
                                    <div class="row" style="background-color: #00897b; margin-top: 20px; ">
                                        <center><h5 style = "margin-left: 20px;  color: white; padding: 20px; padding-bottom: 5px;">Legend</h5></center>
                                    </div>

                                    <div class = "row" style = "margin-top: -10px;">
                                        <center>
                                            <div class = "col s2">
                                                <button name = "action" class="btn-floating green darken-3" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[1]"></button>
                                                <br><label style="font-size: 15px; color: #000000;">Available</label>
                                            </div>
                                            <div class = "col s2" style = "margin-left: -5px;">
                                                <button name = "action" class="btn-floating blue darken-3" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[2]"></button>
                                                <br><label style="font-size: 15px; color: #000000;">Reserved</label>
                                            </div>
                                            <div class = "col s2">
                                                <button name = "action" class="btn-floating yellow darken-2" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[4]"></button>
                                                <br><label style="font-size: 15px; color: #000000;">AtNeed</label>
                                            </div>
                                            <div class = "col s2">
                                                <button name = "action" class="btn-floating pink darken-1" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[6]"></button>
                                                <br><label style="font-size: 15px; color: #000000;">Partially Owned</label>
                                            </div>
                                            <div class = "col s2">
                                                <button name = "action" class="btn-floating red darken-3" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[3]"></button>
                                                <br><label style="font-size: 15px; color: #000000;">Owned</label>
                                            </div>
                                            <div class = "col s2">
                                                <button name = "action" class="btn-floating orange darken-1" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[0]"></button>
                                                <br><label style="font-size: 15px; color: #000000;">Deactivated</label><br>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <br><br>
    </div>
    <div class="modal-footer">
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Close</a>
    </div>
</div>