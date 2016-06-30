@extends('transaction')
@section('title', 'Buy Unit')
@section('body')

{{--<link rel="stylesheet" type="text/css" href="{!! asset('/css/vaults-trans.css') !!}">--}}
<script src="{!! asset('/buy-unit/controller.js') !!}"></script>
<div ng-controller="ctrl.buy-unit">
<div class = "col s12" >
    <div class = "row">
        <div class = "responsive">

            <div class = "col s4">
                <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont">Buy Units</h2>

                <div style = "overflow: auto;height: 370px;">
                    <div class = "col s12">
                        <div class = "aside aside ">
                            <ul class="collapsible" data-collapsible="accordion" watch>
                                <li>
                                    <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                        <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">Columbary</label>
                                    </div>
                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                        <p style = "padding-top: 15px;">BA-1-St. Peter-1
                                            <button
                                                    data-tooltip="Full Body Crypts"
                                                    data-delay="50"
                                                    data-position="bottom"
                                                    name = "action" class="modal-trigger btn-floating light-green right tooltipped" style = "margin-top: -5px; margin-right: 5px;"><i class="material-icons" style = "color: black;">visibility</i></button>
                                        </p>
                                    </div>

                                </li>
                                <li>
                                    <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                        <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">Full Body</label>
                                    </div>
                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                        <p style = "padding-top: 15px;">BA-1-St. Peter-2
                                            <button
                                                    data-tooltip="Full Body Crypts"
                                                    data-delay="50"
                                                    data-position="bottom"
                                                    name = "action" class="modal-trigger btn-floating light-green right tooltipped" style = "margin-top: -5px; margin-right: 5px;"><i class="material-icons" style = "color: black;">visibility</i></button>
                                        </p>
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
                    <div id="tableStart">
                        <div class = "col s12">
                            <div class = "aside aside z-depth-3">
                                <div class="center vaults-content">
                                   <h4>Choose Block first.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "col s12">
                        <div class = "col s12" style = "margin-top: 20px; width: 100%;">
                            <div class="responsive">
                                <div class = "col s12">
                                    <div class = "aside aside z-depth-3" style = "height: 400px;">
                                        <div class="center vaults-content" style = "height: 400px;">
                                            <h5><i class="medium material-icons"></i></h5><span style="color: orange;"></span>
                                            <table id="tableUnits" style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                                <tbody>
                                                <tr>
                                                    <td style="background-color: #00897b; border: 2px solid white;" >
                                                        <a
                                                           class="waves-effect waves-light" style = "color: white; font-size: 20px; font-family: myfirstfont;"></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <a class="waves-effect waves-light btn">Done</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Form for Manage Service -->
                    <div id="modalUnit" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important">
                        <center>
                            <div class="modal-header">
                                <label style="font-size: large">UNIT DETAILS</label>
                            </div>

                            <div id='viewDetails' class="modal-content" style="background-color: #f3f3f3;">
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
                                        <label ng-show="unit.strLastName != null"><u>@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</u></label>
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
                                                <label><u>@{{ unit.unitPrice.deciPrice | currency:"₱" }}</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Years:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label ng-show="unit.interest != null"><u>@{{ unit.interest.intNoOfYear }} year/s</u></label>
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
                                                <label><u>Unit No. @{{ unit.intUnitId }}</u></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button ng-click="addToCart(unit)" ng-show="unit.intUnitStatus == 1" name = "action" class="waves-light btn light-green" style = "color: #000000;"><i class="material-icons">shopping_cart</i>Add to Cart</button>
                                <button ng-show="unit.intUnitStatus == 2" name = "action" class="waves-light btn light-green modal-close" style = "color: #000000; margin-left: 10px; margin-right: 10px"><i class="material-icons">not_interested</i>Cancel Reservation</button>
                            </div>
                        </center>
                    </div>
                </div>

                {{--<div class="col s12" style="margin-top: 50px" ng-show="reservationCart.length != 0">--}}
                    {{--<div class="card material-table">--}}
                        {{--<div class="table-header" style="background-color: #00897b;">--}}
                            {{--<h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2;">Unit Details</h4>--}}
                            {{--<div class="actions">--}}
                                {{--<button ng-click="billOut()"--}}
                                        {{--data-target="modalBillOut"--}}
                                        {{--class="modal-trigger waves-light btn">Bill Out</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<table id="datatable" style="color: black; background-color: white; border: 2px solid white;">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Unit Code</th>--}}
                                {{--<th>Unit Type</th>--}}
                                {{--<th>Price</th>--}}
                                {{--<th>Action</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--<tr ng-repeat="cartDetail in reservationCart">--}}
                                {{--<td>Unit No. @{{ cartDetail.intUnitId }}</td>--}}
                                {{--<td>@{{ cartDetail.strUnitType }}</td>--}}
                                {{--<td>@{{ cartDetail.unitPrice.deciPrice | currency: "₱" }}</td>--}}
                                {{--<td><a ng-click="removeToCart(unit.intUnitId, $index)" class="waves-light btn light-green " style="width: 70%; color: #000000">REMOVE</a></td>--}}
                            {{--</tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="row">
                    <div class="offset-s10 col s5">
                        <br><br>
                        <button ng-click="billOut()"
                                ng-show="reservationCart.length != 0"
                                data-target="modalBillOut"
                                class="btn modal-trigger">BILL OUT</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

    @include('modals.buy-unit.billOut')

    </div>
@endsection