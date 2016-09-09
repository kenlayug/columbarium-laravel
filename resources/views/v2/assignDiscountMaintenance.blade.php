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
                                        <button name = "action" class="btn tooltipped btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "Add Discount" href = "#modalAssignDiscount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button name = "action" class="btn tooltipped btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "View Discount" href = "#modalViewDiscount"><i class="material-icons" style = "color: black;">visibility</i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Spotcash Downpayment</td>
                                    <td></td>
                                    <td>
                                        <button name = "action" class="btn tooltipped btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "Add Discount" href = "#modalAssignDiscount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button name = "action" class="btn tooltipped btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "View Discount" href = "#modalViewDiscount"><i class="material-icons" style = "color: black;">visibility</i></button>
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
                                        <button name = "action" class="btn tooltipped btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "Add Discount" href = "#modalAssignDiscount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button name = "action" class="btn tooltipped btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "View Discount" href = "#modalViewDiscount"><i class="material-icons" style = "color: black;">visibility</i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cremation</td>
                                    <td>P 3,000.00</td>
                                    <td></td>
                                    <td>
                                        <button name = "action" class="btn tooltipped btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "Add Discount" href = "#modalAssignDiscount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button name = "action" class="btn tooltipped btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "View Discount" href = "#modalViewDiscount"><i class="material-icons" style = "color: black;">visibility</i></button>
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

    <!-- Modal Assign Discount -->
    <form id="modalAssignDiscount" class="modal modal-fixed-footer" style = "width: 50%; height: 320px; overflow-y: hidden">
        <div class = "modal-header" style = "height: 55px; background-color: #00897b;">
            <h4 class = "center" style = "font-size: xx-large; color: white; font-family: roboto3; padding-top: 10px;">Assign Discount</h4>
            <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
               style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
            </a>
        </div>
        <div class="modal-content" style = "height: 220px; overflow-y: auto;">
            <p style = "margin-top: -10px;">
                <input type="checkbox" class="filled-in" id="filled-in-box one"/>
                <label for="filled-in-box one">Senior's Discount</label>
            </p>
            <p>
                <input type="checkbox" class="filled-in" id="filled-in-box two"/>
                <label for="filled-in-box two">PWD Discount</label>
            </p>
            <p>
                <input type="checkbox" class="filled-in" id="filled-in-box three"/>
                <label for="filled-in-box three">Student Discount</label>
            </p>
            <p>
                <input type="checkbox" class="filled-in" id="filled-in-box four"/>
                <label for="filled-in-box four">Holiday Discount</label>
            </p>
            <p>
                <input type="checkbox" class="filled-in" id="filled-in-box five"/>
                <label for="filled-in-box five">Employee Discount</label>
            </p>
            <p>
                <input type="checkbox" class="filled-in" id="filled-in-box twelve"/>
                <label for="filled-in-box twelve">Employee Discount</label>
            </p>
        </div>
        <div class="modal-footer">
            <button name = "action" class="btn light-green" style = "color: black; margin-right: 20px;">Confirm</button>
            <a name = "action" class="btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
        </div>
    </form>

    <!-- Modal View Discount -->
    <form id="modalViewDiscount" class="modal modal-fixed-footer" style = "width: 60%; height: 400px; overflow-y: hidden">
        <div class = "modal-header" style = "height: 55px; background-color: #00897b;">
            <h4 class = "center" style = "font-size: xx-large; color: white; font-family: roboto3; padding-top: 10px;">View Discount</h4>
            <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
               style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
            </a>
        </div>
        <div class="modal-content">
            <!-- Discount Data Grid -->
            <div class = "dataGrid col s12 m6 l6" style = "margin-top: -10px;">
                <div class="row">
                    <div id="admin">
                        <div class="z-depth-2 card material-table">
                            <table id="datatableViewDiscount">
                                <thead>
                                <tr>
                                    <th>
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box six"/>
                                            <label for="filled-in-box six"></label>
                                        </p>
                                    </th>
                                    <th>Name</th>
                                    <th>Rate</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box seven" />
                                            <label for="filled-in-box seven"></label>
                                        </p>
                                    </td>
                                    <td>Discount One</td>
                                    <td>3.00%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box eight"/>
                                            <label for="filled-in-box eight"></label>
                                        </p>
                                    </td>
                                    <td>Discount Two</td>
                                    <td>10.00%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box nine"/>
                                            <label for="filled-in-box nine"></label>
                                        </p>
                                    </td>
                                    <td>Discount Two</td>
                                    <td>10.00%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box ten"/>
                                            <label for="filled-in-box ten"></label>
                                        </p>
                                    </td>
                                    <td>Discount Two</td>
                                    <td>10.00%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box eleven"/>
                                            <label for="filled-in-box eleven"></label>
                                        </p>
                                    </td>
                                    <td>Discount Two</td>
                                    <td>10.00%</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="btn light-green" style = "color: black; margin-right: 20px;">Confirm</button>
            <a name = "action" class="btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
        </div>
    </form>

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