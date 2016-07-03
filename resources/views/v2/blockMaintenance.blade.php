@extends('v2.baseLayout')
@section('title', 'Block Maintenance')
@section('body')
    <!-- Section -->
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/Blocks_Record_Form.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('/css/vaults.css') !!}">
    <script src="{!! asset('/block/controller.js') !!}"></script>

    <div ng-controller="ctrl.block">
        <div style = "margin-left: 55px; width: 372px; height: 50px; background-color: #4db6ac;">
            <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; padding-left: 40px; font-size: 2vw; margin-top: 30px;">Block Maintenance</h2>
        </div>
        <div class = "col s12" >
            <div class = "row">
                <div class = "responsive">

                    <div class = "col s4" style = "width: 420px; margin-left: 30px;">

                        <div style = "overflow: auto;height: 370px;">
                            <div class = "col s12">
                                <div class = "aside aside ">

                                    <ul class="collapsible" data-collapsible="accordion" watch>
                                        <li ng-repeat="building in buildingList">
                                            <div ng-click="getFloors(building.intBuildingId, $index)" class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                                <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">@{{ building.strBuildingName }}</label>
                                            </div>
                                            <div ng-show="building.floorList.length == 0" class="collapsible-body" style = "background-color: #fb8c00;">
                                                <p>No floor configured to create a block.</p>
                                            </div>
                                            <div class="collapsible-body" ng-hide="building.floorList.length == 0">
                                                <div class="row">
                                                    <div class="col s12 m12">
                                                        <ul class="collapsible" data-collapsible="accordion">
                                                            <li ng-repeat="floor in building.floorList">
                                                                <div ng-click="getRooms(floor.intFloorId, $index)" class="collapsible-header orange"><i class="medium material-icons">business</i>
                                                                    <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">Floor No @{{ floor.intFloorNo }}</label>
                                                                </div>
                                                                <div ng-show="floor.roomList.length == 0" class="collapsible-body" style = "background-color: #fb8c00;">
                                                                    <p>No room configured to create a block.</p>
                                                                </div>
                                                                <div ng-hide="floor.roomList.length == 0" class="collapsible-body">
                                                                    <div class="row">
                                                                        <div class="col s12 m12">
                                                                            <ul class="collapsible" data-collapsible="accordion">
                                                                                <li ng-repeat="room in floor.roomList">
                                                                                    <div ng-click="getBlocks(room.intRoomId, $index)" class="collapsible-header" style = "background-color: #fb8c00;">
                                                                                        <i class="material-icons">view_module</i>@{{ room.strRoomName }}
                                                                                    </div>
                                                                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                                                        <p style = "padding-top: 10px;">Create Block
                                                                                            <button ng-click="openCreate(room.intRoomId)" name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: -20px;"><i class="material-icons" style = "color: black;">add</i></button>
                                                                                        </p>
                                                                                    </div>
                                                                                    <div ng-repeat="block in room.blockList" class="collapsible-body" style = "max-height: 50px; background-color: #fbc02d;">
                                                                                        <p style = "padding-top: 10px;"><i class="material-icons" style = "padding-right: 10px;">@{{block.icon}}</i>Block No. @{{ block.intBlockNo}}
                                                                                            <button ng-click="deleteBlock(block.intBlockId, $index)" name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Floor price is not yet configured."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                                                            <button ng-click="updateBlock(block.intBlockId, $index)" name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Floor is not yet configured." style = "margin-top: -5px; margin-left: 5px;"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                                                            <button ng-click="getUnits(block.intBlockId)" name = "action" class="btn tooltipped light-green right btn-floating" data-position = "bottom" data-delay = "30" data-tooltip = "View Block" style = "margin-top: -5px; margin-right: 0px; font-family: arial; color: black;" ><i class="material-icons" style = "color: black">visibility</i></button>
                                                                                        </p>
                                                                                    </div>
                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Grid -->
                <div class = "col s7" style = "margin-top: 0px; margin-left: 30px;" ng-show="false">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style="background-color: #00897b;">
                                    <h4 style = "font-family: fontSketch; font-size: 1.9vw; color: white; padding-left: 0px;">Block Record</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Block/s" style = "margin-right: 10px;" href = "#modalArchiveBlock"><i class="material-icons" style = "color: black">delete</i></button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Floor Number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="block in blocks">
                                        <td>@{{ block.strBlockName }}</td>
                                        <td>@{{ block.strUnitType }}</td>
                                        <td>@{{ block.strBuildingName }}</td>
                                        <td>@{{ block.strBuildingCode + "-" + block.intFloorNo }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class = "col s7" ng-hide="true">
                    <div class = "col s4" style = "margin-top: 20px; width: 100%;">
                        <div class="responsive">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3" style = "height: 400px;">
                                    <div class="center vaults-content" style = "overflow: auto; height: 400px;">
                                        <h4 style = "font-size: 30px;">Block Price Configuration</h4>
                                            <table id="tableUnits" style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                                <tbody>
                                                <tr ng-repeat="unitCategory in unitCategories">
                                                    <td style="background-color: #00897b; border: 2px solid white;">
                                                        <a ng-click="OpenConfig(unitCategory.intUnitCategoryId, $index)" class="waves-effect waves-light" style = "padding-left: 320px; color: white; font-size: 20px; font-family: myfirstfont;">Level @{{ unitCategory.intLevelNo }}</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <a ng-click="CloseConfig()" class="waves-effect waves-light btn">Done</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class = "col s7" ng-hide="false">
                    <div class = "col s4" style = "margin-top: -60px; width: 100%;">
                        <div class="responsive">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3" style = "height: 500px; background-color: #e0f2f1;">
                                    <div class="center vaults-content" style = "height: 400px;">
                                        <div style = "margin-left: 0px; width: 729px; height: 50px; background-color: #4db6ac;">
                                            <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; padding-left: 0px; font-size: 2vw; margin-top: 30px;">Block No.@{{ block.intBlockNo }} (@{{ block.strRoomTypeName }})</h2>
                                        </div>

                                            <table id="tableUnits" style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                                <tbody>
                                                <tr ng-repeat="unitCategory in unitList">
                                                    <td ng-repeat="unit in unitCategory" style="background-color: #00897b; border: 2px solid white;" class="@{{ unit.color }}">
                                                        <a ng-click="openUnit(unit.intUnitId, $index)" class="waves-effect waves-light" style = "color: white; font-size: 20px; font-family: myfirstfont;">@{{ unit.levelLetter+unit.intColumnNo }}</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <a ng-click="CloseConfig()" class="waves-effect waves-light btn">Done</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    <script>
        $(document).ready(function() {
            $('input#input_text, textarea#textarea1').characterCounter();
        });
        $('.modal-trigger').leanModal({
            dismissible: false
        });
    </script>

    @include('modals.block.create')
    @include('modals.block.archive')
    @include('modals.block.update')
    @include('modals.block.unitStatus')
</div>
@endsection