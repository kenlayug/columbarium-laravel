@extends('maintenanceLayout')

@section('body')

    <link rel = "stylesheet" href = "{!! asset('/css/Floor_Record_Form.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/floor/floor-controller.js') !!}"></script>

    <div ng-app="floorApp">
        <!-- Section -->
        <h2 style = "font-family: fontSketch; padding-left: 55px; font-size: 2vw; padding-top: 20px;">Room Maintenance</h2>
        <div class = "col s12" >
            <div class = "row">
                <div class = "responsive">

                    <div class = "col s4" style = "margin-left: 10px;">


                        <div style = "overflow: auto;height: 470px;">
                            <div class = "col s12">
                                <div class = "aside aside " id="buildingSet" ng-controller="ctrl.buildingCollapsible">
                                    <ul class="collapsible popout" data-collapsible="accordion" watch>
                                        <li ng-repeat="building in buildings">
                                            <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                                <label style = "font-family: myFirstFont; font-size: 1.8vw; color: white;">@{{ building.strBuildingName }}</label>
                                            </div>
                                            <div class="collapsible-body" ng-repeat="floor in building.floor">
                                                <p>@{{ building.strBuildingCode+"-"+floor.intFloorNo }}
                                                    <button ng-click="ConfigureFloor(floor.intFloorId, $index, building.intBuildingId)" name = "action" class="@{{ floor.icon }}" data-position = "bottom" data-delay = "30" data-tooltip = "Floor is not yet configured." style = "margin-left: 5px;"><i class="material-icons">settings</i></button>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Configure -->
                    <div id="modalConfigure" class="modal" style = "width: 650px;" ng-controller="ctrl.configureFloor">
                        <div class = "modal-header" style = "height: 55px;">
                            <h4 style = "color: white; font-family: fontSketch; font-size: 1.9vw; padding-left: 170px;">Room Configuration</h4>
                        </div>
                        <form ng-submit="ConfigureFloor()">
                            <div class="modal-content">

                                <div class = "row">
                                    <div class="input-field col s6">
                                        <select>
                                            <option value="" disabled selected>Select Room Type</option>
                                            <option value="1">Type One</option>
                                            <option value="2">Type Two</option>
                                        </select>
                                        <label>Room Type</label>
                                    </div>

                                    <div class="input-field required col s6">
                                        <input id="maxBlock" type="number" class="validate" required = "" aria-required="true" minlength = "1" length = "20" min="1" max="20">
                                        <label for="maxBlock" data-error = "Invalid format." data-success = "">Maximum Number of Block/s: <span style = "color: red;">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type = "submit" name = "action" class="btn light-green" style = "margin-right: 20px; color: black; margin-left: 10px; ">Confirm</button>
                                <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
                            </div>
                        </form>
                    </div>


                <!-- Modal New Room Type -->
                <div id="modalNewRoomType" class="modal" style = "width: 450px;" ng-controller="ctrl.newFloorType">
                    <div class = "modal-header" style = "height: 55px;">
                        <h4 style = "color: white; font-family: fontSketch; padding-left: 100px;; font-size:1.9vw;">Create Room Type</h4>
                    </div>
                    <div class="modal-content">
                        <div class = "col s12">
                            <div class = "row">
                                <div style = "padding-left: 10px;">
                                    <form id="formCreateFloorType" ng-submit="SaveFloorType()">
                                        <div class="input-field col s12">
                                            <input ng-model="floorType.strFloorTypeName" name="floorType.strFloorDesc" id="newFloorTypeDesc" type="text" class="validate" required = "" aria-required = "true">
                                            <label for="newFloorTypeDesc" data-error = "Invalid format." data-success = "">Floor Type Name <span style = "color: red;">*</span></label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <br><br><br>

                    </div>
                    <div class="modal-footer">
                        <button name = "action" class="btn light-green" style = "color: black; margin-right: 30px; margin-left: 10px; ">Confirm</button>
                        </form>
                        <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
                    </div>
                </div>

                <!-- Data Grid -->
                <div class = "col s7" ng-controller="ctrl.floorTable">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style="background-color: #00897b;">
                                    <h4 style = "font-family: fontSketch; font-size: 1.8vw; color: white; padding-left: 0px;">Room Record</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Floor/s" style = "margin-right: 10px;" href = "#modalArchiveFloor"><i class="material-icons" style = "color: black;">delete</i></button> -->
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatable" watch>
                                    <thead>
                                    <tr>
                                        <th>Building Name</th>
                                        <th>No. of Room/s</th>
                                        <th>Rooms to be Configured</th>
                                        <th>Max Block/s</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="building in buildings">
                                        <td>@{{ building.strBuildingName }}</td>
                                        <td>@{{ building.floor.length }}</td>
                                        <td>@{{ building.noFloorConfig }}</td>
                                        <td>@{{ building.noFloorConfig }}</td>
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

@endsection