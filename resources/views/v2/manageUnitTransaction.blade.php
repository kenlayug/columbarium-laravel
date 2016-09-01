@extends('v2.baseLayout')
@section('title', 'Manage Unit')
@section('body')

    <link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/vaults.css') !!}">
    <script type="text/javascript" src="{!! asset('/js/manageUnit.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('/manage-unit/controller.js') !!}"></script>

    <button data-target="safeBox" class="right waves-light btn blue modal-trigger" href="#safeBox" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Safe Box</button>

    <button data-target="modal1" class="right waves-light btn blue modal-trigger" href="#modal1" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">modal1</button>

    <div ng-controller="ctrl.manage-unit">

        <div class = col s12 >
            <div class = "row">
                <div class = "col s4">
                    <h4 style = "font-family: myFirstFont2; margin-top: 20px; margin-left: 20px;">Manage Unit</h4>

                    <div style = "height: 370px;">
                        <div class = "col s12">
                            <div class = "aside aside " style="overflow: auto;">
                                <ul class="collapsible" data-collapsible="accordion" watch>
                                    <li ng-repeat="unitType in unitTypeList">
                                        <div ng-click="getBlocks(unitType, $index)"
                                             class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                            <label style = "font-family: myFirstFont2; font-size: 1.5vw; color: white;">@{{ unitType.strRoomTypeName }}</label>
                                        </div>
                                        <div ng-repeat="block in unitType.blockList"
                                             class="collapsible-body @{{ block.color }}" style = "max-height: 50px;">
                                            <p style = "padding-top: 15px;">@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}
                                                <button ng-click="getUnits(block, $index)"
                                                        id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                            </p>
                                        </div>
                                        <div ng-if="unitType.blockList.length == 0"
                                             class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                            <p style = "padding-top: 15px;">
                                                No blocks available for this unit type.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Legends -->
                    <div class = "row" style="margin-top: -80px;">
                        <div class = "col s12">
                            <div class = "aside aside z-depth-3" style = "height: 130px;">
                                <div class = "header" style = "height: 35px; background-color: #00897b">
                                    <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: myFirstFont2;">Legend:</label>
                                </div>

                                <div class = "row" style = "margin-top: 10px;">
                                    <center>
                                        <div class = "col s3">
                                            <button name = "action" class="btn-floating green darken-3"></button>
                                            <label style="font-size: 15px; color: #000000;">Available</label>
                                        </div>
                                        <div class = "col s2" style = "margin-left: -5px;">
                                            <button name = "action" class="btn-floating dark-blue darken-3"></button>
                                            <label style="margin-left: -10px; font-size: 15px; color: #000000;">Reserved</label>
                                        </div>
                                        <div class = "col s2">
                                            <button name = "action" class="btn-floating yellow darken-2"></button>
                                            <label style="font-size: 15px; color: #000000;">AtNeed</label>
                                        </div>
                                        <div class = "col s2">
                                            <button name = "action" class="btn-floating red darken-3"></button>
                                            <label style="font-size: 15px; color: #000000;">Owned</label>
                                        </div>
                                        <div class = "col s3">
                                            <button name = "action" class="btn-floating orange darken-1"></button>
                                            <label style="font-size: 15px; color: #000000;">Deactivated</label>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class = "col s8">
                    <div class = "col s4 z-depth-2 " style = "margin-top: 20px; width: 100%;">
                        <div ng-hide="showUnit" id="tableStart">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3">
                                    <div class="center vaults-content">
                                        <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px;">Select a Block</h2>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                            <tbody>
                                            <tr>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                                <td><a class="waves-light"></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div ng-show="showUnit" class="responsive" id="tableUnit">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3">
                                    <div class="center vaults-content">
                                        <h2 style = "padding-left: 40px; font-size: 30px; margin-top: 20px;">@{{ blockName }}</h2>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                            <tbody>
                                            <tr ng-repeat="unitLevel in unitList">
                                                <td ng-repeat="unit in unitLevel"
                                                    class="@{{ unit.color }}">
                                                    <a ng-click="openModal(unit)"
                                                       data-target="modal1"
                                                       href="#modal1"
                                                       class="waves-effect waves-light modal-trigger">@{{ unit.display }}</a>
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
            @include('modals.collection-downpayment.cheque1')
            @include('modals.service-purchases.newDeceasedForm')
            @include('modals.manage-unit.addTransferPullOutForm')
            @include('modals.manage-unit.newCustomer')
            @include('modals.manage-unit.retrieveDeceased')
            @include('modals.manage-unit.returnDeceased')
            @include('modals.manage-unit.safeBox')
            @include('modals.manage-unit.successAddDeceased')
            @include('modals.manage-unit.successPullOutDeceased')
            @include('modals.manage-unit.successReturnDeceased')
            @include('modals.manage-unit.successTransferDeceased')
            @include('modals.manage-unit.successTransferOwnership')
            @include('modals.service-purchases.requirements')
        </div>
    </div>
@endsection