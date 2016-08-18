@extends('v2.baseLayout')
@section('title', 'Service Purchase')
@section('body')

<script type="text/javascript" src="{!! asset('/js/servicePurchases.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/datepicker.css') !!}">
<script type="text/javascript" src="{!! asset('/service-purchase/v2/controller.js') !!}"></script>

<div class = "col s12" ng-controller='ctrl.service-purchase'>
        <div class = "row">
            <div class = "col s5" style="margin-top: 20px;">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3" style="height: 500px; overflow-y: auto">
                        <div class="header" style="background-color: #00897b; margin-top: -15px;">
                            <center><h4 style = "font-size: 20px; font-family: myFirstFont2; color: white; padding: 20px;">Service Purchases</h4></center>
                        </div>
                        <div class="col s12">
                            <input ng-change='changePreNeed()' type="checkbox" ng-model="transactionPurchase.boolPreNeed" id="future" value=1/>
                            <label for="future" style="font-family: Arial">Pre-Need</label>
                        </div>
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s2"><a class="orange-text" href="#additionals">Additionals</a></li>
                                <li class="tab col s2"><a class="orange-text" href="#services">Services</a></li>
                                <li class="tab col s2"><a class="orange-text" href="#packages">Packages</a></li>
                            </ul>
                        </div><br><br><br>
                        <div style="background: #fafafa;">
                            <!-- Additionals -->
                            <div id="additionals" class="col s12">
                                <table style="color: black; background-color: white; border: 2px solid white; table-layout: fixed">
                                    <thead>
                                    <tr>
                                        <center>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </center>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat='additional in additionalList'>
                                        <td>@{{ additional.strAdditionalName }}</td>
                                        <td>@{{ additional.price.deciPrice | currency : 'P' }}</td>
                                        <td>
                                            <button ng-click='openAdditionalCart(additional)' data-target="addToCartAdditionals" class="waves-light btn light-green modal-trigger tooltipped" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartAdditionals" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Services -->
                            <div id="services" class="col s12">
                                <table style="color: black; background-color: white; border: 2px solid white; table-layout: fixed">
                                    <thead>
                                    <tr>
                                        <center>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </center>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat='service in serviceList'>
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency : 'P' }}</td>
                                        <td>
                                            <button ng-click='openServiceCart(service)' data-target="addToCartServices" class="waves-light btn light-green modal-trigger tooltipped" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartServices" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Packages -->
                            <div id="packages" class="col s12">
                                <table style="color: black; background-color: white; border: 2px solid white; table-layout: fixed">
                                    <thead>
                                    <tr>
                                        <center>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </center>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat='package in packageList'>
                                        <td>@{{ package.strPackageName }}</td>
                                        <td>@{{ package.price.deciPrice | currency : 'P' }}</td>
                                        <td>
                                            <button ng-click='openPackageCart(package)' data-target="addToCartPackages" class="waves-light btn light-green modal-trigger tooltipped" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartPackages" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class = "col s7" style="margin-top: 20px;">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3" style="height: 500px; overflow: auto">
                        <div class="header" style="background-color: #00897b; margin-top:-15px;">
                            <center><h4 style = "font-size: 20px; font-family: myFirstFont2; color: white; padding: 20px;">My Cart</h4></center>
                            <button ng-show='cartList.length != 0' ng-click='billOut()' data-target="serviceBillOut"
                                class="right waves-light btn blue modal-trigger @{{ animation }}" href="#serviceBillOut" style = "color: black; margin-right: 15px; margin-top: -65px;">Bill out</button>
                        </div>
                        <div class="row" style="margin-right: 15px; margin-left: 15px;">
                            <table style="color: black; background-color: white; border: 2px solid white; table-layout: fixed;">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat='objectCart in cartList'>
                                    <td>
                                        <label ng-if='objectCart.intAdditionalId != null'>@{{ objectCart.strAdditionalName }}</label>
                                        <label ng-if='objectCart.intServiceId != null'>@{{ objectCart.strServiceName }}</label>
                                        <label ng-if='objectCart.intPackageId != null'>@{{ objectCart.strPackageName }}</label>
                                    </td>
                                    <td>
                                        <label>@{{ objectCart.deciPrice | currency : 'P' }}</label>
                                    </td>
                                    <td>
                                        <label>@{{ objectCart.intQuantity }}</label>
                                    </td>
                                    <td>
                                        <label>@{{ objectCart.deciPrice * objectCart.intQuantity | currency : 'P' }}</label>
                                    </td>
                                    <td>
                                        <button ng-click='updateSchedule(objectCart)' ng-if='objectCart.intServiceId != null' data-target="scheduleAddCart" class="btn-floating waves-light btn light-green modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" 
                                        href="#scheduleAddCart"><i class="material-icons" style = "color: #000000;">edit</i></button>
                                        <button ng-click='updateSchedule(objectCart)' ng-if='objectCart.intPackageId != null' data-target="scheduleAddCart" class="btn-floating waves-light btn light-green modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" 
                                        href="#scheduleAddCart"><i class="material-icons" style = "color: #000000;">edit</i></button>
                                        <button ng-click='openRemoveObject(objectCart, $index)' data-target="editCart" class="btn-floating waves-light btn light-green modal-trigger tooltipped" href="#editCart" data-position="bottom" data-delay="50" data-tooltip="Remove"><i class="material-icons" style = "color: #000000;">delete</i></button>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <div class="col s12" style="border-top: 2px solid #7b7073;"><br>
                            <label style="color: #000000; font-size: 17px;">Grand Total: 
                                <span style="color: red" ng-show='transactionPurchase.deciTotalAmountToPay != null'>@{{ transactionPurchase.deciTotalAmountToPay | currency: 'P' }}</span>
                                <span style="color: red" ng-hide='transactionPurchase.deciTotalAmountToPay != null'>@{{ 0 | currency: 'P' }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            .tabs .indicator {
                 background-color: #00897b;
            }
        </style>

        @include('modals.collection-downpayment.cheque')
        @include('modals.manage-unit.newCustomer')
        @include('modals.service-purchases.requirements')
        @include('modals.service-purchases.unitForm')
        @include('modals.service-purchases.deceasedForm')
        @include('modals.service-purchases.newDeceasedForm')
        @include('modals.service-purchases.addToCartAdditionals')
        @include('modals.service-purchases.editToCartAdditionals')
        @include('modals.service-purchases.addToCartServices')
        @include('modals.service-purchases.addToCartPackages')
        @include('modals.service-purchases.scheduleAddCart')
        @include('modals.service-purchases.serviceBillOut')
        @include('modals.service-purchases.scheduleService')
        @include('modals.service-purchases.packageList')
        @include('modals.service-purchases.serviceList')
        @include('modals.service-purchases.additionalsList')
        @include('modals.service-purchases.successPackage')
        @include('modals.service-purchases.successService')
        @include('modals.service-purchases.successAdditionals')
    </div>



@endsection