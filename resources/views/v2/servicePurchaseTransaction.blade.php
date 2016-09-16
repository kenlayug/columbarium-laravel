@extends('v2.baseLayout')
@section('title', 'Purchase Service')
@section('body')

<script type="text/javascript" src="{!! asset('/js/servicePurchases.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/datepicker.css') !!}">
<script type="text/javascript" src="{!! asset('/service-purchase/v2/controller.js') !!}"></script>
<script src="{!! asset('/js/tooltip.js') !!}"></script>

<div class = "col s12" ng-controller='ctrl.service-purchase'>

        <button class="right waves-light btn blue modal-trigger" href="#successPackage" 
                style = "color: black; margin-right: 0px; float: right;">successP</button>

        <div class = "row">
            <div class = "col s5" style="margin-top: 20px;">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3" style="height: 500px; overflow-y: auto">
                        <div class="header" style="background-color: #00897b; margin-top: -15px;">
                            <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Purchase Service</h4></center>
                        </div>
                        <div class="col s12">
                            <input ng-change='changePreNeed()' type="checkbox" ng-model="transactionPurchase.boolPreNeed" id="future" value=1/>
                            <label for="future" style="font-family: Arial">Pre-Need</label>
                        </div>
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s2"><a class="orange-text" href="#additionals" style="font-weight: 700;">Additionals</a></li>
                                <li class="tab col s2"><a class="orange-text" href="#services" style="font-weight: 700;">Services</a></li>
                                <li class="tab col s2"><a class="orange-text" href="#packages" style="font-weight: 700;">Packages</a></li>
                            </ul>
                        </div><br><br><br>
                        <div style="background: #fafafa;">
                            <!-- Additionals -->
                            <div id="additionals" class="col s12">
                                <h5 ng-show="transactionPurchase.boolPreNeed == 1" class="center">Additionals are not available for Pre-need Transactions.</h5>
                                <table ng-hide="transactionPurchase.boolPreNeed == 1 || additionalList.length == 0" style="color: black; background-color: white; border: 2px solid white; table-layout: fixed">
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
                                            <button ng-click='openAdditionalCart(additional)' data-target="addToCartAdditionals" tooltipped class="waves-light btn light-green modal-trigger" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartAdditionals" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h5 ng-show="additionalList.length == 0" class="center">No additionals available. Create one in the maintenance first.</h5>
                            </div>

                            <!-- Services -->
                            <div id="services" class="col s12">
                                <table ng-hide="serviceList.length == 0" style="color: black; background-color: white; border: 2px solid white; table-layout: fixed">
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
                                            <button ng-click='openServiceCart(service)' data-target="addToCartServices" tooltipped class="waves-light btn light-green modal-trigger" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartServices" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h5 ng-show="serviceList.length == 0" class="center">No services available. Create one in the maintenance first.</h5>
                            </div>

                            <!-- Packages -->
                            <div id="packages" class="col s12">
                                <table ng-hide="packageList.length == 0" style="color: black; background-color: white; border: 2px solid white; table-layout: fixed">
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
                                            <button ng-click='openPackageCart(package)' data-target="addToCartPackages" tooltipped class="waves-light btn light-green modal-trigger" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartPackages" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h5 ng-show="packageList.length == 0" class="center">No packages available. Create one in the maintenance first.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class = "col s7" style="margin-top: 20px;">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3" style="height: 500px; overflow: auto">
                        <div class="header" style="background-color: #00897b; margin-top:-15px;">
                            <center><h4 style = "font-size: 20px; color: white; padding: 20px;">My Cart</h4></center>
                            <button ng-show='cartList.length != 0' ng-click='billOut()' data-target="serviceBillOut"
                                class="right waves-light btn blue modal-trigger @{{ animation }}" href="#serviceBillOut" style = "color: black; margin-right: 15px; margin-top: -65px;">Bill out</button>
                        </div>
                        <div class="row" style="margin-right: 15px; margin-left: 15px;">
                            <table ng-hide="cartList.length == 0" style="color: black; background-color: white; border: 2px solid white; table-layout: fixed;">
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
                                        <button ng-click='updateSchedule(objectCart)' ng-if='objectCart.intServiceId != null' data-target="scheduleAddCart" tooltipped class="btn-floating waves-light btn light-green modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Edit" 
                                        href="#scheduleAddCart"><i class="material-icons" style = "color: #000000;">edit</i></button>
                                        <button ng-click='updateSchedule(objectCart)' ng-if='objectCart.intPackageId != null' data-target="scheduleAddCart" tooltipped class="btn-floating waves-light btn light-green modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Edit" 
                                        href="#scheduleAddCart"><i class="material-icons" style = "color: #000000;">edit</i></button>
                                        <button ng-click='openRemoveObject(objectCart, $index)' data-target="editCart" tooltipped class="btn-floating waves-light btn light-green modal-trigger" href="#editCart" data-position="bottom" data-delay="50" data-tooltip="Remove"><i class="material-icons" style = "color: #000000;">delete</i></button>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            <h5 ng-show="cartList.length == 0" class="center">Choose from the list first.</h5>
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

        @include('modals.collection-downpayment.cheque1')
        @include('modals.manage-unit.newCustomer')
        @include('modals.service-purchases.requirements')
        @include('modals.service-purchases.addDeceased4')
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
        @include('modals.service-purchases.successPackage')
    </div>



@endsection