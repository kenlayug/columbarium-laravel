@extends('v2.baseLayout')
@section('title', 'Room Maintenance')
@section('body')
    <link rel = "stylesheet" href = "{!! asset('/css/Floor_Record_Form.css') !!}"/>

    <script type="text/javascript" src = "{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/floor/floor-controller.js') !!}"></script>

    <div ng-app="floorApp">
        <!-- Section -->
        <h2 style = "font-family: fontSketch; padding-left: 55px; font-size: 2vw; padding-top: 20px;">Room Maintenance</h2>
        <div class = "col s12" >
            <div class = "row">
                <div class = "responsive">

                    <div class = "col s4" style = "margin-left: 10px;">


                        <div style = "overflow: auto;height: 470px;">
                            <div class = "col s12">
                                <div class = "aside aside " id="buildingSet" ng-controller="ctrl.buildingCollapsible">
                                    <ul class="collapsible popout" data-collapsible="accordion" watch>
                                        <li ng-repeat="building in buildings">
                                            <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                                <label style = "font-family: myFirstFont; font-size: 1.8vw; color: white;">@{{ building.strBuildingName }}</label>
                                            </div>
                                            <div class="collapsible-body" ng-repeat="floor in building.floor">
                                                <p>@{{ building.strBuildingCode+"-"+floor.intFloorNo }}
                                                    <button ng-click="ConfigureFloor(floor.intFloorId, $index, building.intBuildingId)" name = "action" class="@{{ floor.icon }}" data-position = "bottom" data-delay = "30" data-tooltip = "Floor is not yet configured." style = "margin-left: 5px;"><i class="material-icons">settings</i></button>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Configure -->
                    <div id="modalConfigure" class="modal" style = "width: 650px;" ng-controller="ctrl.configureFloor">
                        <div class = "modal-header" style = "height: 55px;">
                            <h4 style = "color: white; font-family: fontSketch; font-size: 1.9vw; padding-left: 170px;">Room Configuration</h4>
                        </div>
                        <form ng-submit="ConfigureFloor()">
                            <div class="modal-content">

                                <div class = "row">
                                    <div class="input-field col s6">
                                        <select>
                                            <option value="" disabled selected>Select Room Type</option>
                                            <option value="1">Type One</option>
                                            <option value="2">Type Two</option>
                                        </select>
                                        <label>Room Type</label>
                                    </div>

                                    <div class="input-field required col s6">
                                        <input id="maxBlock" type="number" class="validate" required = "" aria-required="true" minlength = "1" length = "20" min="1" max="20">
                                        <label for="maxBlock" data-error = "Invalid format." data-success = "">Maximum Number of Block/s: <span style = "color: red;">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type = "submit" name = "action" class="btn light-green" style = "margin-right: 20px; color: black; margin-left: 10px; ">Confirm</button>
                        </form>
                        <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
                    </div>
                </div>


                <!-- Modal New Room Type -->
                <div id="modalNewRoomType" class="modal" style = "width: 450px;" ng-controller="ctrl.newFloorType">
                    <div class = "modal-header" style = "height: 55px;">
                        <h4 style = "color: white; font-family: fontSketch; padding-left: 100px;; font-size:1.9vw;">Create Room Type</h4>
                    </div>
                    <div class="modal-content">
                        <div class = "col s12">
                            <div class = "row">
                                <div style = "padding-left: 10px;">
                                    <form id="formCreateFloorType" ng-submit="SaveFloorType()">
                                        <div class="input-field col s12">
                                            <input ng-model="floorType.strFloorTypeName" name="floorType.strFloorDesc" id="newFloorTypeDesc" type="text" class="validate" required = "" aria-required = "true">
                                            <label for="newFloorTypeDesc" data-error = "Invalid format." data-success = "">Floor Type Name <span style = "color: red;">*</span></label>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <br><br><br>

                    </div>
                    <div class="modal-footer">
                        <button name = "action" class="btn light-green" style = "color: black; margin-right: 30px; margin-left: 10px; ">Confirm</button>
                        </form>
                        <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
                    </div>
                </div>

                <!-- Data Grid -->
                <div class = "col s7" style = "margin-top: 0px;" ng-controller="ctrl.floorTable">
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

@endsection