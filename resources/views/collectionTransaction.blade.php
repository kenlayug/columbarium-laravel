@extends('maintenanceLayout')
@section('body')
<div class = "col s12" >
    <div class = "row">

        <!-- Customer Overdue Dates Data Table -->
        <div class = "col s5" style="margin-top: 12px;">
            <div class="row">
                <div id="admin1" class="col s12">
                    <div class="z-depth-2 card material-table">
                        <div class="table-header" style="background-color: #00897b;">
                            <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Customer with Overdue Dates</h4>
                            <div class="actions">
                                <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                            </div>
                        </div>
                        <table id="datatable2">
                            <thead>
                            <tr>
                                <th>Unit Code</th>
                                <th>Customer Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>A1</td>
                                <td>Aaron Clyde Garil</td>
                            </tr>
                            <tr>
                                <td>H12</td>
                                <td>John Ezekiel Martinez</td>
                            </tr>
                            <tr>
                                <td>C6</td>
                                <td>Aila Bianca Jacalne</td>
                            </tr>
                            <tr>
                                <td>B9</td>
                                <td>Tiffany Banzuela</td>
                            </tr>
                            <tr>
                                <td>C13</td>
                                <td>Alvin John Perez</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Collection history data table Modal-->
        <div id="modal1" class="modal modal-fixed">
            <div class="cmxform" action="Collection_Transaction.html" method="get" autocomplete="off">
                <div class="row">
                    <div id="admin2" class="col s12" style="margin: 0;">
                        <div class="card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Customer Collection History</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable3">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>C001</th>
                                    <th>01/03/16</th>
                                    <th>5,000</th>
                                    <th>49,0000</th>
                                </tr>
                                <tr>
                                    <th>C011</th>
                                    <th>01/21/16</th>
                                    <th>10,000</th>
                                    <th>39,000</th>
                                </tr>
                                <tr>
                                    <th>C043</th>
                                    <th>01/29/16</th>
                                    <th>4,000</th>
                                    <th>35,000</th>
                                </tr>
                                <tr>
                                    <th>C062</th>
                                    <th>02/08/16</th>
                                    <th>7,000</th>
                                    <th>32,000</th>
                                </tr>
                                <tr>
                                    <th>C072</th>
                                    <th>02/18/16</th>
                                    <th>8,500</th>
                                    <th>31,500</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Collection of Payment Modal-->
        <div id="modal2" class="modal modal-fixed" style="">
            <div class="modal-header">
                <center>
                    <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont2">Collection</h4>
                </center>
            </div>
            <div class="cmxform" id="collect" action="Collection_Transaction.html" method="get" autocomplete="off">

                <!-- Collection Form -->
                <div id="payment">
                    <form>
                        <!-- Collection Info -->
                        <div class="row" style="text-align: left;">
                            <div class = "col s9" style = "padding-left: 20px; margin-top: 10px; text-align: left">
                                <div class="card material-table">
                                    <table id="datatable4">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Principal</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>01/03/16</th>
                                            <th>P82,000</th>
                                            <th>P4,000</th>
                                            <th><i class="material-icons">done</i></th>
                                            <th><button name = "action" class="waves-light btn light-green" disabled>Pay</button></th>
                                        </tr>
                                        <tr>
                                            <th>01/04/16</th>
                                            <th>P78,000</th>
                                            <th>P4,000</th>
                                            <th><i class="material-icons">done</i></th>
                                            <th><button name = "action" class="waves-light btn light-green" disabled>Pay</button></th>
                                        </tr>
                                        <tr>
                                            <th>01/05/16</th>
                                            <th>P74,000</th>
                                            <th>P4,000</th>
                                            <th><i class="material-icons">done</i></th>
                                            <th><button name = "action" class="waves-light btn light-green" disabled>Pay</button></th>
                                        </tr>
                                        <tr>
                                            <th>01/06/16</th>
                                            <th>P70,000</th>
                                            <th>P4,000</th>
                                            <th><i class="material-icons">done</i></th>
                                            <th><button name = "action" class="waves-light btn light-green" disabled>Pay</button></th>
                                        </tr>
                                        <tr>
                                            <th>01/07/16</th>
                                            <th>P66,000</th>
                                            <th>P4,000</th>
                                            <th><i class="material-icons">done</i></th>
                                            <th><button name = "action" class="waves-light btn light-green" disabled>Pay</button></th>
                                        </tr>
                                        <tr>
                                            <th>01/08/16</th>
                                            <th>P62,000</th>
                                            <th>P4,000</th>
                                            <th><i class="material-icons">error</i></th>
                                            <th><button name = "action" class="waves-light btn light-green">Pay</button></th>
                                        </tr>
                                        <tr>
                                            <th>01/09/16</th>
                                            <th>P58,000</th>
                                            <th>P4,000</th>
                                            <th><i class="material-icons">error</i></th>
                                            <th><button name = "action" class="waves-light btn light-green">Pay</button></th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <i class = "left" style="margin-left: 10px; font-size: medium">Balance: <span style = " color: red;">P 54,000</span></i>
                            </div>
                            <div class="col s3">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select required>
                                            <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" ng-controller="myCtrl">
                                    <div class="input-field col s4">
                                        <label for="amount" data-error = "Invalid Format!">Amount:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <span class="input-peso left">
                                            <label for="amountPay"><u> P8,000</u></label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Collection -->

                        <div class="right row" style="margin-top: -100px;">
                            <div class="input-field col s12">
                                <br>
                                <button name = "action" class="waves-light btn light-green" style = "margin-left: 10px; margin-right: 10px; color: #000000; margin-top: 10px;">Submit</button>
                                <button name = "action" class="wav  es-light btn light-green modal-close" style = "color: #000000; margin-top: 10px;">Cancel</button>
                            </div>
                        </div>
                        <i class = "left" style = "margin-top: -110px; margin-bottom: 50px; padding-left: 580px; color: red;">*Required Fields</i>
                    </form>
                </div>
            </div>
        </div>


        <!-- Collection Data Table -->
        <div class = "col s7" style="margin-top: 13px;">
            <div class="row">
                <div id="admin" class="col s12">
                    <div class="z-depth-2 card material-table">
                        <div class="table-header" style="background-color: #00897b;">
                            <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Collection</h4>
                            <div class="actions">
                                <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                            </div>
                        </div>
                        <table id="datatable">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Customer Name</th>
                                <th>Unit Code</th>
                                <th>History</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>C001</td>
                                <td>Aaron Clyde Garil</td>
                                <td>A1</td>
                                <td><button data-target="modal1" class="waves-light btn light-green modal-trigger" href="#modal1" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                <td><button data-target="modal2" class="waves-light btn light-green modal-trigger" href="#modal2" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                            </tr>
                            <tr>
                                <td>C002</td>
                                <td>John Ezekiel Martinez</td>
                                <td>H12</td>
                                <td><button data-target="modal1" class="waves-light btn light-green modal-trigger" href="#modal1" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                <td><button data-target="modal2" class="waves-light btn light-green modal-trigger" href="#modal2" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                            </tr>
                            <tr>
                                <td>C003</td>
                                <td>Aila Bianca Jacalne</td>
                                <td>C6</td>
                                <td><button data-target="modal1" class="waves-light btn light-green modal-trigger" href="#modal1" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                <td><button data-target="modal2" class="waves-light btn light-green modal-trigger" href="#modal2" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                            </tr>
                            <tr>
                                <td>C004</td>
                                <td>Tiffany Banzuela</td>
                                <td>B9</td>
                                <td><button data-target="modal1" class="waves-light btn light-green modal-trigger" href="#modal1" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                <td><button data-target="modal2" class="waves-light btn light-green modal-trigger" href="#modal2" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                            </tr>
                            <tr>
                                <td>C005</td>
                                <td>Alvin John Perez</td>
                                <td>C13</td>
                                <td><button data-target="modal1" class="waves-light btn light-green modal-trigger" href="#modal1" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                <td><button data-target="modal2" class="waves-light btn light-green modal-trigger" href="#modal2" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script src='http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>
            <!-- Data table js -->
            <script>
                (function(window, document, undefined) {

                    var factory = function($, DataTable) {
                        "use strict";

                        $('.search-toggle').click(function() {
                            if ($('.hiddensearch').css('display') == 'none')
                                $('.hiddensearch').slideDown();
                            else
                                $('.hiddensearch').slideUp();
                        });

                        <!-- Scheduling Slide Add Time -->
                        $('.add-toggle').click(function() {
                            if ($('#addTime').css('display') == 'none')
                                $('#addTime').slideDown();
                            else
                                $('#addTime').slideUp();
                        });


                        /* Set the defaults for DataTables initialisation */
                        $.extend(true, DataTable.defaults, {
                            dom: "<'hiddensearch'f'>" +
                            "tr" +
                            "<'table-footer'lip'>",
                            renderer: 'material'
                        });

                        /* Default class modification */
                        $.extend(DataTable.ext.classes, {
                            sWrapper: "dataTables_wrapper",
                            sFilterInput: "form-control input-sm",
                            sLengthSelect: "form-control input-sm"
                        });

                        /* Bootstrap paging button renderer */
                        DataTable.ext.renderer.pageButton.material = function(settings, host, idx, buttons, page, pages) {
                            var api = new DataTable.Api(settings);
                            var classes = settings.oClasses;
                            var lang = settings.oLanguage.oPaginate;
                            var btnDisplay, btnClass, counter = 0;

                            var attach = function(container, buttons) {
                                var i, ien, node, button;
                                var clickHandler = function(e) {
                                    e.preventDefault();
                                    if (!$(e.currentTarget).hasClass('disabled')) {
                                        api.page(e.data.action).draw(false);
                                    }
                                };

                                for (i = 0, ien = buttons.length; i < ien; i++) {
                                    button = buttons[i];

                                    if ($.isArray(button)) {
                                        attach(container, button);
                                    } else {
                                        btnDisplay = '';
                                        btnClass = '';

                                        switch (button) {

                                            case 'first':
                                                btnDisplay = lang.sFirst;
                                                btnClass = button + (page > 0 ?
                                                                '' : ' disabled');
                                                break;

                                            case 'previous':
                                                btnDisplay = '<i class="material-icons">chevron_left</i>';
                                                btnClass = button + (page > 0 ?
                                                                '' : ' disabled');
                                                break;

                                            case 'next':
                                                btnDisplay = '<i class="material-icons">chevron_right</i>';
                                                btnClass = button + (page < pages - 1 ?
                                                                '' : ' disabled');
                                                break;

                                            case 'last':
                                                btnDisplay = lang.sLast;
                                                btnClass = button + (page < pages - 1 ?
                                                                '' : ' disabled');
                                                break;

                                        }

                                        if (btnDisplay) {
                                            node = $('<li>', {
                                                'class': classes.sPageButton + ' ' + btnClass,
                                                'id': idx === 0 && typeof button === 'string' ?
                                                settings.sTableId + '_' + button : null
                                            })
                                                    .append($('<a>', {
                                                                'href': '#',
                                                                'aria-controls': settings.sTableId,
                                                                'data-dt-idx': counter,
                                                                'tabindex': settings.iTabIndex
                                                            })
                                                            .html(btnDisplay)
                                                    )
                                                    .appendTo(container);

                                            settings.oApi._fnBindAction(
                                                    node, {
                                                        action: button
                                                    }, clickHandler
                                            );

                                            counter++;
                                        }
                                    }
                                }
                            };

                            // IE9 throws an 'unknown error' if document.activeElement is used
                            // inside an iframe or frame.
                            var activeEl;

                            try {
                                // Because this approach is destroying and recreating the paging
                                // elements, focus is lost on the select button which is bad for
                                // accessibility. So we want to restore focus once the draw has
                                // completed
                                activeEl = $(document.activeElement).data('dt-idx');
                            } catch (e) {}

                            attach(
                                    $(host).empty().html('<ul class="material-pagination"/>').children('ul'),
                                    buttons
                            );

                            if (activeEl) {
                                $(host).find('[data-dt-idx=' + activeEl + ']').focus();
                            }
                        };

                        /*
                         * TableTools Bootstrap compatibility
                         * Required TableTools 2.1+
                         */
                        if (DataTable.TableTools) {
                            // Set the classes that TableTools uses to something suitable for Bootstrap
                            $.extend(true, DataTable.TableTools.classes, {
                                "container": "DTTT btn-group",
                                "buttons": {
                                    "normal": "btn btn-default",
                                    "disabled": "disabled"
                                },
                                "collection": {
                                    "container": "DTTT_dropdown dropdown-menu",
                                    "buttons": {
                                        "normal": "",
                                        "disabled": "disabled"
                                    }
                                },
                                "print": {
                                    "info": "DTTT_print_info"
                                },
                                "select": {
                                    "row": "active"
                                }
                            });

                            // Have the collection use a material compatible drop down
                            $.extend(true, DataTable.TableTools.DEFAULTS.oTags, {
                                "collection": {
                                    "container": "ul",
                                    "button": "li",
                                    "liner": "a"
                                }
                            });
                        }

                    }; // /factory

                    // Define as an AMD module if possible
                    if (typeof define === 'function' && define.amd) {
                        define(['jquery', 'datatables'], factory);
                    } else if (typeof exports === 'object') {
                        // Node/CommonJS
                        factory(require('jquery'), require('datatables'));
                    } else if (jQuery) {
                        // Otherwise simply initialise as normal, stopping multiple evaluation
                        factory(jQuery, jQuery.fn.dataTable);
                    }

                })(window, document);

                $(document).ready(function() {
                    $('#datatable').dataTable({
                        "iDisplayLength": 5,
                        "oLanguage": {
                            "sStripClasses": "",
                            "sSearch": "",
                            "sSearchPlaceholder": "Enter Keywords Here",
                            "sInfo": "_START_ -_END_ of _TOTAL_",
                            "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                            '<option value="5">5</option>' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="30">30</option>' +
                            '<option value="40">40</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select></div>'
                        },
                        bAutoWidth: false
                    });
                });

                $(document).ready(function() {
                    $('#datatable3').dataTable({
                        "iDisplayLength": 5,
                        "oLanguage": {
                            "sStripClasses": "",
                            "sSearch": "",
                            "sSearchPlaceholder": "Enter Keywords Here",
                            "sInfo": "_START_ -_END_ of _TOTAL_",
                            "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                            '<option value="5">5</option>' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="30">30</option>' +
                            '<option value="40">40</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select></div>'
                        },
                        bAutoWidth: false
                    });
                });

                $(document).ready(function() {
                    $('#datatable4').dataTable({
                        "iDisplayLength": 3,
                        "oLanguage": {
                            "sStripClasses": "",
                            "sSearch": "",
                            "sSearchPlaceholder": "Enter Keywords Here",
                            "sInfo": "_START_ -_END_ of _TOTAL_",
                            "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                            '<option value="3">3</option>' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="30">30</option>' +
                            '<option value="40">40</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select></div>'
                        },
                        bAutoWidth: false
                    });
                });

                $(document).ready(function() {
                    $('#datatable2').dataTable({
                        "iDisplayLength": 5,
                        "oLanguage": {
                            "sStripClasses": "",
                            "sSearch": "",
                            "sSearchPlaceholder": "Enter Keywords Here",
                            "sInfo": "_START_ -_END_ of _TOTAL_",
                            "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                            '<option value="5">5</option>' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="30">30</option>' +
                            '<option value="40">40</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select></div>'
                        },
                        bAutoWidth: false
                    });
                });
            </script>

            <!-- modal js -->
            <script>
                $(document).ready(function(){
                    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                    $('.modal-trigger').leanModal();
                });
                function myCtrl($scope) {
                    $scope.myDecimal = 0;
                }

                $(document).ready(function() {
                    $('select').material_select();
                });
            </script>
        </div>
    </div>
</div>
@endsection