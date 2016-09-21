@extends('v2.baseLayout')
@section('title', 'Room Maintenance')
@section('body')
    <link rel = "stylesheet" href = "{!! asset('/css/roomMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script src="{!! asset('room/controller.js') !!}"></script>

    <div ng-controller="ctrl.room">

       <div class = "row">
        <div class = "col s12 m6 l4">
            <div style = "height: 50px; background-color: #4db6ac;">
                <h4 class = "flow-text center" style = "padding-top: 10px; color: white; font-family: roboto3; margin-top: 30px;">Room Maintenance</h4>
            </div>
            <div style = "overflow: auto;height: 380px;">
                <div class = "aside aside">
                    <ul class="collapsible" data-collapsible="accordion" watch>
                        <li ng-repeat="building in buildingList">
                            <div ng-click="getFloors(building.intBuildingId, $index)" class="collapsible-header" style = "background-color: #00897b">
                                <i class="material-icons">business</i><label class = "flow-text" style = "color: white; font-family: roboto3;">@{{ building.strBuildingName }}</label></div>
                            <div class="collapsible-body">
                                <div class="row">
                                    <div class="col s12 m12">
                                        <ul class="collapsible popout" data-collapsible="accordion" watch>
                                            <li ng-repeat="floor in building.floorList">
                                                <div ng-click="getRooms(floor.intFloorId, $index)" class="collapsible-header" style = "background-color: #fb8c00;">
                                                    <i class="material-icons">view_module</i>Floor @{{ floor.intFloorNo }}</div>
                                                <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                <p style = "padding-top: 10px;">Create Room
                                                    <button tooltipped ng-click="createRoom()" name = "action" class="btn modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Create Room" style = "margin-top: -5px; margin-right: -20px;" href = "#modalCreateRoom"><i class="material-icons" style = "color: black;">add</i></button>
                                                </p>
                                                 </div>
                                                <div ng-repeat="room in floor.roomList" class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                    <p style = "padding-top: 10px;">@{{ room.strRoomName }}
                                                        <button tooltipped ng-click="deleteRoom(room.intRoomId, $index)" name = "action" class="btn modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Room"  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons" style = "color: black;">not_interested</i></button>
                                                        <button tooltipped ng-click="openUpdate(room.intRoomId)" name = "action" class="btn modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Room" style = "margin-top: -5px; margin-left: 5px;" href = "#modalUpdateRoom"><i class="material-icons" style = "color: black;">mode_edit</i></button>
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


                <!-- Data Grid -->
                <div class = "col s12 m6 l8" style = "margin-top: 20px;">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style="height: 55px; background-color: #00897b;">
                                    <h5 class = "flow-text" style = "font-family: roboto3; color: white; padding-left: 0px;">Room Record</h5>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated<br>Room/s" style = "margin-right: 10px;" href = "#modalArchiveRoom"><i class="material-icons" style = "color: black;">delete</i></button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatable" datatable="ng">
                                    <thead>
                                    <tr>
                                        <th>Building Name</th>
                                        <th>Floor No</th>
                                        <th>Room Name</th>
                                        <th>No. of Block/s</th>
                                        <th>Max Block/s</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="room in roomList">
                                        <td ng-bind="room.strBuildingName"></td>
                                        <td ng-bind="room.intFloorNo"></td>
                                        <td ng-bind="room.strRoomName"></td>
                                        <td ng-bind="room.blockCount"></td>
                                        <td ng-bind="room.intMaxBlock"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        <!-- Modal Archive Room -->
        <div id="modalArchiveRoom" class="modalArchive modal modal-fixed-footer">
            <div class = "modal-header">
                <h4 class = "center" style = "padding-top: 10px; color: white; font-family: roboto3;">Archive Room/s</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <div class="modalArchiveContent modal-content">
                <div id="admin1" class="col s12">
                    <div class="z-depth-2 card material-table">
                        <table datatable="ng">
                            <thead>
                            <tr>
                                <th>Building Name</th>
                                <th>Floor No</th>
                                <th>Room Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="room in archiveRoomList">
                                <td ng-bind="room.strBuildingName"></td>
                                <td ng-bind="room.intFloorNo"></td>
                                <td ng-bind="room.strRoomName"></td>
                                <td>
                                    <button ng-click="reactivateRoom(room, $index)" name = "action" class="btnActivate btn light-green" style = "color: black;">Activate</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class = "btn center light-green modal-close" style = "margin-right: 10px; color: black;">Done</button>
            </div>
        </div>

        <!-- Modal Create Room -->
        <div id="modalCreateRoom" class="modalCreateRoom modal modal-fixed-footer" style = "height: 350px; overflow-y: hidden; width: 750px;">
            <div class = "modalRoomTypeHeader modal-header box" style = "height: 55px;">
                <h4 class = "center" style = "margin-top: 10px; color: white; font-family: roboto3;">Create Room</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <form ng-submit="saveNewRoom()" autocomplete="off">
                <div class="modal-content" id="formCreateRoom" style = "overflow-y: auto">
                    <div class = "row">
                        <div class = "col s5" style = "margin-top: -20px;">
                            <div class="input-field col s12">
                                <input ng-model="newRoom.strRoomName" id="itemName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: St. Andrew" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                                <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
                            </div>
                            <i class = "modalCatReqField left" style = "color: red; margin-bottom: 20px; margin-top: 15px; padding-left: 10px;">*Required Fields</i>
                        </div>
                        <div class="headerDivider2"></div>
                        <div class="col s7" style = "margin-bottom: 20px;">
                            <div ng-show="unitTypeChecked != 0" class="input-field col s12" style = "margin-top: -6px;">
                                <input ng-model="newRoom.intMaxBlock" id="maxBlock" type="number" class="validate" required = "" aria-required="true" minlength = "1" length = "20" min="1" max="20">
                                <label for="maxBlock" data-error = "Invalid format." data-success = "">Maximum Number of Block/s: <span style = "color: red;">*</span></label>
                            </div>
                            <label style = "font-family: Arial; font-size: 1.2vw; color: black; padding-left: 10px;">Room Type</label>
                            <h6 ng-show="roomTypeList.length == 0" style = "padding-left: 10px;">Create Room Type first.</h6>
                            <div ng-repeat="roomType in roomTypeList" style = "margin-left: 0px; margin-top: 20px;">
                                <div ng-if="$index%2 == 1" class="col s12">
                                    <input ng-click="showBlocks(roomType)" class="filled-in" type="checkbox" id="@{{ roomType.intRoomTypeId }} filled-in-box" value="@{{ roomType.intRoomTypeId }}" name="roomTypes[]"/>
                                    <label for="@{{ roomType.intRoomTypeId }} filled-in-box">@{{ roomType.strRoomTypeName }}</label>
                                </div>
                                <div ng-if="$index%2 == 0" class="col s12">
                                    <input ng-click="showBlocks(roomType)" class="filled-in" type="checkbox" id="@{{ roomType.intRoomTypeId }} filled-in-box" value="@{{ roomType.intRoomTypeId }}" name="roomTypes[]"/>
                                    <label for="@{{ roomType.intRoomTypeId }} filled-in-box">@{{ roomType.strRoomTypeName }}</label>
                                </div>
                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a name = "action" class="btnRoomType modal-trigger btn light-green left" style = "color: black; margin-left: 10px;" href = "#modalRoomType">New Room Type</a>
                    <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black; margin-right: 10px;">Confirm</button>
                    <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
                </div>
            </form>
        </div>

        <!-- Modal New Room Type -->
        <form ng-submit="createRoomType()" id="modalRoomType" class="modalRoomType modal modal-fixed-footer" style = "height: 320px; width: 520px;" autocomplete="off">
            <div class = "modalRoomTypeHeader modal-header box" style = "height: 55px;">
                <h4 class = "center" style = "color: white; font-family: roboto3; padding-top: 12px;">New Room Type</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <div class="modal-content" id="formCreateRoomType">
                <div class = "roomType row">
                    <div class="input-field col s6">
                        <input ng-model="newRoomType.strRoomTypeName" id="itemCategoryDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Cashier" name="item.strItemCategory" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                        <label for="itemCategoryDesc" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
                    </div>
                    <div ng-if="newRoomType.boolUnit" ng-disabled="!newRoomType.boolUnit" class="input-field col s6">
                        <input ng-model="newRoomType.strUnitTypeName" id="unitTypeName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Columbary Vaults" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                        <label for="unitTypeName" data-error = "Invalid format." data-success = "">Unit Type Name<span style = "color: red;">*</span></label>
                    </div>
                    <div class="input-field col s12" style = "margin-left: -10px; margin-top: 0px;">
                        <input class="filled-in" ng-model="newRoomType.boolUnit" value="1" id="boolUnitType filled-in-box" type="checkbox">
                        <label for="boolUnitType filled-in-box">Can this room type contain blocks?</label>
                    </div>
                </div>

                <br>
                <i class = "modalCatReqField left col s12" style = "color: red; padding-top: 0px; padding-left: 10px;">*Required Fields</i>

            </div>
            <div class="modal-footer">
                <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black; margin-right: 20px;">Confirm</button>
                <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
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
            $('select').material_select();
        });
        $('.modal-trigger').leanModal({
                    dismissible: false
                }
        );
    </script>
        @include('modals.room.update')
</div>
@endsection