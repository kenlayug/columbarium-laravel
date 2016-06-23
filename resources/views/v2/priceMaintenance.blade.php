@extends('v2.baseLayout')
@section('title', 'Block Maintenance')
@section('body')
    <!-- Section -->
    <link rel = "stylesheet" href = "{!! asset('/css/Blocks_Record_Form.css') !!}"/>
{{--    <link rel="stylesheet" type="text/css" href="{!! asset('/css/vaults.css') !!}">--}}
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
                                            <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                <p style = "padding-top: 10px;">Create Block
                                                    <button name = "action" class="modal-trigger btn-floating red right" style = "margin-top: -5px; margin-right: -20px;"><i class="material-icons" style = "color: black;">settings</i></button>
                                                    <button name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: 5px;"><i class="material-icons" style = "color: black;">settings</i></button>
                                                </p>
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
                                                                <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                                    <p style = "padding-top: 10px;">Create Block
                                                                        <button ng-click="openCreate()" name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: -20px;"><i class="material-icons" style = "color: black;">settings</i></button>
                                                                    </p>
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
                                                                                        <i class="material-icons">view_module</i>Room Number @{{ room.intRoomNo }}
                                                                                    </div>
                                                                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                                                        <p style = "padding-top: 10px;">Create Block
                                                                                            <button ng-click="openCreate()" name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: -20px;"><i class="material-icons" style = "color: black;">add</i></button>
                                                                                        </p>
                                                                                    </div>
                                                                                    <div ng-repeat="block in room.blockList" class="collapsible-body" style = "max-height: 50px; background-color: #fbc02d;">
                                                                                        <p style = "padding-top: 10px;"><i class="material-icons" style = "padding-right: 10px;">@{{block.icon}}</i>@{{ block.strBlockName}}
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


                    <!-- Modal Create -->
                    <div id="modalCreateBlock" class="modal" style = "width: 550px;">
                        <div class = "modal-header" style = "height: 55px;">
                            <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">Create Block</h4>
                        </div>
                        <form id="createBlockForm" style = "padding-bottom: 0px;" ng-submit="createBlock()">

                            <div style = "margin-top: 0px; padding-top: 0px; padding-left: 10px;">
                                <div class="input-field col s12" style = "padding-bottom: 20px;">
                                    <input ng-model="newBlock.strBlockName" id="blockName" type="text" class="validate" required = "" aria-required="true" length = "50" maxlength = "50">
                                    <label for="blockName" data-error = "Invalid format." data-success = "">Block Name<span style = "color: red;">*</span></label>
                                </div>

                                <div class="row" style = "padding-top: 0px;">
                                    <h5 style = "padding-bottom: 0px; font-family: arial; font-size: 20px;">Block size:</h5>
                                    <div class="input-field col s6" style = "padding-left: 10px;">
                                        <input ng-model="newBlock.intLevelNo" id="blockLevel" type="number" class="validate" required = "" aria-required = "true" min = "1" max = "10">
                                        <label for="blockLevel" data-error = "1-10 only" data-success = "">Level/s:<span style = "color: red;">*</span></label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input ng-model="newBlock.intColumnNo" id="blockColumn" type="number" class="validate" required = "" aria-required = "true" min = "1" max = "20">
                                        <label for="blockColumn" data-error = "1-20 only" data-success = "">Unit/s:<span style = "color: red">*</span></label>
                                    </div>
                                    <div class="input-field col s6" id="divUnitType">
                                        <input ng-model="newBlock.intUnitType" type="radio" name="unitType" value="1" id="columbary">
                                        <label for="columbary">Columbary Vault</label>
                                        <input ng-model="newBlock.intUnitType" type="radio" name="unitType" value="2" id="fullbody">
                                        <label for="fullbody">Full Body Crypt</label>
                                    </div>
                                </div>
                            </div>

                            <i class = "left" style = "padding-top: 20px; margin-bottom: 0px; padding-left: 30px; color: red;">*Required Fields</i>
                            <div style = "margin-top: 50px;">
                                <div class="modal-footer">
                                    <button name = "action" class="btn light-green" style = "color: black; margin-left: 10px;">Confirm</button>
                                    <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Update -->
                    <div id="modalUpdateBlock" class="modal" style = "width: 400px;">
                        <form ng-submit="saveUpdate()">
                            <div class = "modal-header" style = "height: 55px;">
                                <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw;">Update Block</h4>
                            </div>
                            <div class="modal-content">
                                <div style = "padding-left: 10px;">
                                    <div class="input-field col s12">
                                        <input ng-model="updateBlock.strBlockName" value=" " id="newBlockName" type="text" class="validate" required = "" aria-required = "true" length = "50" maxlength = "50">
                                        <label class = "active" for="newBlockName" data-error = "Invalid format." data-success = "">New Block Name <span style = "color: red;">*</span></label>
                                    </div>
                                </div>
                                <i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>
                            </div>
                            <br><br><br><br>
                            <div class="modal-footer">
                                <button type = "submit" name = "action" class="btn light-green" style = "margin-right: 20px; color: black; margin-left: 10px; ">Confirm</button>
                                <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Modal Archive Block-->
                <div id="modalArchiveBlock" class="modal" style = "height: 400px; width: 600px;">
                    <div class="modal-content">
                        <!-- Data Grid Deactivated Block/s-->
                        <div id="admin1" class="col s12" style="margin-top: 0px">
                            <div class="z-depth-2 card material-table" style="margin-top: 0px">
                                <div class="table-header" style="height: 45px; background-color: #00897b;">
                                    <h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 1.8vw; color: white; padding-left: 0px;">Archive Block/s</h4>
                                    <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 150px; color: #ffffff;">search</i></a>
                                </div>
                                <table id="datatable2">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Building-Floor</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="block in deactivatedBlocks">
                                        <td>@{{ block.strBlockName }}</td>
                                        <td>@{{ block.strBuildingCode+"-"+block.intFloorNo }}</td>
                                        <td>
                                            <button ng-click="ReactivateBlock(block.intBlockId, $index)" name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button name = "action" class="btn light-green modal-close right" style = "color: black; margin-bottom: 10px; margin-right: 30px;">DONE</button>
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

                <div class = "col s7" ng-hide="false">
                    <div class = "col s4" style = "margin-top: 20px; width: 100%;">
                        <div class="responsive">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3" style = "height: 400px;">
                                    <div class="center vaults-content" style = "overflow: auto; height: 400px;">
                                        <h4 style = "font-size: 30px;">Block Price Configuration</h4>
                                            <table id="tableUnits" style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                                <tbody>
                                                <tr>
                                                    <td style="background-color: #00897b; border: 2px solid white;">
                                                        <a ng-click="OpenConfig(unitCategory.intUnitCategoryId, $index)" class="waves-effect waves-light" style = "padding-left: 320px; color: white; font-size: 20px; font-family: myfirstfont;">Level A</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: #00897b; border: 2px solid white;">
                                                        <a ng-click="OpenConfig(unitCategory.intUnitCategoryId, $index)" class="waves-effect waves-light" style = "padding-left: 320px; color: white; font-size: 20px; font-family: myfirstfont;">Level B</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: #00897b; border: 2px solid white;">
                                                        <a ng-click="OpenConfig(unitCategory.intUnitCategoryId, $index)" class="waves-effect waves-light" style = "padding-left: 320px; color: white; font-size: 20px; font-family: myfirstfont;">Level C</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: #00897b; border: 2px solid white;">
                                                        <a ng-click="OpenConfig(unitCategory.intUnitCategoryId, $index)" class="waves-effect waves-light" style = "padding-left: 320px; color: white; font-size: 20px; font-family: myfirstfont;">Level D</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: #00897b; border: 2px solid white;">
                                                        <a ng-click="OpenConfig(unitCategory.intUnitCategoryId, $index)" class="waves-effect waves-light" style = "padding-left: 320px; color: white; font-size: 20px; font-family: myfirstfont;">Level E</a>
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
     </div>

    <div id="modalUnit" class="modal modal-fixed">
        <div class="modal-header">
            <label style="font-size: 1.8vw" class="center">Unit Status</label>
        </div>
        <div class="row">
            <div class="input-field col s3">
                <input ng-model="unit.intUnitId" id="unitToToggle" type="hidden">
                <label style="font-size: 20px">Unit Id: <span style="color: black">@{{ unit.intUnitId }}</span></label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s3">
                <label style="font-size: 20px">Status: <span style="color: @{{ unit.colorStatus }}" id="unitStatus">@{{ unit.strUnitStatus }}</span></label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s3">
            </div>
            <div class="input-field col s6">
                <button ng-hide="unit.intUnitStatus == 0 " ng-click="deactivateUnit(unit.intUnitId)" id="btnDeactivate" class="waves-effect waves-light btn red right" style = "width: 135px;  margin-top: 20px; margin-bottom: 10px;" type="submit">Deactivate</button>
                <button ng-show="unit.intUnitStatus == 0" ng-click="activateUnit(unit.intUnitId)" id="btnActivate" class="waves-effect waves-light btn red right" style = "width: 130px;  margin-top: 20px; margin-bottom: 10px; margin-right: 10px;" type="submit">Activate</button>
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
    </div>
@endsection