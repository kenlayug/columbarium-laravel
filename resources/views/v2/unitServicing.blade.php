@extends('v2.baseLayout')
@section('title', 'Unit Servicing Utility')
@section('body')

    <script type="text/javascript" src="{!! asset('/unit-service/controller.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
    <div ng-controller="ctrl.unit-service">
        <div class = col s12 >
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
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('modals.unit-servicing.configureUnitService')
            @include('modals.unit-servicing.storageType')
        </div>
    </div>
@endsection