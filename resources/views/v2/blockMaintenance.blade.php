@extends('v2.baseLayout')
@section('title', 'Block Maintenance')
@section('body')
    <!-- Section -->
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/blocksMaintenance.css') !!}"/>
    <script src="{!! asset('/block/controller.js') !!}"></script>

    <div ng-controller="ctrl.block">


            <div class = "row">
                    <div class = "col s12 m6 l4">
                        <div style = "height: 50px; background-color: #4db6ac;">
                            <h5 class = "center flow-text" style = "padding-top: 10px; color: white; font-family: roboto3; margin-top: 10px;">Block Maintenance</h5>
                        </div>
                                <div class = "aside aside" style = "overflow: auto;height: 320px;">

                                    <ul class="collapsible" data-collapsible="accordion" watch>
                                        <li ng-repeat="building in buildingList">
                                            <div ng-click="getFloors(building.intBuildingId, $index)" class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                                <label class = "flow-text" style = "font-family: roboto3; color: white;">@{{ building.strBuildingName }}</label>
                                            </div>
                                            <div ng-show="building.floorList.length == 0" class="collapsible-body" style = "background-color: #fb8c00;">
                                                <p>No floor configured to create a block.</p>
                                            </div>
                                            <div class="collapsible-body" ng-hide="building.floorList.length == 0">
                                                <div class="row">
                                                    <div class="col s12 m12">
                                                        <ul class="collapsible" data-collapsible="accordion" watch>
                                                            <li ng-repeat="floor in building.floorList">
                                                                <div ng-click="getRooms(floor.intFloorId, $index)" class="collapsible-header orange"><i class="medium material-icons">business</i>
                                                                    <label class = "flow-text" style = "font-family: roboto3; color: white;">Floor No @{{ floor.intFloorNo }}</label>
                                                                </div>
                                                                <div ng-show="floor.roomList.length == 0" class="collapsible-body" style = "background-color: #fb8c00;">
                                                                    <p>No room configured to create a block.</p>
                                                                </div>
                                                                <div ng-hide="floor.roomList.length == 0" class="collapsible-body">
                                                                    <div class="row">
                                                                        <div class="col s12 m12">
                                                                            <ul class="collapsible" data-collapsible="accordion" watch>
                                                                                <li ng-repeat="room in floor.roomList">
                                                                                    <div ng-click="getBlocks(room.intRoomId, $index)" class="collapsible-header" style = "background-color: #fb8c00;">
                                                                                        <i class="material-icons">view_module</i>@{{ room.strRoomName }}
                                                                                    </div>
                                                                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                                                        <p style = "padding-top: 10px;">Create Block
                                                                                            <button tooltipped ng-click="openCreate(room.intRoomId)" name = "action" class="btn modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Create Block" style = "margin-top: -5px; margin-right: -20px;"><i class="material-icons" style = "color: black;">add</i></button>
                                                                                        </p>
                                                                                    </div>
                                                                                    <div ng-repeat="block in room.blockList" class="collapsible-body @{{ block.color }}" style = "max-height: 50px;">
                                                                                        <p style = "padding-top: 10px;"><i class="material-icons" style = "padding-right: 10px;">@{{block.icon}}</i>Block No. @{{ block.intBlockNo}}
                                                                                            <button tooltipped ng-click="deleteBlock(block.intBlockId, $index)" name = "action" class="btn modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Block" style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                                                            <button tooltipped ng-click="getUnits(block.intBlockId, $index)" name = "action" class="btn light-green right btn-floating" data-position = "bottom" data-delay = "30" data-tooltip = "View Block" style = "margin-top: -5px; margin-right: 0px; font-family: arial; color: black;" ><i class="material-icons" style = "color: black">visibility</i></button>
                                                                                        </p>
                                                                                    </div>
                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>



                        <!-- Legends -->
                        <div class = "row" style="margin-top: 30px;">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3" style = "height: 110px;">
                                    <div class = "header" style = "height: 35px; background-color: #00897b">
                                        <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: roboto3;">Legend:</label>
                                    </div>

                                    <div class = "row" style = "margin-top: 10px;">
                                        <center>
                                            <div class = "col s3">
                                                <button name = "action" class="btn-floating green"></button>
                                                <label style="font-size: 15px; color: #000000;">Available</label>
                                            </div>
                                            <div class = "col s2" style = "margin-left: -5px;">
                                                <button name = "action" class="btn-floating blue"></button>
                                                <label style="margin-left: -10px; font-size: 15px; color: #000000;">Reserved</label>
                                            </div>
                                            <div class = "col s2">
                                                <button name = "action" class="btn-floating yellow"></button>
                                                <label style="font-size: 15px; color: #000000;">AtNeed</label>
                                            </div>
                                            <div class = "col s2">
                                                <button name = "action" class="btn-floating red"></button>
                                                <label style="font-size: 15px; color: #000000;">Owned</label>
                                            </div>
                                            <div class = "col s3">
                                                <button name = "action" class="btn-floating orange"></button>
                                                <label style="font-size: 15px; color: #000000;">Deactivated</label>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class = "dataGrid col s12 m6 l8" ng-hide="block != null">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b;">
                                    <h5 class = "flow-text" style = "font-family: roboto3; color: white;">Block Record</h5>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Block/s" style = "margin-right: 10px;" href = "#modalArchiveBlock"><i class="material-icons" style = "color: black">delete</i></button>
                                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id = "datatable" datatable="ng">
                                    <thead>
                                    <tr>
                                        <th>Building Name</th>
                                        <th>Floor No.</th>
                                        <th>Room Name</th>
                                        <th>Block No.</th>
                                        <th>Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="block in blockList">
                                        <td ng-bind="block.strBuildingName"></td>
                                        <td ng-bind="block.intFloorNo"></td>
                                        <td ng-bind="block.strRoomName"></td>
                                        <td ng-bind="block.intBlockNo"></td>
                                        <td ng-bind="block.strUnitTypeName" tooltipped data-delay="50" data-tooltip="@{{ block.strUnitTypeName }}"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class = "col s12 m6 l8" ng-show="block != null" style = "margin-top: 0px;">
                    <div class = "fixed-header" style = "margin-top: -20px; width: 100%; height: 55px; background-color: teal;">
                        <h2 class = "center" style = "padding-top: 10px; color: white; font-family: roboto3; font-size: 2vw; margin-top: 30px;">@{{ block.display }} (@{{ block.strUnitTypeName }})</h2>
                        <a ng-click="closeBlockView()"
                                ng-show="block != null"
                                class = "btn-floating btn teal right" data-position = "top" style = "position:absolute;top:0;right:0; z-index: 1000; margin-top: 81px; margin-right: 20px; color: white;">&#10006;</a>
                    </div>
                    <div class = "aside aside z-depth-3" style = "margin-top: 10px; overflow: auto; overflow-x: hidden; height: 470px; background-color: #e0f2f1;">
                        <div class="center vaults-content" style = "height: 400px;">
                                <table id="tableUnits" style="font-size: small; margin-bottom: 10px;margin-top: 10px">
                                    <tbody>
                                    <tr ng-repeat="unitCategory in unitList">
                                        <td ng-repeat="unit in unitCategory" style="background-color: #00897b; border: 2px solid white;" class="@{{ unit.color }}">
                                            <a ng-click="openUnit(unit.intUnitId, $index)" class="waves-effect waves-light" style = "color: white; font-size: 20px; font-family: roboto3;">@{{ unit.levelLetter+unit.intColumnNo }}</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>

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

        </script>


        <script>
        $(document).ready(function() {
            $('input#input_text, textarea#textarea1').characterCounter();
        });
        $('.modal-trigger').leanModal({
            dismissible: false
        });

    </script>

    @include('modals.block.create')
    @include('modals.block.archive')
    @include('modals.block.unitStatus')

</div>
@endsection