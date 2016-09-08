@extends('v2.baseLayout')
@section('title', 'Collections')
@section('body')

<script type="text/javascript" src="{!! asset('/js/collection.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/collection/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/collections.css') !!}">

<div ng-controller="ctrl.collection">
    <div class = "col s12">
    <br>
        <div class = "row">
            <!-- Collection Data Table-->
            <div class = "col s8">
                <div class="row">
                    <div class="col s12">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Collections</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable-main" datatable="ng">
                                <thead>
                                <tr>
                                    <th style="width: 30%">Customer Name</th>
                                    <th style="width: 20%">Downpayment</th>
                                    <th style="width: 20%">Regular Collections</th>
                                    <th style="width: 20%">Pre Need</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="customer in collectionCustomerList">
                                    <td>@{{ customer.strFullName }}</td>
                                    <td></td>
                                    <td>P 67,000.00</td>
                                    <td>P 1, 200.00</td>
                                    <td><button ng-click="getCollections(customer, $index)"
                                                data-target="collection" class="waves-light btn light-green modal-trigger tooltipped" data-position="bottom" data-delay="30" data-tooltip="View Collections" style = "color: #000000; padding-left: 10px; padding-right: 10px; margin-left: 5px; margin-right: 10px">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class = "col s4">
                <div class="row">
                    <div class="col s12">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Past Due Accounts</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable-mainLog" style="table-layout: fixed;">
                                <thead>
                                <tr>
                                    <th style="width: 20%">Due Date</th>
                                    <th style="width: 60%">Customer Name</th>
                                    
                                    
                                    <th style="width: 20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>09/12/12</td>
                                    <td>Chenemer, Chenenen</td>
                                    
                                    <td><button class="waves-light btn light-green modal-trigger tooltipped" data-target="pastDueSMS" data-position="bottom" data-delay="30" data-tooltip="Past Due Details" style = "color: #000000; padding-left: 5px; padding-right: 10px; margin-left: 5px; margin-right: 10px;">View</button></td>
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
    @include('modals.collection-downpayment.payCollection4')
    @include('modals.collection-downpayment.payDownpayment1')
    @include('modals.collection-downpayment.pastDueSMS')
    @include('modals.collection-downpayment.success1')
    @include('modals.collection-downpayment.successDownpayment3')
    @include('modals.collection-downpayment.collectionPayment1')

</div>
@endsection