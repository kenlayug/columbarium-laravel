@extends('v2.baseLayout')
@section('title', 'Unit Servicing Utility')
@section('body')

<script type="text/javascript" src="{!! asset('/unit-service/controller.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>

<script type="text/javascript">
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
    });
</script>

<div ng-controller="ctrl.unit-service">
    <div class="row" style="max-height: 409px;">
    
        <div class="col s4" style="overflow-y: auto;">
            <div class="row" style = "height: 60px; background-color: #4db6ac;">
                <center>
                    <h2 style = "padding-top: 15px; color: white; font-family: fontSketch; font-size: 2vw; margin-top: 20px;">Unit Servicing</h2>
                </center>
            </div>
            <div class = "row">
                <ul>
                    <li>
                        <div style = "height: 55px; width: 400px; background-color: #00897b; border: 2px solid #00c6b1; margin-left: 4%;"><i class="material-icons" style = "font-size: 35px; margin-top: 8px; margin-left: 8px;">business</i>
                            <h6 style = "font-family: myFirstFont; font-size: 1.5vw; color: white; padding-left: 80px;margin-top: -30px;">Columbarium Vault</h6>
                            <button data-target="#" class="right waves-light btn red modal-trigger" href="#" style = "color: #000000; margin-right: 10px; margin-top: -35px;"><i class="material-icons">settings</i>
                            </button>
                        </div>
                    </li>
                    <li>
                        <div style = "height: 55px; width: 400px; background-color: #00897b; border: 2px solid #00c6b1; margin-left: 4%;"><i class="material-icons" style = "font-size: 35px; margin-top: 8px; margin-left: 8px;">business</i>
                            <h6 style = "font-family: myFirstFont; font-size: 1.5vw; color: white; padding-left: 80px;margin-top: -30px;">Fullbody Crypts</h6>
                            <button data-target="#" class="right waves-light btn light-green modal-trigger" href="#" style = "color: #000000; margin-right: 10px; margin-top: -35px;"><i class="material-icons">settings</i>
                            </button>
                        </div>
                    </li>

                    <!--
                        <li ng-repeat="unitType in unitTypeList">
                            <div style = "height: 55px; background-color: #00897b; border: 2px solid #00c6b1;"><i class="material-icons" style = "font-size: 35px; margin-top: 8px; margin-left: 8px;">business</i>
                                <h6 style = "font-family: myFirstFont; font-size: 1.5vw; color: white; padding-left: 80px; margin-top: -30px;">@{{ unitType.strRoomTypeName }}</h6>
                                <button ng-click="configureUnitService(unitType)"
                                    data-target="configureUnitService"
                                    class="right waves-light btn light-green modal-trigger"
                                    style="color: #000000; color: #000000; margin-top: -50px; margin-right: 10px;">
                                    Unit Services
                                </button>
                                <button ng-click="configureUnitStorageType(unitType)"
                                    class="btn">
                                    Unit Storage Types
                                </button>
                            </div>
                        </li>
                    -->
                </ul>
            </div>
        </div>


        <div class="z-depth-2 col s8" style="margin-top: 20px; padding:0; margin-left: -11px;">
            <div class="row">

                <div class="col s6" style="border: 3px solid #00897b;">
                    <div class="row" style="background-color: #4db6ac; margin-left: -12px; margin-right: -12px; margin-top: -30px;">
                        <center>
                            <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; font-size: 2vw; margin-top: 30px;">Assign Service</h2>
                        </center>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label style="font-size: 15px;">Add Deceased:</label>
                        </div>
                        <div class="col s6">
                            <select ng-model="add.intServiceIdFK"
                                    material-select>
                                <option value="" disabled selected>Select Service*</option>
                                <option ng-repeat="service in serviceList"
                                        value="@{{ service.intServiceId }}">@{{ service.strServiceName }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label style="font-size: 15px;">Transfer Deceased:</label>
                        </div>
                        <div class="col s6">
                            <select ng-model="transfer.intServiceIdFK"
                                    material-select>
                                    <option value="" disabled selected>Select Service*</option>
                                    <option ng-repeat="service in serviceList"
                                            value="@{{ service.intServiceId }}">@{{ service.strServiceName }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label style="font-size: 15px;">Borrow Deceased:</label>
                        </div>
                        <div class="col s6">
                            <select ng-model="borrow.intServiceIdFK"
                                    material-select>
                                <option value="" disabled selected>Select Service*</option>
                                <option ng-repeat="service in serviceList"
                                        value="@{{ service.intServiceId }}">@{{ service.strServiceName }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label style="font-size: 15px;">Pull Out Deceased:</label>
                        </div>
                        <div class="col s6">
                            <select ng-model="pull.intServiceIdFK"
                                    material-select>
                                <option value="" disabled selected>Select Service*</option>
                                <option ng-repeat="service in serviceList"
                                        value="@{{ service.intServiceId }}">@{{ service.strServiceName }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col s6" style="height: 409px; overflow-y: auto; border: 3px solid #00897b; border-left: 0px">
                    <div class="row" style="background-color: #4db6ac; margin-left: -12px; margin-right: -12px; margin-top: -30px;">
                        <center>
                            <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; font-size: 2vw; margin-top: 30px;">Storage Type</h2>
                        </center>
                        <button data-target="modalNewStorageType" class="right waves-light btn-floating light-green modal-trigger tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Add Type" href="#modalNewStorageType" style="margin-top: -50px; margin-right: 15px;"><i class="material-icons" style="color: #000000;">add</i></button>
                    </div>
                    
                    

                    <table style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <center>
                                <th>Type</th>
                                <th>Quantity</th>
                                </center>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="filled-in" id="storageType@{{ storageType.intStorageTypeId }}"/>
                                    <label for="storageType@{{ storageType.intStorageTypeId }}">@{{ storageType.strStorageTypeName }}</label>
                                </td>
                                <td>
                                    <input ng-model="storageType.intQuantity"
                                        ui-number-mask="0"
                                       id="quantity"
                                        type="text"
                                        placeholder="Input Quantity"
                                        class="validate tooltipped"
                                        data-position = "bottom"
                                        data-delay = "30"
                                        data-tooltip = "Accepts whole number only. Max input: 10 *Example: 5"
                                        aria-required = "true"
                                        min = "1"
                                        max = "10">
                                </td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
            </div>
            <div class="row">
                <button name = "action" class="right waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Save</button>
            </div>
        </div>
    </div>
    @include('modals.unit-servicing.storageType')
</div>
@endsection