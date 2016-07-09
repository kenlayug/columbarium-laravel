@extends('v2.baseLayout')
@section('title', 'Collection and Downpayment')
@section('body')

    <h4 style="font-family: myFirstFont2; padding-left: 20px; padding-top: 10px;">Collection and Downpayment</h4>

    <div id="cheque" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important;">
        <div class="modal-header" style="padding: 0px">
            <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Cheque Details</h4></center>            
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="input-field col s6">
                    <input id="drawee" type="text">
                    <label for="drawee">Drawee<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s6">
                    <input id="chequeNumber" type="text">
                    <label for="chequeNumber">Cheque Number<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="holderName" type="text">
                    <label for="holderName">Account Holder's Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s6">
                    <input id="accountNumber" type="text">
                    <label for="accountNumber">Account Number<span style = "color: red;">*</span></label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
        </div>
    </div>

    <div id="downpayment" class="modal modal-fixed" style="width: 75% !important ; max-height: 100% !important;">
        <div id="admin" class="col s12">
            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                <div class="table-header" style="background-color: #00897b;">
                    <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Transactions: Aaron Clyde Garil</h4>
                    <div class="actions">
                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                    </div>
                </div>
                <table id="datatable1">
                    <thead>
                    <tr>
                        <th>Transaction Code</th>
                        <th>Unit Code</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>C001</td>
                        <td>A1</td>
                        <td><button data-target="downPaymentForm" class="waves-light btn light-green modal-trigger" href="#downPaymentForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Down</button></td>
                    </tr>
                    <tr>
                        <td>C002</td>
                        <td>H12</td>
                        <td><button data-target="downPaymentForm" class="waves-light btn light-green modal-trigger" href="#downPaymentForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Down</button></td>
                    </tr>
                    <tr>
                        <td>C003</td>
                        <td>C6</td>
                        <td><button data-target="downPaymentForm" class="waves-light btn light-green modal-trigger" href="#downPaymentForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Down</button></td>
                    </tr>
                    <tr>
                        <td>C004</td>
                        <td>B9</td>
                        <td><button data-target="downPaymentForm" class="waves-light btn light-green modal-trigger" href="#downPaymentForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Down</button></td>
                    </tr>
                    <tr>
                        <td>C005</td>
                        <td>C13</td>
                        <td><button data-target="downPaymentForm" class="waves-light btn light-green modal-trigger" href="#downPaymentForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Down</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="collection" class="modal modal-fixed" style="width: 75% !important ; max-height: 100% !important;">
        <div class="col s12">
            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                <div class="table-header" style="background-color: #00897b;">
                    <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Transactions: Aaron Clyde Garil</h4>
                    <div class="actions">
                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                    </div>
                </div>
                <table id="datatable4">
                    <thead>
                    <tr>
                        <th>Transaction Code</th>
                        <th>Unit Code</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>C001</td>
                        <td>A1</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" href="#collectionForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>C002</td>
                        <td>H12</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" href="#collectionForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>C003</td>
                        <td>C6</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" href="#collectionForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>C004</td>
                        <td>B9</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" href="#collectionForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>C005</td>
                        <td>C13</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" href="#collectionForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Collection of Payment Modal-->
    <div id="downPaymentForm" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow-y: hidden;">
        <div class="modal-header">
            <center>
                <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont2">Downpayment: Aaron Clyde Garil</h4>
            </center>
        </div>
        <div class="modal-content" style="overflow-y: auto;">
            <br>
            <div class="row">
                <div class = "col s9 card material-table" style = "padding-left: 20px; margin-top: -5px; text-align: left">
                    <table id="datatable2">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Transaction Code</th>
                            <th>Payment</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>01/03/16</th>
                            <th>T123</th>
                            <th>P4,000</th>
                        </tr>
                        <tr>
                            <th>01/04/16</th>
                            <th>T124</th>
                            <th>P4,000</th>
                        </tr>
                        <tr>
                            <th>01/05/16</th>
                            <th>T125</th>
                            <th>P4,000</th>
                        </tr>
                        <tr>
                            <th>01/06/16</th>
                            <th>T126</th>
                            <th>P7,000</th>
                        </tr>
                        <tr>
                            <th>01/07/16</th>
                            <th>T113</th>
                            <th>P4,000</th>
                        </tr>
                        <tr>
                            <th>01/08/16</th>
                            <th>T022</th>
                            <th>P62,000</th>
                        </tr>
                        <tr>
                            <th>01/09/16</th>
                            <th>T129</th>
                            <th>P4,000</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s3">
                    <div class="row">
                        <div class="input-field col s12">
                            <select ng-model="newPayment.intPaymentType" required>
                                <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                            </select>
                        </div>
                        <div class="input-field col s12">
                            <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                        </div>
                        <div class="input-field col s12">
                            <input ng-model="newPayment.deciAmount" id="dAmount" type="number" required="" aria-required="true" class="validate">
                            <label for="dAmount">Amount to pay<span style = "color: red;">*</span></label>
                        </div>
                    </div>
                </div>
                <i class="left" style="margin-left: 10px">Balance:</i> <i><u>P 54,000.00<u></i><br>
                <i class="left" style="color: red; margin-left: 10px;">*Required Fields</i>
            </div>
            <br><br><br>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left:10px; margin-right: 10px;">Submit</button>
            <button name = "action" class="waves-light btn light-green modal-close" style = "color: #000000;">Cancel</button>
        </div>
    </div>

    <!-- Collection of Payment Modal-->
    <div id="collectionForm" class="modal modal-fixed-footer" style="width: 75% !important ; max-height: 100% !important; overflow-y: hidden">
        <div class="modal-header">
            <center>
                <h4 style = "font-size: 20px; color: white; padding-left: 15px; padding-top: 15px; padding-bottom: 0; font-family: myFirstFont2">Collection: Aaron Clyde Garil</h4>
            </center>
        </div>
        <div class="modal-content" style="overflow-y: auto">
            <br>
            <div class="row">
                <div class = "col s9 card material-table" style = "padding-left: 20px; margin-top: -5px; text-align: left">
                    <table id="datatable5">
                        <thead>
                        <tr>
                            <th>Due Date</th>
                            <th>Transaction Date</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>01/03/16</th>
                            <th>01/01/16</th>
                            <th>P4,000</th>
                            <th><i class="material-icons">done</i></th>
                            <th><button name = "action" class="waves-light btn light-green" style = "color: #000000;" disabled>Pay</button></th>
                        </tr>
                        <tr>
                            <th>01/03/16</th>
                            <th>01/03/16</th>
                            <th>P4,000</th>
                            <th><i class="material-icons">not_interested</i></th>
                            <th><button name = "action" class="waves-light btn light-green" style = "color: #000000;">Pay</button></th>
                        </tr>
                        <tr>
                            <th>01/03/16</th>
                            <th>01/03/16</th>
                            <th>P4,000</th>
                            <th><i class="material-icons">error</i></th>
                            <th><button name = "action" class="waves-light btn light-green" style = "color: #000000;">Pay</button></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s3">
                    <div class="row">
                        <div class="input-field col s12">
                            <select ng-model="newPayment.intPaymentType" required>
                                <option value="" disabled selected>Mode of Payment<span>*</span></option>
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                            </select>
                        </div>
                        <div class="input-field col s12">
                            <a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
                        </div>
                        <div class="input-field col s12">
                            <input ng-model="newPayment.deciAmount" id="cAmount" type="number" required="" aria-required="true" class="validate">
                            <label for="cAmount">Amount to pay<span style = "color: red;">*</span></label>
                        </div>
                    </div>
                </div>
                <i class="left" style="margin-left: 10px">Balance:</i> <i><u>P 54,000.00<u></i><br>
                <i class="left" style="color: red; margin-left: 10px;">*Required Fields</i>
            </div>
            <br><br><br>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left:10px; margin-right: 10px;">Submit</button>
            <button name = "action" class="waves-light btn light-green modal-close" style = "color: #000000;">Cancel</button>
        </div>
    </div>



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
                $('#datatable1').dataTable({
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
                $('#datatable2').dataTable({
                    "iDisplayLength": 3,
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
                $('#datatable5').dataTable({
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

@endsection