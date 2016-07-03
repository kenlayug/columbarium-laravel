@extends('v2.baseLayout')
@section('title', 'Room Maintenance')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script type="text/javascript" src = "{!! asset('/js/index.js') !!}"></script>
    <script src="{!! asset('room/controller.js') !!}"></script>

    <div ng-controller="ctrl.room">
        <!-- Section -->
        <div style = "margin-left: 55px; width: 372px; height: 50px; background-color: #4db6ac;">
            <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; padding-left: 40px; font-size: 2vw; margin-top: 30px;">Room Maintenance</h2>
        </div>
        <div class = "col s12" >
            <div class = "row">
                <div class = "responsive">


        <div class = "col s4" style = "width: 465px; margin-left: 7px;">

            <div style = "overflow: auto;height: 370px;">
                <div class = "col s12">
                    <div class = "aside aside ">

                        <ul class="collapsible popout" data-collapsible="accordion" watch>
                            <li ng-repeat="building in buildingList">
                                <div ng-click="getFloors(building.intBuildingId, $index)" class="collapsible-header" style = "background-color: #00897b">
                                    <i class="material-icons">business</i><label style = "color: white; font-size: 1.5vw; font-family: fontSketch;">@{{ building.strBuildingName }}</label></div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12">
                                            <ul class="collapsible" data-collapsible="accordion" watch>
                                                <li ng-repeat="floor in building.floorList">
                                                    <div ng-click="getRooms(floor.intFloorId, $index)" class="collapsible-header" style = "background-color: #fb8c00;">
                                                        <i class="material-icons">view_module</i>Floor @{{ floor.intFloorNo }}</div>
                                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                    <p style = "padding-top: 10px;">Create Room
                                                        <button ng-click="createRoom()" name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: -20px;" href = "#modalCreateRoom"><i class="material-icons" style = "color: black;">add</i></button>
                                                    </p>
                                                     </div>
                                                    <div ng-repeat="room in floor.roomList" class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room @{{ room.intRoomNo }}
                                                            <button ng-click="deleteRoom(room.intRoomId, $index)" name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button ng-click="openUpdate(room.intRoomId)" name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
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
        </div>
    </div>


                <!-- Data Grid -->
                <div class = "col s7" style = "margin-top: 0px;">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style="background-color: #00897b;">
                                    <h4 style = "font-family: fontSketch; font-size: 1.8vw; color: white; padding-left: 0px;">Room Record</h4>
                                    <div class="actions">
                                        <!-- <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Floor/s" style = "margin-right: 10px;" href = "#modalArchiveFloor"><i class="material-icons" style = "color: black;">delete</i></button> -->
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatable" watch>
                                    <thead>
                                    <tr>
                                        <th>Building Name</th>
                                        <th>No. of Room/s</th>
                                        <th>Rooms to be Configured</th>
                                        <th>Max Block/s</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="building in buildings">
                                        <td>@{{ building.strBuildingName }}</td>
                                        <td>@{{ building.floor.length }}</td>
                                        <td>@{{ building.noFloorConfig }}</td>
                                        <td>@{{ building.noFloorConfig }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
        $('.modal-trigger').leanModal({
                    dismissible: false
                }
        );
    </script>
        @include('modals.room.create')
        @include('modals.room.update')
        @include('modals.room.newRoomType')
</div>
@endsection