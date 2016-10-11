@extends('v2.baseLayout')
@section('title', 'Collections')
@section('body')

<script type="text/javascript" src="{!! asset('/collection/controller.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/collections.css') !!}">

<div ng-controller="ctrl.collection">
    <div class = "col s12">
    <br>
        <div class = "row container">
            <!-- Collection Data Table-->
            <div class = "col s12">
                <div class="row">
                    <div id="admin">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px;">Collections</h4>
                                <div class="actions">
                                    <a ng-click="toggleSearch()" tooltipped class="btn-flat nopadding"
                                    data-position="bottom" data-delay="30" data-tooltip="Search For All Customer">
                                    <i class="material-icons" style="color: #ffffff;">supervisor_account</i></a>
                                </div>
                            </div>

                            <div class="table-search">
                                <input ng-show="toggleSearchText" ng-change="filterCustomer(customerSearch)" ng-model="customerSearch" type="text" placeholder="Search Customer Name" list="customerList"> 
                            </div>

                            <datalist id="customerList">
                                <option ng-repeat="customer in allCustomerList" value="@{{ customer.strFullName }}"></option>
                            </datalist>

                            <table datatable="ng">
                                <thead>
                                <tr>
                                    <th style="width: 25%" class="center">Customer Name</th>
                                    <th style="width: 20%" class="center">Downpayment</th>
                                    <th style="width: 20%" class="center">Regular Collections</th>
                                    <th style="width: 20%" class="center">Pre Need</th>
                                    <th style="width: 15%" class="center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="customer in filterCustomerList">
                                    <td class="center" ng-bind="customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName"></td>
                                    <td class="center">
                                        <span ng-if="customer.deciDownpaymentCollectible == 0">---</span>
                                        <span ng-if="customer.deciDownpaymentCollectible != 0" ng-bind="customer.deciDownpaymentCollectible | currency : 'P '"></span>
                                    </td>
                                    <td class="center">
                                        <span ng-if="customer.deciCollectionCollectible == 0">---</span>
                                        <span ng-if="customer.deciCollectionCollectible != 0" ng-bind="customer.deciCollectionCollectible | currency : 'P '"></span>
                                    </td>
                                    <td class="center">
                                        <span ng-if="customer.deciPreNeedCollectible == 0">---</span>
                                        <span ng-if="customer.deciPreNeedCollectible != 0" ng-bind="customer.deciPreNeedCollectible | currency : 'P '"></span>
                                    </td>
                                    <td class="center">
                                        <button tooltipped ng-click="getCollections(customer, $index)"
                                                data-target="collection" class="waves-light btn light-green modal-trigger " data-position="bottom" data-delay="30" data-tooltip="View Collectibles" style = "color: #000000; padding-left: 10px; padding-right: 10px; margin-left: 5px; margin-right: 10px">View</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class = "col s4">
                <div class="row">
                    <div class="col s12">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px;">Past Due Accounts</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table datatable="ng" style="table-layout: fixed;">
                                <thead>
                                <tr>
                                    <th style="width: 60%">Customer Name</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="customer in notifiedCustomerList">
                                    <td ng-bind="customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName"></td>
                                    <td>
                                        <button ng-click="openPastDue(customer)" tooltipped class="waves-light btn light-green modal-trigger tooltipped" data-target="pastDueSMS" data-position="bottom" data-delay="30" data-tooltip="Past Due Details" style = "color: #000000; padding-left: 5px; padding-right: 10px; margin-left: 5px; margin-right: 10px;">View</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>         -->
        </div>
    </div>
    <script type="text/javascript">

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
            $('#datatable-collectibles').dataTable({
                "iDisplayLength": 7,
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
            $('#datatable-mainLog').dataTable({
                "iDisplayLength": 7,
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
            $('#datatable-regular').dataTable({
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
            $('#datatable-preneed').dataTable({
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
            $('#datatable-downpayment').dataTable({
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
            $('#datatable-showCollection').dataTable({
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
            $('#datatable-downpaymentForm').dataTable({
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
            $('#datatable-pastDue').dataTable({
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

        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                            
            $('.modal-trigger').leanModal({
                dismissible: false, // Modal can be dismissed by clicking outside of the modal
                opacity: .5, // Opacity of modal background
                in_duration: 300, // Transition in duration
                out_duration: 200, // Transition out duration
                starting_top: '4%', // Starting top style attribute
                ending_top: '10%', // Ending top style attribute
                }
            );
                              
        });

        function myCtrl($scope) {
            $scope.myDecimal = 0;
        }

        $(document).ready(function() {
            $('select').material_select();
        });


          $(document).ready(function(){
            $('ul.tabs').tabs();
          });
        
    </script>

    @include('modals.buy-unit.v2.cheque')
    @include('modals.buy-unit.v2.unit-detail')
    @include('modals.collection-downpayment.collectionList1')
    @include('modals.collection-downpayment.payCollection4')
    @include('modals.collection-downpayment.payDownpayment1')
    @include('modals.collection-downpayment.pastDueSMS')
    @include('modals.collection-downpayment.success1')
    @include('modals.collection-downpayment.successDownpayment3')
    @include('modals.collection-downpayment.collectionPayment1')

</div>
@endsection