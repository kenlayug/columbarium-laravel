@extends('maintenanceLayout')

@section('body')
    <link rel = "stylesheet" href = "{!! asset('/css/Floor_Record_Form.css') !!}"/>

    <script type="text/javascript" src = "{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/floor/floor-controller.js') !!}"></script>

    <div ng-app="floorApp">
        <!-- Section -->
        <div style = "margin-left: 55px; width: 357px; height: 50px; background-color: #4db6ac;">
            <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; padding-left: 40px; font-size: 2vw; margin-top: 30px;">Floor Maintenance</h2>
        </div>

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
                                                <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">@{{ building.strBuildingName }}</label>
                                            </div>
                                            <div class="collapsible-body" ng-repeat="floor in building.floor" style = "max-height: 50px;">
                                                <p style = "padding-top: 15px;">@{{ building.strBuildingCode+"-"+floor.intFloorNo }}
                                                    <button ng-click="ConfigureFloor(floor.intFloorId, $index, building.intBuildingId)" name = "action" class="@{{ floor.icon }}" data-position = "bottom" data-delay = "30" data-tooltip = "Price is not yet configured." style = "margin-top: -10px; margin-left: 5px;"><i class="material-icons">&#x20B1;</i></button>
                                                    <button ng-click="ConfigureFloor(floor.intFloorId, $index, building.intBuildingId)" name = "action" class="@{{ floor.icon }}" data-position = "bottom" data-delay = "30" data-tooltip = "Floor is not yet configured." style = "margin-top: -10px; margin-left: 5px;"><i class="material-icons">settings</i></button>
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
                            <h4 style = "color: white; font-family: fontSketch; font-size: 1.9vw; padding-left: 180px;">Floor Configuration</h4>
                        </div>
                        <form ng-submit="ConfigureFloor()">
                            <div class="modal-content">
                                <div class = "row">
                                    <div class="input-field required col s6">
                                        <input id="maxBlock" type="number" class="validate" required = "" aria-required="true" minlength = "1" length = "20" min="1" max="20">
                                        <label for="maxBlock" data-error = "Invalid format." data-success = "">Number of Block/s: <span style = "color: red;">*</span></label>
                                    </div>
                                    <button name = "action" class="btn tooltipped modal-trigger light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "New Floor Type" style = "margin-top: 20px; color: black; margin-left: 5px;" href = "#modalNewFloorType">New Floor Type</button>
                                </div>
                                <input ng-model="configure.intFloorId" type="hidden" id="floorIdToBeConfigured">
                                <br>
                                <div class = "row">
                                    <h3 style = "font-size: 18px; padding-left: 20px;">Select Floor Type</h3>
                                    <div class = "col s6" style = "padding-left: 20px;" id="firstDivFloorType" ng-repeat="floorType in floorTypes">
                                        <input type="checkbox" id="@{{ floorType.intFloorTypeId }}" name="floorTypes[]" value="@{{ floorType.intFloorTypeId }}" />
                                        <label for="@{{ floorType.intFloorTypeId }}">@{{ floorType.strFloorTypeName }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type = "submit" name = "action" class="btn light-green" style = "margin-right: 20px; color: black; margin-left: 10px; ">Confirm</button>
                        </form>
                        <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
                    </div>
                </div>


                <!-- Modal New Floor Type -->
                <div id="modalNewFloorType" class="modal" style = "width: 450px;" ng-controller="ctrl.newFloorType">
                    <div class = "modal-header" style = "height: 55px;">
                        <h4 style = "font-family: myFirstFont2; padding-left: 20px;; font-size:1.8vw;">Create Floor Type</h4>
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


                <!-- Modal Price -->
                <div id="modalUpdatePrice" class="modal" style = "width: 700px;">
                    <div class = "modal-header" style = "height: 55px;">
                        <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw; ">Block Price</h4>
                    </div>
                    <div class="modal-content">
                        <div class = "col s12">
                            <div class = "row">
                                <div style = "padding-left: 10px;">
                                    <div class="input-field col s6" ng-repeat="unitCategory in unitCategories">
                                        <input id="UC@{{ unitCategory.intUnitCategoryId }}" type="text" class="validate" required = "" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                                        <label for="UC@{{ unitCategory.intUnitCategoryId }}" data-error = "Invalid format.">Level @{{ unitCategory.intLevelNo }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button name = "action" class="waves-effect waves-light btn light-green" style = "color: black; margin-left: 10px; margin-right: 40px;">Confirm</button>
                        <button name = "action" class="waves-effect waves-light btn light-green modal-close" style = "color: black;">Cancel</button>
                    </div>
                </div>


                <!-- Data Grid -->
                <div class = "col s7" style = "margin-top: 0px;" ng-controller="ctrl.floorTable">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style="background-color: #00897b;">
                                    <h4 style = "font-family: fontSketch; font-size: 1.8vw; color: white; padding-left: 0px;">Floor Record</h4>
                                    <div class="actions">
                                        <!-- <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Floor/s" style = "margin-right: 10px;" href = "#modalArchiveFloor"><i class="material-icons" style = "color: black;">delete</i></button> -->
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatable" watch>
                                    <thead>
                                    <tr>
                                        <th>Building Name</th>
                                        <th>No. of Floors</th>
                                        <th>No. of Floor/s to be configured</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="building in buildings">
                                        <td>@{{ building.strBuildingName }}</td>
                                        <td>@{{ building.floor.length }}</td>
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
    </div></div></div></div></div></div></div></div></div>
@endsection