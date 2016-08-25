@extends('v2.baseLayout')
@section('title', 'Collections')
@section('body')

<script type="text/javascript" src="{!! asset('/js/collection.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/collection/controller.js') !!}"></script>

<div ng-controller="ctrl.collection">

    <h4 style="font-family: myFirstFont2; padding-left: 20px; padding-top: 10px;">Collections</h4>
    <div class = "col s12" >
        <div class = "row">
            <!-- Collection Data Table -->
            <div class = "col s6">
                <div class="row">
                    <div  class="col s12">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Downpayment</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable" datatable="ng">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="customer in downpaymentCustomerList">
                                    <td>@{{ customer.strFullName }}</td>
                                    <td><button ng-click="getDownpayments(customer.intCustomerId, customer.strFullName, $index)"
                                                data-target="downpayment" class="waves-light btn light-green modal-trigger" href="#downpayment" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Collection Data Table-->
            <div class = "col s6">
                <div class="row">
                    <div class="col s12">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Regular Collections</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable3" datatable="ng">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="customer in collectionCustomerList">
                                    <td>@{{ customer.strFullName }}</td>
                                    <td><button ng-click="getCollections(customer, $index)"
                                                data-target="collection" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.collection-downpayment.cheque1')
    @include('modals.collection-downpayment.collectionList1')
    @include('modals.collection-downpayment.downpaymentList3')
    @include('modals.collection-downpayment.payCollection4')
    @include('modals.collection-downpayment.payDownpayment1')
    @include('modals.collection-downpayment.success1')
    @include('modals.collection-downpayment.successDownpayment3')
    @include('modals.collection-downpayment.collectionPayment1')

</div>
@endsection