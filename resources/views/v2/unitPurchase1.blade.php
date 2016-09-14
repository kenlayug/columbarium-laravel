@extends('v2.baseLayout')
@section('title', 'Purchase Unit')
@section('body')

    <link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/vaults.css') !!}">

    <script type="text/javascript" src="{!! asset('/js/unitPurchase2.js') !!}"></script>
    <script src="{!! asset('/buy-unit/controller.js') !!}"></script>
    <script src="{!! asset('/js/tooltip.js') !!}"></script>
    <div ng-controller='ctrl.unit-purchase'>

        <!-- Section -->
        <div class = "col s12">
            <div class = "row">
                <div class = "responsive">
                    <div class = "col s4">
                        <div class="row" style="background-color: #00897b; margin-top: 20px; ">
                            <center><h5 style = "margin-left: 20px;  color: white; padding: 20px; padding-bottom: 5px;">Purchase Unit</h5></center>
                        </div>
                        <div class="z-depth-1 row"  style="margin-top: -25px;">
                            <div class="input-field col s4">
                                <label  style="color: #000000; font-size: 17px;">Search Building: </label>
                            </div>
                            <div class="input-field col s8">
                                <div style="margin-right: 5px;">
                                    <input ng-model="filterBuilding" type="text" placeholder="Building Name" list="buildingName">  
                                </div>
                                <datalist id="buildingName">
                                    <option ng-repeat="building in buildingList" ng-value="building.strBuildingName">
                                </datalist>
                            </div>
                        </div> 
                        <!-- Collapsible -->
                        <div style ="margin-top: -20px;">
                            <div class = "col s12">
                                <div class = "aside aside" style="overflow: auto; height: 400px;">
                                    <ul class="collapsible" data-collapsible="accordion" watch>
                                        <li ng-repeat="unitType in unitTypeList">

                                            <div ng-click="getBlocks(unitType.intRoomTypeId, $index)" class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                                <label style = "font-size: 1.5vw; color: white;">@{{ unitType.strUnitTypeName }}</label>
                                            </div>

                                            <div ng-repeat="block in unitType.blockList"
                                                 ng-if="(filterBuilding == null || filterBuilding == '') ||( block.strBuildingName == filterBuilding && filterBuilding != null)"
                                                 class="collapsible-body @{{ block.color }}" style = "max-height: 50px;">
                                                <p style = "padding-top: 15px;">@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}
                                                    <a ng-click="getUnits(block, $index)"
                                                            id = "Button1" tooltipped class="right left btn-floating btn-flat btn light-green"
                                                            data-position = "right" data-delay = "25" data-tooltip = "View" type="button" 
                                                            style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></a>
                                                   
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
                    </div>
                    <div class = "col s8" style="margin-top: 20px;">
                        <button ng-show="false"
                                data-target="receipt" class="right waves-light btn blue modal-trigger" href="#receipt" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Generate Receipt</button>

                        <div class = "col s12" style = "width: 100%; margin-top: 0px;">
                            <div ng-hide="showUnit"
                                 id="tableStart" style="margin-top: -10px;">
                                <div class = "card material-table" style = "text-align: left">
                                    <div class="table-header" style="background-color: #00897b;">
                                        <h4 style = "font-size: 20px; color: white; padding-left: 45%;">Overview</h4>
                                        <div class="actions">
                                            <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                        </div>
                                    </div>
                                    <table id="datatable-overview" datatable="ng">
                                        <thead>
                                            <tr>
                                                <th style="font-size:15px; color: #000000;">Customer Name</th>
                                                <th style="font-size:15px; color: #000000;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="customer in customerUnitList">
                                                <td ng-bind="customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName"></td>
                                                <td>
                                                    <button ng-click="openPurchasedUnit(customer)" tooltipped class="waves-light btn light-green modal-trigger" data-target="purchaseduUnit" data-position="bottom" data-delay="30" data-tooltip="View Purchased Unit" style = "color: #000000;">View</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                            
                            </div>

                            <div ng-show="showUnit" class="responsive" id="tableUnit" style="margin-top: 10px;">
                                <div class = "col s12 z-depth-1" style="background-color: #e0f2f1; margin-top: 20px;">
                                    <a ng-click="closeBlock()" tooltipped class="left btn-floating btn-flat btn teal" data-position="right" data-delay="30" data-tooltip="Close"
                                    style="position:absolute; color: white; font-weight: 900; margin-top: 25px; margin-left: 15px;">X</a>

                                    <div class = "aside aside z-depth-3">
                                        <div class="center vaults-content">
                                            <div class="table-header" style="background-color: #00897b;">
                                                <h2 style = "color: #ffffff; font-size: 30px; margin-top: 20px; margin-left: 20px; padding: 10px;">@{{ blockName }}</h2> 
                                                <button ng-show="reservationCart.length != 0"
                                                    id="btnBillOut"
                                                    data-target="availUnit"
                                                    class="right waves-light btn blue modal-trigger @{{ animation }}" href="#availUnit" 
                                                    style = "color: black;margin-bottom: 10px; margin-right: 15px; margin-top:-65px;">Bill out</button> 
                                            </div>

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
                                <!-- Legends -->
                                <div class = "row" style="margin-top: -30px; margin-right: -10px; margin-left: -10px;">
                                    <div class = "col s12">
                                        <div class = "aside aside z-depth-3" style = "height: 155px;">
                                            <div class="row" style="background-color: #00897b; margin-top: 20px; ">
                                                <center><h5 style = "margin-left: 20px;  color: white; padding: 20px; padding-bottom: 5px;">Legend</h5></center>
                                            </div>

                                            <div class = "row" style = "margin-top: -10px;">
                                                <center>
                                                    <div class = "col s2">
                                                        <button name = "action" class="btn-floating green darken-3" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[1]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">Available</label>
                                                    </div>
                                                    <div class = "col s2" style = "margin-left: -5px;">
                                                        <button name = "action" class="btn-floating blue darken-3" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[2]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">Reserved</label>
                                                    </div>
                                                    <div class = "col s2">
                                                        <button name = "action" class="btn-floating yellow darken-2" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[4]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">AtNeed</label>
                                                    </div>
                                                    <div class = "col s2">
                                                        <button name = "action" class="btn-floating pink darken-1" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[6]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">Partially Owned</label>
                                                    </div>
                                                    <div class = "col s2">
                                                        <button name = "action" class="btn-floating red darken-3" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[3]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">Owned</label>
                                                    </div>
                                                    <div class = "col s2">
                                                        <button name = "action" class="btn-floating orange darken-1" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[0]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">Deactivated</label><br>
                                                    </div>
                                                </center>
                                            </div>
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
                $(document).ready(function() {
                    $('#datatable-overview').dataTable({
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
                    $('#datatable-purchase').dataTable({
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

            <!-- Show Hide Unit -->
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
            
            </script>
            <style>
                label b, u{
                    font-size: 16px;
                }
            </style>
        </div>

        @include('modals.buy-unit.v2.add-to-cart')
        @include('modals.buy-unit.v2.switch-avail-type')
        @include('modals.buy-unit.v2.bill-out')
        @include('modals.buy-unit.v2.cheque')
        @include('modals.buy-unit.v2.purchased-unit')
        @include('modals.manage-unit.newCustomer')
        @include('modals.buy-unit.v2.success')
        @include('modals.buy-unit.v2.unit-detail')

    </div>

@endsection