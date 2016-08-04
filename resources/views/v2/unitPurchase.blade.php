@extends('v2.baseLayout')
@section('title', 'Unit Purchases')
@section('body')

    <link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/vaults.css') !!}">

    <script src="{!! asset('/buy-unit/controller.js') !!}"></script>

    <div ng-controller="ctrl.unit-purchase">

        <!-- Section -->
        <div class = "col s12" >
            <div class = "row">
                <div class = "responsive">

                    <div class = "col s4">
                        <h4 style = "margin-top: 20px; margin-left: 20px; font-family: myFirstFont">BUY UNIT</h4>


                        <!-- Collapsible -->
                        <div style = "overflow: auto;height: 370px;">
                            <div class = "col s12">
                                <div class = "aside aside ">
                                    <ul class="collapsible" data-collapsible="accordion" watch>
                                        <li ng-repeat="unitType in unitTypeList">

                                            <div ng-click="getBlocks(unitType.intRoomTypeId, $index)" class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                                <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">@{{ unitType.strRoomTypeName }}</label>
                                            </div>

                                            <div ng-repeat="block in unitType.blockList" class="collapsible-body @{{ block.color }}" style = "max-height: 50px;">
                                                <p style = "padding-top: 15px;">@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}
                                                    <button ng-click="getUnits(block, $index)"
                                                            id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                </p>
                                            </div>

                                            <div ng-show="unitType.blockList.length == 0" class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                <p style = "padding-top: 15px;">
                                                    No blocks found for this type.
                                                </p>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br>

                        <!-- Legends -->
                        <div class = "row" style="margin-top: -80px;">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3" style = "height: 130px;">
                                    <div class = "header" style = "height: 35px; background-color: #00897b">
                                        <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: myFirstFont2;">Legend:</label>
                                    </div>

                                    <div class = "row" style = "margin-top: 10px;">
                                        <center>
                                            <div class = "col s3">
                                                <button name = "action" class="btn-floating green";"></button>
                                                <label style="font-size: 15px; color: #000000;">Available</label>
                                            </div>
                                            <div class = "col s3">
                                                <button name = "action" class="btn-floating blue"></button>
                                                <label style="font-size: 15px; color: #000000;">Reserved</label>
                                            </div>
                                            <div class = "col s3">
                                                <button name = "action" class="btn-floating yellow""></button>
                                                <label style="font-size: 15px; color: #000000;">AtNeed</label>
                                            </div>
                                            <div class = "col s3">
                                                <button name = "action" class="btn-floating red"></button>
                                                <label style="font-size: 15px; color: #000000;">Owned</label>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class = "col s8">
                        <button ng-show="reservationCart.length != 0"
                                id="btnBillOut"
                                data-target="availUnit"
                                class="right waves-light btn blue modal-trigger @{{ animation }}" href="#availUnit" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Bill out</button>
                        <button ng-show="false"
                                data-target="receipt" class="right waves-light btn blue modal-trigger" href="#receipt" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Generate Receipt</button>

                        <div class = "col s4 z-depth-2 " style = "margin-top: 5px; width: 100%;">
                            <div ng-hide="showUnit"
                                 id="tableStart">
                                <div class = "col s12">
                                    <div class = "aside aside z-depth-3">
                                        <div class="center vaults-content">
                                            <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont">Select a Block</h2>
                                            <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                                <tbody>
                                                <tr>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                    <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div ng-show="showUnit" class="responsive" id="tableUnit">
                                <div class = "col s12">
                                    <div class = "aside aside z-depth-3">
                                        <div class="center vaults-content">
                                            <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont">@{{ blockName }}</h2>
                                            <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                                <tbody>
                                                <tr ng-repeat="unitLevel in unitList">
                                                    <td ng-repeat="unit in unitLevel"
                                                        class="@{{ unit.color }}">
                                                        <a ng-click="openUnit(unit)"
                                                           data-target="modal1" class="waves-effect waves-light modal-trigger">@{{ unit.display }}</a>
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

                </div>
            </div>

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
            </script>

            <!-- Show Hide Unit -->x
            <script>
                function switchVisible() {
                    if (document.getElementById('tableUnit') !== undefined) {

                        if (document.getElementById('tableUnit').style.display == 'block') {
                            document.getElementById('tableUnit').style.display = 'none';
                            document.getElementById('tableStart').style.display = 'block';
                        } else {
                            document.getElementById('tableUnit').style.display = 'block';
                            document.getElementById('tableStart').style.display = 'none';
                        }
                    }
                }
            </script>
            <script>
                $(document).ready(function(){
                    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                    $('.modal-trigger').leanModal();
                });
            </script>
            <style>
                label b, u{
                    font-size: 16px;
                }
            </style>
        </div>

        @include('modals.buy-unit.v2.add-to-cart')
        @include('modals.buy-unit.v2.bill-out')
        @include('modals.buy-unit.v2.cheque')
        @include('modals.manage-unit.newCustomer')
        @include('modals.buy-unit.v2.success')
        @include('modals.buy-unit.v2.unit-detail')

    </div>

@endsection