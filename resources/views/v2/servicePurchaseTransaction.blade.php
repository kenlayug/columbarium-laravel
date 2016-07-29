@extends('v2.baseLayout')
@section('title', 'Service Purchase')
@section('body')

<script type="text/javascript" src="{!! asset('/js/servicePurchases.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/datepicker.css') !!}">
<script type="text/javascript" src="{!! asset('/service-purchase/controller.js') !!}"></script>

<div class = "col s12" >
        <div class = "row">
            <div class = "col s5" style="margin-top: 20px;">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3" style="height: 500px; overflow-y: auto">
                        <div class="header" style="background-color: #00897b; margin-top: -15px;">
                            <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Service Purchases</h4></center>
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
                                    <tr>
                                        <th>Metalic Urn</th>
                                        <th>P 400.00</th>
                                        <th>
                                            <button data-target="addToCartAdditionals" class="waves-light btn light-green modal-trigger tooltipped" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartAdditionals" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </th>
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
                                    <tr>
                                        <th>Cremation</th>
                                        <th>P 400.00</th>
                                        <th>
                                            <button data-target="addToCartServices" class="waves-light btn light-green modal-trigger tooltipped" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartServices" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Cremation</th>
                                        <th>P 400.00</th>
                                        <th>
                                            <button data-target="addToCartServices" class="waves-light btn light-green modal-trigger tooltipped" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartServices" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </th>
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
                                    <tr>
                                        <th>Bone Cremation</th>
                                        <th>P 400.00</th>
                                        <th>
                                            <button data-target="addToCartServices" class="waves-light btn light-green modal-trigger tooltipped" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartServices" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Bone Cremation</th>
                                        <th>P 400.00</th>
                                        <th>
                                            <button data-target="addToCartServices" class="waves-light btn light-green modal-trigger tooltipped" data-position="right" data-delay="50" data-tooltip="Add to Cart" href="#addToCartServices" style = "color: #000000;"><i class="material-icons">add</i><i class="material-icons">shopping_cart</i></button>
                                        </th>
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
                            <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">My Cart</h4></center>
                            <button data-target="serviceBillOut"
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
                                <tr>
                                    <td>Bone Cremation</td>
                                    <td>P 500.00</td>
                                    <td>2</td>
                                    <td>P 1,000.00</td>
                                    <td>
                                        <button data-target="editCart" class="btn-floating waves-light btn light-green modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" 
                                        href="#editCart"><i class="material-icons" style = "color: #000000;">mode_edit</i></button>
                                        <button data-target="scheduleAddCart" class="btn-floating waves-light btn light-green modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reschedule" 
                                        href="#scheduleAddCart"><i class="material-icons" style = "color: #000000;">alarm_on</i></button>
                                        <button class="btn-floating waves-light btn light-green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Remove"><i class="material-icons" style = "color: #000000;">delete</i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bone Cremation</td>
                                    <td>P 500.00</td>
                                    <td>2</td>
                                    <td>P 1,000.00</td>
                                    <td>
                                        <button data-target="editCart" class="btn-floating waves-light btn light-green modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" 
                                        href="#editCart"><i class="material-icons" style = "color: #000000;">mode_edit</i></button>
                                        <button data-target="scheduleAddCart" class="btn-floating waves-light btn light-green modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reschedule" 
                                        href="#scheduleAddCart"><i class="material-icons" style = "color: #000000;">alarm_on</i></button>
                                        <button class="btn-floating waves-light btn light-green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Remove"><i class="material-icons" style = "color: #000000;">delete</i></button>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <div class="col s12" style="border-top: 2px solid #7b7073;"><br>
                            <label style="color: #000000; font-size: 17px;">Grand Total: <span style="color: red">P 2,000.00</span></label>
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
        @include('modals.service-purchases.addToCartAdditionals')
        @include('modals.service-purchases.editToCartAdditionals')
        @include('modals.service-purchases.addToCartServices')
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