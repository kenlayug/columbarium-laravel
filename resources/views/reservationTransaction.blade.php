@extends('transaction')
@section('title', 'Buy Unit')
@section('body')

<link rel="stylesheet" type="text/css" href="{!! asset('/css/vaults-trans.css') !!}">
<script src="{!! asset('/buy-unit/controller.js') !!}"></script>
<div ng-controller="ctrl.buy-unit">
<div class = "col s12" >
    <div class = "row">
        <div class = "responsive">

            <div class = "col s4">
                <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">Buy Units</h2>

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
                                                                                <i class="material-icons">view_module</i>Room Number @{{ room.intRoomNo }}
                                                                            </div>
                                                                            <div ng-repeat="block in room.blockList" class="collapsible-body" style = "max-height: 50px; background-color: #fbc02d;">
                                                                                <p style = "padding-top: 10px;"><i class="material-icons" style = "padding-right: 10px;">@{{block.icon}}</i>@{{ block.strBlockName}}
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
                <br>
                <div class = "row">
                    <div class = "col s12">
                        <div class = "aside aside z-depth-3" style = "height: 120px;">
                            <div class = "header" style = "height: 35px; background-color: #00897b">
                                <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: myFirstFont2;">Legend:</label>
                            </div>

                            <div class = "row" style = "margin-top: 10px;">
                                <div class = "col s4">
                                    <button id = "configure" name = "action" class="btn-floating green" style = "margin-left: 30px;"></button>
                                    <label style="font-size: 15px; color: #000000;">Available Units</label>
                                </div>
                                <div class = "col s4">
                                    <button id = "notConfigure" name = "action" class="btn-floating red" style = "margin-left: 30px;"></button>
                                    <label style="font-size: 15px; color: #000000;">Owned Units</label>
                                </div>
                                <div class = "col s4">
                                    <button id = "configuredFloorPrice" name = "action" class="btn-floating blue" style = "margin-left: 30px;"></button>
                                    <label style="font-size: 15px; color: #000000;">Reserved Units</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "col s8">
                <div class = "col s4 z-depth-2 " style = "overflow:auto; margin-top: 5px; width: 100%;">
                    {{--<div id="tableStart">--}}
                        {{--<div class = "col s12">--}}
                            {{--<div class = "aside aside z-depth-3">--}}
                                {{--<div class="center vaults-content">--}}
                                    {{--<table style="font-size: small; margin-bottom: 25px;margin-top: 25px">--}}
                                        {{--<tbody>--}}
                                        {{--<tr>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" style = "width: 500px; height: 50px; " href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                            {{--<td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>--}}
                                        {{--</tr>--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class = "col s12" ng-show="unitList != null">
                        <div class = "col s12" style = "margin-top: 20px; width: 100%;">
                            <div class="responsive">
                                <div class = "col s12">
                                    <div class = "aside aside z-depth-3" style = "height: 400px;">
                                        <div class="center vaults-content" style = "height: 400px;">
                                            <h4 style = "font-size: 30px;">@{{ block.strBlockName }}</h4>
                                            <table id="tableUnits" style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                                <tbody>
                                                <tr ng-repeat="unitCategory in unitList">
                                                    <td ng-repeat="unit in unitCategory" style="background-color: #00897b; border: 2px solid white;" class="@{{ unit.color }}">
                                                        <a ng-click="openUnit(unit.intUnitId, $index)" class="waves-effect waves-light" style = "color: white; font-size: 20px; font-family: myfirstfont;">@{{ unit.intUnitId }}</a>
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
                    <!-- Main Form for Manage Service -->
                    <div id="modalUnit" class="modal modal-fixed" style="">
                        <center>
                            <div class="modal-header">
                                <label style="font-size: large">MANAGE SERVICE</label>
                            </div>
                            <form id='form-id'>
                                <br>
                                <input id="1" name='test' type='radio' value="view" checked="checked"/>
                                <label for="1">View</label>

                                <input id="2" name='test' type='radio' value="buy" />
                                <label for="2">Avail Unit</label>
                            </form>

                            <div id='viewDetails' style="background-color: #f3f3f3;">
                                <div style="margin-top: 20px;">
                                    <br>
                                    <label style="font-size: large; text-align: center; color: #000000;">Unit Details</label>
                                </div>
                                <div class="row">
                                    <div class="input-field col s2">
                                        <label><b>Status:</b></label>
                                    </div>
                                    <div class="input-field col s6">
                                        <label><u>@{{ unit.strUnitStatus }}</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s2">
                                        <label><b>Owner Name:</b></label>
                                    </div>
                                    <div class="input-field col s6">
                                        <label><u>LastName, FirstName Middle Name</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s2">
                                        <label><b>Details:</b></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s2">

                                    </div>
                                    <div class="input-field col s5">
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Price:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>@{{ unit.deciPrice|currency }}</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Years:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>6 Years</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Term:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>Semi Annual</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Payment:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>P5,000</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Balance:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>P29,000</u></label>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="input-field col s5">
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Building:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>@{{ unit.strBuildingName }}</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Floor:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>Floor No. @{{ unit.intFloorNo }}</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Room:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>Room No. @{{ unit.intRoomNo }}</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Block:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>@{{ unit.strBlockName }}</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Unit:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>Unit @{{ unit.intUnitId }}</u></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right row" style="margin-top: 50px;">
                                        <div class="input-field col s12">
                                            <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px">Cancel Transaction</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Buy, Reserve, At Need Form -->
                            <div id='buyUnit' style="background-color: #f3f3f3; display:none">
                                <div style="margin-top: 20px;">
                                    <br>
                                    <label style="font-size: large; text-align: center; color: #000000;">Purchase  Form</label>
                                </div>
                                <form class="modal-transfer"method="get" autocomplete="off">
                                    <div class="row">

                                        <div id="Customer">
                                            <div class="row">
                                                <div class="input-field      col s7">
                                                    <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                                                    <label for="cname">Customer Name<span style = "color: red;">*</span></label>
                                                </div>
                                                <div class="input-field col s4">
                                                    <select required = "required">
                                                        <option value="" disabled selected>Select Avail Type<span style = "color: red;">*</span></option>
                                                        <option value="buyU">Buy Unit</option>
                                                        <option value="reserveU">Reserve Unit</option>
                                                        <option value="atNeedU">At Need</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <left>
                                                    <div class="input-field col s2">
                                                        <label><b>Details:</b></label>
                                                    </div>
                                                </left>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s2">

                                                </div>
                                                <div class="input-field col s5">
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Price:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>P55,000</u></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Years:</label>
                                                        </div>
                                                        <div class="input-field col s4">
                                                            <input id="quantity" type="number" required="" aria-required="true" class="validate" min="1" max="30">
                                                            <label for="quantity" data-error="From 1-30 Years Only">To Pay<span style = "color: red;">*</span></label>
                                                        </div>
                                                    </div><br>
                                                    <div class="row" style="margin-top: -70px; margin-bottom: 0;">
                                                        <div class="input-field col s3">
                                                            <label>Payment:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>P5,000</u></label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Balance:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>P29,000</u></label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="input-field col s5">
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Building:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>Building B</u></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Floor:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>Floor 3</u></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Block:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>Block C</u></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Unit:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>Unit B3C5</u></label>
                                                        </div>
                                                    </div><br><br>
                                                </div>
                                            </div>
                                            <div class="right row">
                                                <div class="input-field col s12">
                                                    <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 210px; margin-top: -5px;">Confirm</button>
                                                </div>
                                            </div>
                                            <datalist id="nameList">
                                                <option value="Monkey D. Luffy">
                                                <option value="Roronoa Zoro">
                                                <option value="Vinsmoke Sanji">
                                                <option value="Tony Tony Chopper">
                                                <option value="Nico Robin">
                                            </datalist>
                                        </div>
                                    </div>
                                </form>
                                <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000; margin-left: 450px; margin-top: -145px">Cancel</button>
                            </div>

                            <!-- Buy, Reserve, At Need Radio Buttons -->
                            <script>
                                $("input[name='test']").click(function () {
                                    $('#viewDetails').css('display', ($(this).val() === 'view') ? 'block':'none');
                                    $('#buyUnit').css('display', ($(this).val() === 'buy') ? 'block':'none');
                                    $('#reserveUnit').css('display', ($(this).val() === 'reserve') ? 'block':'none');
                                    $('#atNeedUnit').css('display', ($(this).val() === 'atNeed') ? 'block':'none');
                                });
                            </script>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Show Hide Unit -->x
    <script>
        function switchVisible() {
            if (document.getElementById('tableUnit') !== undefined) {

                if (document.getElementById('tableUnit').style.display == 'block') {
                    document.getElementById('tableUnit').style.display = 'none';
                    document.getElementById('tableStart').style.display = 'block';
                } else {
                    document.getElementById('tableUnit').style.display = 'block';
                    document.getElementById('tableStart').style.display = 'none';
                }
            }
        }
    </script>
    <script>
        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal();
        });


        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
</div>
    </div>
@endsection