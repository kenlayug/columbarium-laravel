@extends('v2.baseLayout')
@section('title', 'Downpayment Transaction')
@section('body')
    <script src="{!! asset('/downpayment/controller.js') !!}"></script>
<div ng-controller="ctrl.downpayment">
    <div class = "col s12" >
        <div class = "row">
            <div id="unitDetails" class="modal modal-fixed">
                <center>
                    <div class="modal-header">
                        <label style="font-size: large">UNIT DETAILS</label>
                    </div>

                    <div id='viewDetails' style="background-color: #f3f3f3;">
                        <div class="row">
                            <div class="input-field col s2">
                                <label><b>Status:</b></label>
                            </div>
                            <div class="input-field col s6">
                                <label><u></u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s2">
                                <label><b>Owner Name:</b></label>
                            </div>
                            <div class="input-field col s6">
                                <label><u>Alba, Andrei Pascual</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s2">
                                <label><b>Details:</b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s2">

                            </div>
                            <div class="input-field col s5">
                                <div class="row">
                                    <div class="input-field col s3">
                                        <label>Price:</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <label><u>P55,000</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <label>Years:</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <label><u>10 Years</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <label>Payment:</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <label><u>P5,000</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <label>Balance:</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <label><u>P29,000</u></label>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="input-field col s5">
                                <div class="row">
                                    <div class="input-field col s3">
                                        <label>Building:</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <label><u>Building B</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <label>Floor:</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <label><u>Floor 3</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <label>Room:</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <label><u>Room C</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <label>Block:</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <label><u>Block C</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <label>Unit:</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <label><u>Unit B3C5</u></label>
                                    </div>
                                </div>
                            </div>
                            <div class="right row" style="margin-top: 50px;">
                                <div class="input-field col s12">
                                    <button name = "action" class="waves-light btn light-green modal-close" style = "color: #000000; margin-left: 10px; margin-right: 10px">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </div>

            <!-- Collection Data Table -->
            <div class = "col s6" style="margin-top: 13px;">
                <div class="row">
                    <div id="admin" class="col s12">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Customer Reservation Details</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Reservation/s</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="customer in customerList">
                                    <td>@{{ customer.strFullName }}</td>
                                    <td><button ng-click="getReservations(customer.intCustomerId, customer.strFullName, $index)"
                                                data-target="modal1" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "col s6" style="margin-top: 13px;">
                <div class="row">
                    <div id="admin" class="col s12">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Void Reservations</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable3">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Reservation Code</th>
                                    <th>Unit Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aaron Clyde Garil</td>
                                    <td>R912</td>
                                    <td><button data-target="unitDetails" class="waves-light btn light-green modal-trigger" href="#unitDetails" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>John Ezekiel Martinez</td>
                                    <td>R312</td>
                                    <td><button data-target="unitDetails" class="waves-light btn light-green modal-trigger" href="#unitDetails" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Aila Bianca Jacalne</td>
                                    <td>R352</td>
                                    <td><button data-target="unitDetails" class="waves-light btn light-green modal-trigger" href="#unitDetails" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Tiffany Banzuela</td>
                                    <td>R023</td>
                                    <td><button data-target="unitDetails" class="waves-light btn light-green modal-trigger" href="#unitDetails" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Alvin John Perez</td>
                                    <td>R943</td>
                                    <td><button data-target="unitDetails" class="waves-light btn light-green modal-trigger" href="#unitDetails" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    @include('modals.downpayment.viewDownpayment')
    @include('modals.downpayment.viewReservations')
</div>

@endsection