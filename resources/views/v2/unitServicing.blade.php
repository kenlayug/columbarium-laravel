@extends('v2.baseLayout')
@section('title', 'Unit Servicing Utility')
@section('body')

<script type="text/javascript" src="{!! asset('/unit-service/controller.js') !!}"></script>
<script src="{!! asset('/js/tooltip.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/unitServicing.css') !!}">

<script type="text/javascript">
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
    });
</script>

<div ng-controller="ctrl.unit-service">

    <div class="row" style="max-height: 465px;">
    
        <div class="col s4" style="overflow-y: auto;">
            <div class="row" style = "height: 60px; background-color: #00897b;">
                <center>
                    <h2 style = "padding-top: 15px; color: white; font-size: 2vw; margin-top: 20px;">Unit Servicing</h2>
                </center>
            </div>
            <div class = "row">
                <ul>
                    <li ng-repeat='unitType in unitTypeList'>
                        <div style = "height: 55px; width: 400px; background-color: #00897b; border: 2px solid #00c6b1; margin-left: 4%;"><i class="material-icons" style = "font-size: 35px; margin-top: 8px; margin-left: 8px;">business</i>
                            <h6 style = "font-size: 1.5vw; color: white; padding-left: 80px;margin-top: -30px;">@{{ unitType.strUnitTypeName }}</h6>
                            <button ng-click='updateServiceUtility(unitType, $index)' data-target="#" tooltipped class="right waves-light btn @{{ unitType.color }} dal-trigger" 
                                data-position = "right" data-delay = "30" data-tooltip = "Configure"
                                href="#" style = "color: #000000; margin-right: 10px; margin-top: -35px;"><i class="material-icons">settings</i>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col s8">
            <form ng-submit='saveUnitSettings()' autocomplete="off">
                <div ng-show='selectedUnitType != null' id="mouseScroll1" class="z-depth-3" style="margin-top: 20px; padding:0; margin-left: -21px; max-height: 550px;">
                    <div class="row" style="background-color: #4db6ac; height: 60px; ">
                        <center>
                            <h5 style = "padding-top: 15px; padding-bottom: 10px; color: #ffffff; margin-top: 0px;">Configure: @{{ selectedUnitType.strUnitTypeName }}</h5>
                        </center>
                    </div>

                    <!-- Storage Type -->
                    <div class="row" style="margin-left: 20px; margin-right: 20px;">
                        <div class="col s4 offset-s4">
                            <center>
                                <h4 style = "padding-top: 10px; color: #000000; padding-top: 10px; padding-bottom: 10px;">Storage Type</h4>
                                <a data-target="modalNewStorageType" 
                                tooltipped class="waves-light btn-floating light-green modal-trigger" 
                                data-position = "right" data-delay = "30" data-tooltip = "Add Type" 
                                href="#modalNewStorageType" 
                                style="margin-top: -65px; margin-left: 260px;"><i class="material-icons" style="color: #000000;">add</i></a>
                            </center>
                        </div><br><br><br>
                        <table style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Quantity*</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat='storageType in storageTypeList'>
                                    <td>
                                        <input ng-click='setValue(storageType)' ng-model='storageType.selected' type="checkbox" class="filled-in" id="storageType@{{ storageType.intStorageTypeId }}" value=1/>
                                        <label for="storageType@{{ storageType.intStorageTypeId }}">@{{ storageType.strStorageTypeName }}</label>
                                    </td>
                                    <td>
                                        <input ng-model="storageType.intQuantity"
                                            ui-number-mask="0"
                                            ng-disabled='storageType.selected != 1'
                                            id="quantity"
                                            type="text"
                                            placeholder="Input Quantity"
                                            tooltipped class="validate"
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

                    <!-- Assign Service -->
                    <div class="row" style="border-top: 2px solid #4db6ac;"><br><br>
                    <div class="col s4 offset-s4">
                        <center>
                            <h4 style = "padding-top: 10px; color: #000000; padding-top: 10px; padding-bottom: 10px;">Assign Service</h4>
                        </center>
                    </div><br><br><br>
                    <div class="row">
                        <div class="col s6">
                            <label style="font-size: 20px;">Add Deceased:</label>
                        </div>
                        <div class="col s6">
                            <select ng-model="add.intServiceIdFK"
                                    material-select watch>
                                <option value="" disabled selected>Select Service*</option>
                                <option ng-repeat="service in serviceList"
                                        value="@{{ service.intServiceId }}">@{{ service.strServiceName }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label style="font-size: 20px;">Transfer Deceased:</label>
                        </div>
                        <div class="col s6">
                            <select ng-model="transfer.intServiceIdFK"
                                    material-select watch>
                                <option value="" disabled selected>Select Service*</option>
                                <option ng-repeat="service in serviceList"
                                        value="@{{ service.intServiceId }}">@{{ service.strServiceName }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label style="font-size: 20px;">Pull Out Deceased:</label>
                        </div>
                        <div class="col s6">
                            <select ng-model="pull.intServiceIdFK"
                                    material-select watch>
                                <option value="" disabled selected>Select Service*</option>
                                <option ng-repeat="service in serviceList"
                                        value="@{{ service.intServiceId }}">@{{ service.strServiceName }}</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="row"><i class = "left" style = "color: red; margin-left: 10px;">*Required Fields</i></div>
                    <div class="row">
                        <button name = "action" class="right waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('modals.unit-servicing.storageType')
</div>
@endsection