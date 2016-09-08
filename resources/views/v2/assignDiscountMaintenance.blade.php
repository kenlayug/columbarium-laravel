@extends('v2.baseLayout')
@section('title', 'Assign Discount Maintenance')
@section('body')
    <!-- Import CSS/JS -->
    <script type="text/javascript" src="{!! asset('/additional/js/additionalController.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>

    <!-- Section -->
    <div class = "container">
        <br>
        <div style = "margin-left: -10px; width: 560px; height: 50px; background-color: #4db6ac;">
            <h5 class = "center flow-text" style = "padding-top: 10px; color: white; font-family: roboto3; margin-top: 10px;">Assign Discount Maintenance</h5>
        </div>
        <div class = "row" style = "margin-top: -10px;">
        <br>
            <!-- Transactions Data Grid -->
            <div class = "dataGrid col s12 m6 l5" style = "margin-right: 35px;">
                <div class="row">
                    <div id="admin">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style = "background-color: teal; height: 55px;">
                                <h4 class = "flow-text" style = "color: white; font-family: roboto3">Transactions Record</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Spotcash Unit Purchase</td>
                                    <td></td>
                                    <td>
                                        <button name = "action" class="btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Add Discount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button name = "action" class="btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "View Discount"><i class="material-icons" style = "color: black;">visibility</i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Spotcash Downpayment</td>
                                    <td></td>
                                    <td>
                                        <button name = "action" class="btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Add Discount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button name = "action" class="btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "View Discount"><i class="material-icons" style = "color: black;">visibility</i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Services Data Grid -->
            <div class = "dataGrid col s12 m6 l6">
                <div class="row">
                    <div id="admin">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style = "background-color: teal; height: 55px;">
                                <h4 class = "flow-text" style = "color: white; font-family: roboto3">Services Record</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable3">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cremation</td>
                                    <td>P 3,000.00</td>
                                    <td></td>
                                    <td>
                                        <button name = "action" class="btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Add Discount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button name = "action" class="btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "View Discount"><i class="material-icons" style = "color: black;">visibility</i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cremation</td>
                                    <td>P 3,000.00</td>
                                    <td></td>
                                    <td>
                                        <button name = "action" class="btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Add Discount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button name = "action" class="btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "View Discount"><i class="material-icons" style = "color: black;">visibility</i></button>
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

    <script type="text/javascript">

        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal({dismissible: false});
        });

        $(window).resize(function() {
            if ($(this).width() < 1026) {
                $('#fadeShow').hide();
            } else {
                $('#fadeShow').show();
            }
        });
        $(window).resize(function() {
            if ($(this).width() > 1026) {
                $('#modalCreateBtn').hide();
            } else {
                $('#modalCreateBtn').show();
            }
        });
    </script>
@endsection