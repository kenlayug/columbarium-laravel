@extends('v2.baseLayout')
@section('title', 'Room Maintenance')
@section('body')
    <link rel = "stylesheet" href = "{!! asset('/css/Floor_Record_Form.css') !!}"/>

    <script type="text/javascript" src = "{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/floor/floor-controller.js') !!}"></script>

    <div ng-app="floorApp">
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

                        <ul class="collapsible popout" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header" style = "background-color: #00897b">
                                    <i class="material-icons">business</i><label style = "color: white; font-size: 1.5vw; font-family: fontSketch;">Building One</label></div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12">
                                            <ul class="collapsible" data-collapsible="accordion">
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                        <i class="material-icons">view_module</i>First Floor</div>
                                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                    <p style = "padding-top: 10px;">Create Room
                                                        <button name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: -20px;" href = "#modalCreateRoom"><i class="material-icons" style = "color: black;">add</i></button>
                                                    </p>
                                                     </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room One
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room Two
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                        <i class="material-icons">view_module</i>Second Floor</div>
                                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                        <p style = "padding-top: 10px;">Create Room
                                                            <button name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: -20px;" href = "#modalCreateRoom"><i class="material-icons" style = "color: black;">add</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room One
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room Two
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                        <i class="material-icons">view_module</i>Third Floor</div>
                                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                        <p style = "padding-top: 10px;">Create Room
                                                            <button name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: -20px;" href = "#modalCreateRoom"><i class="material-icons" style = "color: black;">add</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room One
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room Two
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header" style = "background-color: #00897b">
                                    <i class="material-icons">business</i><label style = "color: white; font-size: 1.5vw; font-family: fontSketch;">Building Two</label></div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12">
                                            <ul class="collapsible" data-collapsible="accordion">
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                        <i class="material-icons">view_module</i>First Floor</div>
                                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                        <p style = "padding-top: 10px;">Create Room
                                                            <button name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: -20px;" href = "#modalCreateRoom"><i class="material-icons" style = "color: black;">add</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room One
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room Two
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                        <i class="material-icons">view_module</i>Second Floor</div>
                                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                        <p style = "padding-top: 10px;">Create Room
                                                            <button name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: -20px;" href = "#modalCreateRoom"><i class="material-icons" style = "color: black;">add</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room One
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room Two
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                        <i class="material-icons">view_module</i>Third Floor</div>
                                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                        <p style = "padding-top: 10px;">Create Room
                                                            <button name = "action" class="modal-trigger btn-floating light-green right" style = "margin-top: -5px; margin-right: -20px;" href = "#modalCreateRoom"><i class="material-icons" style = "color: black;">add</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room One
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                        <p style = "padding-top: 10px;">Room Two
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room." style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
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


                    <!-- Modal Create Room -->
                    <div id="modalCreateRoom" class="modalCreateRoom modal" style = "width: 550px;">
                        <div class = "modalRoomTypeHeader modal-header" style = "height: 55px;">
                            <h4 class = "text" style = "color: white; font-family: fontSketch; font-size: 2vw; padding-left: 160px;">Create Room</h4>
                        </div>
                        <form class="modal-content" id="formCreateRoom">

                            <button type = "submit" name = "action" class="btnRoomType modal-trigger btn light-green right" style = "margin-top: 20px; color: black; margin-right: 10px;" href = "#modalRoomType">New Room Type</button>

                            <div class="input-field required col s6">
                                <input id="maxBlock" type="number" class="validate" required = "" aria-required="true" minlength = "1" length = "20" min="1" max="20">
                                <label for="maxBlock" data-error = "Invalid format." data-success = "">Maximum Number of Block/s: <span style = "color: red;">*</span></label>
                            </div>

                            <br><br><br><br>
                            <div action="#">
                                <label style = "font-family: Arial; font-size: 1.2vw; color: black; padding-left: 10px;">Room Type</label>
                                <p  style = "margin-left: 10px;">
                                    <input type="checkbox" id="test5" />
                                    <label for="test5">Room Type One</label>
                                </p>
                                <p  style = "margin-left: 10px;">
                                    <input type="checkbox" id="test6" />
                                    <label for="test6">Room Type Two</label>
                                </p>
                            </div>
                            <br>
                            <div class="modal-footer" style = "margin-bottom: 0px;">
                                <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black;">Confirm</button>
                                <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
                            </div>

                        </form>
                    </div>

                    <!-- Modal Update Room -->
                    <div id="modalUpdateRoom" class="modalUpdateRoom modal" style = "width: 550px;">
                        <div class = "modalRoomTypeHeader modal-header" style = "height: 55px;">
                            <h4 class = "text" style = "color: white; font-family: fontSketch; font-size: 2vw; padding-left: 160px;">Update Room</h4>
                        </div>
                        <form class="modal-content" id="formUpdateRoom">

                            <div class="input-field required col s6">
                                <input id="maxBlockUpdate" type="number" class="validate" required = "" aria-required="true" minlength = "1" length = "20" min="1" max="20">
                                <label for="maxBlockUpdate" data-error = "Invalid format." data-success = "">Maximum Number of Block/s: <span style = "color: red;">*</span></label>
                            </div>

                            <br><br><br><br>
                            <div action="#">
                                <label style = "font-family: Arial; font-size: 1.2vw; color: black; padding-left: 10px;">Room Type</label>
                                <p  style = "margin-left: 10px;">
                                    <input type="checkbox" id="test7" />
                                    <label for="test7">Room Type One</label>
                                </p>
                                <p  style = "margin-left: 10px;">
                                    <input type="checkbox" id="test8" />
                                    <label for="test8">Room Type Two</label>
                                </p>
                            </div>
                            <br>
                            <div class="modal-footer" style = "margin-bottom: 0px;">
                                <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black;">Confirm</button>
                                <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
                            </div>

                        </form>
                    </div>


                    <!-- Modal New Room Type -->
                    <form id="modalRoomType" class="modalRoomType modal" style = "width: 500px;">
                        <div class = "modalRoomTypeHeader modal-header" style = "height: 55px;">
                            <h4 class = "text" style = "color: white; font-family: fontSketch; font-size: 2vw; padding-left: 120px;">New Room Type</h4>
                        </div>
                        <div class="modal-content" id="formCreateRoomType">
                            <div class = "roomType">
                                <div class="input-field col s12">
                                    <input id="itemCategoryDesc" type="text" class="validate" name="item.strItemCategory" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                    <label for="itemCategoryDesc" data-error = "Invalid format." data-success = "">Room Type<span style = "color: red;">*</span></label>
                                    <i class = "modalCatReqField left" style = "color: red;">*Required Fields</i>
                                </div>
                                <br>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black;">Confirm</button>
                            <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
                        </div>

                    </form>

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