@extends('v2.baseLayout')
@section('title', 'Collection and Downpayment')
@section('body')

<script type="text/javascript" src="{!! asset('/js/collection.js') !!}"></script>
    <h4 style="font-family: myFirstFont2; padding-left: 20px; padding-top: 10px;">Collection and Downpayment</h4>

    <div class = "col s12" >
        <div class = "row">
            <!-- Collection Data Table -->
            <div class = "col s6">
                <div class="row">
                    <div  class="col s12">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont">Customer Downpayment</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aaron Clyde Garil</td>
                                    <td><button data-target="downpayment" class="waves-light btn light-green modal-trigger" href="#downpayment" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>John Ezekiel Martinez</td>
                                    <td><button data-target="downpayment" class="waves-light btn light-green modal-trigger" href="#downpayment" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Aila Bianca Jacalne</td>
                                    <td><button data-target="downpayment" class="waves-light btn light-green modal-trigger" href="#downpayment" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Tiffany Banzuela</td>
                                    <td><button data-target="downpayment" class="waves-light btn light-green modal-trigger" href="#downpayment" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Alvin John Perez</td>
                                    <td><button data-target="downpayment" class="waves-light btn light-green modal-trigger" href="#downpayment" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
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
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont">Customer Collection</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable3">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aaron Clyde Garil</td>
                                    <td><button data-target="collection" class="waves-light btn light-green modal-trigger" href="#collection" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>John Ezekiel Martinez</td>
                                    <td><button data-target="collection" class="waves-light btn light-green modal-trigger" href="#collection" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Aila Bianca Jacalne</td>
                                    <td><button data-target="collection" class="waves-light btn light-green modal-trigger" href="#collection" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Tiffany Banzuela</td>
                                    <td><button data-target="collection" class="waves-light btn light-green modal-trigger" href="#collection" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Alvin John Perez</td>
                                    <td><button data-target="collection" class="waves-light btn light-green modal-trigger" href="#collection" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('modals.collection-downpayment.cheque')
        @include('modals.collection-downpayment.collectionList')
        @include('modals.collection-downpayment.downpaymentList')
        @include('modals.collection-downpayment.payCollection')
        @include('modals.collection-downpayment.payDownpayment')
    </div>

@endsection