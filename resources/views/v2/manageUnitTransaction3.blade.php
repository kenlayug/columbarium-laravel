@extends('v2.baseLayout')
@section('title', 'Manage Unit')
@section('body')

    <link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/vaults.css') !!}">
    <script type="text/javascript" src="{!! asset('/js/manageUnit.js') !!}"></script>
    <script src="{!! asset('/js/tooltip.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('/manage-unit/controller.js') !!}"></script>

    <div ng-controller="ctrl.manage-unit">
        
        <div class = col s12 >
            <div class = "row">
                <div class = "col s4">
                    <div class="row" style="background-color: #00897b; margin-top: 20px; ">
                        <center><h5 style = "margin-left: 20px;  color: white; padding: 20px; padding-bottom: 5px;">Manage Unit</h5></center>
                    </div>
                    <div class="z-depth-1 row"  style="margin-top: -25px;">
                        <div class="input-field col s4">
                            <label  style="color: #000000; font-size: 17px;">Search Building: </label>
                        </div>
                        <div class="input-field col s8">
                            <div style="margin-right: 5px;">
                                <input ng-model="filterBuilding" type="text" placeholder="Building Name" list="buildingName">  
                            </div>
                            <datalist id="buildingName">
                                <option ng-repeat="building in buildingList" ng-value="building.strBuildingName">
                            </datalist>
                        </div>
                    </div> 
                    <div style = "margin-top: -20px;">
                        <div class = "col s12">
                            <div class = "aside aside " style="overflow: auto; height: 400px;">
                                <ul class="collapsible" data-collapsible="accordion" watch>
                                    <li ng-repeat="unitType in unitTypeList">

                                        <div ng-click="getBlocks(unitType, $index)"
                                             class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                            <label style = "font-size: 1.5vw; color: white;">@{{ unitType.strUnitTypeName }}</label>
                                        </div>

                                        <div ng-repeat="block in unitType.blockList"
                                            ng-if="(filterBuilding == null || filterBuilding == '') || (filterBuilding != null && block.strBuildingName.toUpperCase().indexOf(filterBuilding.toUpperCase()) >= 0)"
                                            class="collapsible-body @{{ block.color }}" 
                                            tooltipped
                                            data-position="right"
                                            data-delay="50"
                                            data-tooltip="<u>@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}</u><br>Available: @{{ block.unitStatusCount[1] }}<br>Reserved: @{{ block.unitStatusCount[2] }}<br>At Need: @{{ block.unitStatusCount[4] }}<br>Partially Owned: @{{ block.unitStatusCount[5] }}<br>Owned: @{{ block.unitStatusCount[3] }}<br>Deactivated: @{{ block.unitStatusCount[0] }}"
                                            style = "max-height: 50px;">
                                            <p style = "padding-top: 15px;">@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}
                                                <button ng-click="getUnits(block, $index)"
                                                        id = "Button1" tooltipped class="right btn-floating light-green" data-position = "left" data-delay = "25" data-tooltip = "View" type="button" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                            </p>
                                        </div>
                                        <div ng-if="unitType.blockList.length == 0"
                                             class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                            <p style = "padding-top: 15px;">
                                                No blocks available for this unit type.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class = "col s8">
                    <div class = "row" style = "width: 100%;">
                        <div ng-hide="showUnit" id="tableStart" style="margin-top: 18px; z-index: -1;">
                            <div class = "card material-table" style = "text-align: left">
                                <div class="table-header" style="background-color: #00897b;">
                                    <h4 style = "font-size: 20px; color: white; padding-left: 45%;">Overview</h4>
                                    <div class="actions">
                                        <button ng-click="openSafeBox()" data-target="safeBox" class="right waves-light btn blue modal-trigger" href="#modal1" style = "color: black; margin-right: 0px; float: right;">Safe Box</button>
                                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>

                                </div>
                                <table id="datatable-overviewUnit">
                                    <thead>
                                        <tr>
                                            <th style="font-size:15px; color: #000000;">Customer Name</th>
                                            <th style="font-size:15px; color: #000000;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Chenemer, Chenenen</td>
                                            <td>
                                                <button tooltipped class="waves-light btn light-green modal-trigger"
                                                data-target="purchaseduManageUnit" data-position="bottom" data-delay="30" data-tooltip="View Owned Units" 
                                                style = "color: #000000;">View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>      
                        </div>

                        <div ng-show="showUnit" class="responsive" id="tableUnit" style="margin-top: 45px;">
                            <div class = "col s12 z-depth-1" style="background-color: #e0f2f1; z-index: -1;">
                                <a tooltipped class="right btn-floating btn-flat btn teal" data-position="top" data-delay="30" data-tooltip="Close"
                                    style="position:absolute; color: white; font-weight: 900; margin-top: 25px; margin-left: 15px;">X</a>
                                <div class = "aside aside z-depth-3">
                                    <div class="center vaults-content">
                                        <div class="table-header" style="background-color: #00897b;">
                                            <h2 style = "padding-left: 40px; font-size: 30px; margin-top: 20px; padding: 10px; color: #ffffff;">@{{ blockName }}</h2>
                                        </div>
                                        <button ng-click="openSafeBox()" data-target="safeBox" class="right waves-light btn blue modal-trigger" href="#modal1" style = "color: black; margin-right: 10px; margin-top: -64px; float: right;">Safe Box</button>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                            <tbody>
                                            <tr ng-repeat="unitLevel in unitList">
                                                <td ng-repeat="unit in unitLevel"
                                                    class="@{{ unit.color }}"
                                                    tooltipped
                                                    data-position="bottom"
                                                    data-delay="50"
                                                    data-tooltip="<u>Unit: E3</u><br>Owner: N/A<br>Unit type: Columbary Vault<br>Storage Type: Bone Box<br>No.of Deceased: 1/2"
                                                    style="max-height: 50px;">
                                                    <a ng-click="openModal(unit)"
                                                       data-target="modal1"
                                                       href="#modal1"
                                                       class="waves-effect waves-light modal-trigger">@{{ unit.display }}</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
            </div>
            @include('modals.buy-unit.v2.cheque')
            @include('modals.service-purchases.newDeceasedForm')
            @include('modals.manage-unit.addTransferPullOutForm')
            @include('modals.manage-unit.newCustomer')
            @include('modals.manage-unit.retrieveDeceased')
            @include('modals.manage-unit.returnDeceased')
            @include('modals.manage-unit.purchased-manage-unit')
            @include('modals.manage-unit.safeBox')
            @include('modals.manage-unit.successAddDeceased')
            @include('modals.manage-unit.successPullOutDeceased')
            @include('modals.manage-unit.successReturnDeceased')
            @include('modals.manage-unit.successTransferDeceased')
            @include('modals.manage-unit.successTransferOwnership')
            @include('modals.manage-unit.successSafeBox')
            @include('modals.service-purchases.requirements')
        </div>
    </div>
@endsection