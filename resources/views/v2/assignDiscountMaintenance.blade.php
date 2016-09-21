@extends('v2.baseLayout')
@section('title', 'Assign Discount Maintenance')
@section('body')
    <!-- Import CSS/JS -->
    <script type="text/javascript" src="{!! asset('/assign-discount/controller.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>

<div ng-controller="ctrl.assign-discount">
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
                            <div class="table-header" style = "background-color: #00897b;; height: 55px;">
                                <h4 class = "flow-text" style = "color: white; font-family: roboto3">Transactions Record</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle2 btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table datatable="ng" dt-options="transactionTable.dtOptions" dt-column-def="transactionTable.dtColumnDefs">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="transaction in transactionList">
                                    <td ng-bind="transaction.strTransactionName"></td>
                                    <td>
                                        <button ng-click="openAddDiscount(transaction)" name = "action" class="btn tooltipped btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "Add Discount" href = "#modalAssignDiscount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button ng-click="openViewDiscount(transaction)" name = "action" class="btn tooltipped btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "View Discount" href = "#modalViewDiscount"><i class="material-icons" style = "color: black;">visibility</i></button>
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
                            <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                <h4 class = "flow-text" style = "color: white; font-family: roboto3">Services Record</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id = "datatable2" datatable="ng">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="service in serviceList">
                                    <td ng-bind="service.strServiceName"></td>
                                    <td ng-bind="service.price.deciServicePrice | currency : 'P'"></td>
                                    <td>
                                        <button tooltipped ng-click="openAddDiscountService(service)" name = "action" class="btn btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "Add Discount" href = "#modalAssignDiscount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button tooltipped ng-click="openViewDiscountService(service)" name = "action" class="btn btn-floating light-green modal-trigger" data-position = "bottom" data-delay = "30" data-tooltip = "View Discount"><i class="material-icons" style = "color: black;">visibility</i></button>
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
    <form id="modalAssignDiscount" class="modal modal-fixed-footer" style = "width: 51%; height: 400px; overflow-y: hidden" ng-submit="saveDiscounts()">
        <div class = "modal-header" style = "height: 55px; background-color: #00897b;">
            <h4 class = "center" style = "font-size: xx-large; color: white; font-family: roboto3; padding-top: 10px;">Assign Discount</h4>
            <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
               style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
            </a>
        </div>
        <div class="modal-content">
            <!-- Assign Discount Data Grid -->
            <div class = "dataGrid col s12 m6 l6" style = "margin-top: -10px;">
                <div class="row">
                    <div id="admin">
                        <div class="z-depth-2 card material-table">
                            <table datatable="ng" dt-options="discountTable.dtOptions" dt-column-def="discountTable.dtColumnDefs">
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
                                <tr ng-repeat="discount in discountList">
                                    <td>
                                        <p>
                                            <input ng-model="discount.selected" type="checkbox" class="filled-in" id="discount@{{ discount.intDiscountId }}" value=true/>
                                            <label for="discount@{{ discount.intDiscountId }}"></label>
                                        </p>
                                    </td>
                                    <td ng-bind="discount.strDiscountName"></td>
                                    <td>
                                        <span ng-if="discount.intDiscountType == 1" ng-bind="discount.deciDiscountRate | percentage : 2"></span>
                                        <span ng-if="discount.intDiscountType == 2" ng-bind="discount.deciDiscountRate | currency : 'P'"></span>
                                    </td>
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

    <!-- Modal View Discount -->
    <form id="modalViewDiscount" class="modal modal-fixed-footer" style = "width: 50%; height: 400px; overflow-y: hidden">
        <div class = "modal-header" style = "height: 55px; background-color: #00897b;">
            <h4 class = "center" style = "font-size: xx-large; color: white; font-family: roboto3; padding-top: 10px;">View Discount</h4>
            <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
               style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
            </a>
        </div>
        <div class="modal-content">
            <!-- View Discount Data Grid -->
            <div class = "dataGrid col s12 m6 l6" style = "margin-top: -10px;">
                <div class="row">
                    <div id="admin">
                        <div class="z-depth-2 card material-table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Rate</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="discount in discountList" ng-if="discount.selected">
                                    <td ng-bind="discount.strDiscountName"></td>
                                    <td>
                                        <span ng-if="discount.intDiscountType == 1" ng-bind="discount.deciDiscountRate | percentage : 2"></span>
                                        <span ng-if="discount.intDiscountType == 2" ng-bind="discount.deciDiscountRate | currency : 'P'"></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a name = "action" class="btn light-green modal-close" style = "color: black; margin-right: 10px;">Close</a>
        </div>
    </form>

    <!-- Datatable -->
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

                $('.search-toggle2').click(function() {
                    if ($('.hiddensearch').css('display') == 'none')
                        $('.hiddensearch').slideDown();
                    else
                        $('.hiddensearch').slideUp();
                });

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
                bAutoWidth: true
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
                bAutoWidth: true
            });
        });

    </script>


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
</div>
@endsection