@extends('v2.baseLayout')
@section('title', 'Unit Servicing Utility')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/unit-service/controller.js') !!}"></script>

    <div id="modalStorageType" class="modal modal-fixed-footer" style="max-height: 700px;; width: 670px; overflow: hidden">
        <div class="modal-header" style = "width: 755px; height: 55px;">
            <h4 style="padding-left: 230px;font-size: 2.2vw; font-family: fontSketch; color: white;">Storage Type</h4>
        </div>
        <form>
            <div class="modal-content">
                <div class = "col s12">
                    <button name = "action" class="right tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "New Type" style = "margin-top: -20px;" href = "#modalNewStorageType"><i class="material-icons" style = "color: black">add</i></button>
                    <div class = "row">
                        <!-- Data Grid -->
                        <div class = "center col s10" style = "margin-left: 35px; width: 550px;">
                            <div style = "margin-top: -10px; margin-left: -10px;">
                                <div id="admin2">
                                    <div class="z-depth-2 card material-table">
                                        <table id="datatable2">
                                            <thead style = "max-height: 35px;">
                                            <tr style = "max-height: 35px;">
                                                <th style = "width: 50px;"></th>
                                                <th>Type</th>
                                                <th style = "width: 320px; font-size: 12px; padding-left: 10px;">Quantity</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr style = "max-height: 30px;">
                                                <td>
                                                    <form action="#" style = "margin-top: 10px;">
                                                        <p>
                                                            <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
                                                            <label for="filled-in-box"></label>
                                                        </p>
                                                    </form>
                                                </td>
                                                <td style = "margin-top: 0px;">Urn</td>
                                                <td style = "width: 200px;">
                                                    <div class="required input-field col s6" style = "margin-top: 0px; padding-left: -20px;">
                                                        <input id="quantity" type="text" placeholder="Input Quantity" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole number only. Max input: 10<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "10">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style = "height: 50px;">
                                                <td>
                                                    <form action="#" style = "margin-top: 10px;">
                                                        <p>
                                                            <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
                                                            <label for="filled-in-box"></label>
                                                        </p>
                                                    </form>
                                                </td>
                                                <td style = "margin-top: 0px;">Bone Box</td>
                                                <td style = "width: 200px;">
                                                    <div class="required input-field col s6" style = "margin-top: 0px; padding-left: -20px;">
                                                        <input id="quantity" type="text" placeholder="Input Quantity" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole number only. Max input: 10<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "10">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style = "height: 50px;">
                                                <td>
                                                    <form action="#" style = "margin-top: 10px;">
                                                        <p>
                                                            <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
                                                            <label for="filled-in-box"></label>
                                                        </p>
                                                    </form>
                                                </td>
                                                <td style = "margin-top: 0px;">Bone Box</td>
                                                <td style = "width: 200px;">
                                                    <div class="required input-field col s6" style = "margin-top: 0px; padding-left: -20px;">
                                                        <input id="quantity" type="text" placeholder="Input Quantity" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole number only. Max input: 10<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "10">
                                                    </div>
                                                </td>
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
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </form>
    </div>

    <div id="modalNewStorageType" class="modal modal-fixed-footer" style="width: 500px; height: 300px; overflow: hidden">
        <div class="modal-header" style = "width: 755px; height: 55px;">
            <h4 style="padding-left: 85px; font-size: 2.2vw; font-family: fontSketch; color: white;">New Storage Type</h4>
        </div>
        <form>
            <div class="modal-content">
                <div class="input-field col s6">
                    <input id="storageName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Bone Box" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                    <label for="storageName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
                </div>
                <i class = "createReqField left" style = "color: red;">Note: All fields with * are required.</i>

            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
                <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
            </div>
        </form>
    </div>

<div ng-controller="ctrl.unit-service">
    <div class = "col s12" >
        <div class = "row">
            <div class = "col s4">
                <div style = "margin-left: 15px; width: 405px; height: 50px; background-color: #4db6ac;">
                    <center>
                        <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; font-size: 2vw; margin-top: 30px;">Unit Servicing</h2>
                    </center>
                </div>
                <div style = "overflow: auto;height: 370px;">
                    <div class = "col s12">
                        <div class = "aside aside ">
                            <ul>
                                <li ng-repeat="unitType in unitTypeList">
                                    <div style = "height: 55px; background-color: #00897b; border: 2px solid #00c6b1;"><i class="material-icons" style = "font-size: 35px; margin-top: 8px; margin-left: 8px;">business</i>
                                        <h6 style = "font-family: myFirstFont; font-size: 1.5vw; color: white; padding-left: 80px; margin-top: -30px;">@{{ unitType.strRoomTypeName }}</h6>
                                        <button name = "action" ng-click="configureUnitService(unitType)" class="right tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Storage Type" style = "margin-top: -34px; margin-right: 10px;" href = "#configureUnitService"><i class="material-icons" style = "color: black">settings</i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <button name = "action" class="right tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Storage Type" style = "margin-top: -34px; margin-right: 10px;" href = "#modalStorageType"><i class="material-icons" style = "color: black">work</i></button>

    <script type="text/javascript">
        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal({dismissible: false});
        });
    </script>

@include('modals.unit-servicing.configureUnitService')
@endsection