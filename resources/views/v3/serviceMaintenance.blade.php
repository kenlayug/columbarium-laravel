@extends('v2.baseLayout')
@section('title', 'Service Maintenance')
@section('body')


    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/serviceMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/service/controller.js') !!}"></script>

    <div ng-controller="ctrl.service">
        <!-- Section -->
        <div class = "parent">
            <div class = "row">
                    <!-- Create Service -->
                    <div class = "col s12 m6 l4">
                        <div class = "formCreate aside aside z-depth-3" id="formCreate">
                            <div class = "createFormHeader">
                                <h4 class = "center flow-text formCreateH4">Service Maintenance</h4>
                            </div>
                            <form ng-submit="saveService()" autocomplete="off">
                                <div class="formCreateStyle row" id="formCreate">
                                    <div class = "row">
                                        <div class="input-field col s6">
                                            <input ng-model="newService.strServiceName" id="serviceName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Installation" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                                            <label for="serviceName" data-error = "Invalid Format." data-success = "">Name<span style = "color: red;">*</span></label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input ng-model="newService.deciPrice"
                                                   ui-number-mask
                                                   id="servicePrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" min="1" max = "999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                            <label for="servicePrice" data-error = "Invalid Format." data-success = "">Price<span style = "color: red;">*</span></label>
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="newService.strServiceDesc" id="serviceDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Service offered to add additionals in a certain unit.">
                                        <label for="serviceDesc" data-error = "Invalid Format." data-success = "">Description</label>
                                    </div>
                                    <div class = "serviceCategory row">
                                        <div class="input-field col s6">
                                            <select ng-model="newService.intServiceCategoryId" id="selectServiceCategory" material-select watch>
                                                <option value="" disabled selected>Choose Category</option>
                                                <option ng-repeat="serviceCategory in serviceCategoryList" value="@{{ serviceCategory.intServiceCategoryId }}">@{{ serviceCategory.strServiceCategoryName }}</option>
                                            </select>
                                        </div>
                                        <a type = "submit" name = "action" class="modal-trigger btn light-green right" style = "color: black; margin-right: 10px; margin-top: 20px;" href = "#modalServiceCategory">New Category</a>
                                    </div>
                                    <div class = "row">
                                        <div class='col s12'>
                                            <a name = "action" class="modal-trigger btn light-green" style = "color: black;" href = "#modalRequirement">Choose Requirement</a>
                                        </div>
                                    </div>

                                </div>
                                <i class = "createReqField left" style = "padding-left: 20px;">*Required Fields</i>

                                <button type = "submit" name = "action" class="btn light-green right" style = "margin-top: 10px; color: black; margin-right: 10px;">Create</button>
                            </form>
                        </div>
                    </div>


                <!-- Data Grid -->
                <div class = "serviceDataGrid col s12 m6 m8">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header">
                                    <h4 class = "dataGridH4">Service Record</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Service/s" style = "margin-right: 10px;" href = "#modalArchiveService"><i class="material-icons" style = "color: black;">delete</i></button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table datatable='ng'>
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Requirement</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                        <td>@{{ service.strServiceDesc }}</td>
                                        <td><button tooltipped ng-click="viewRequirements(service.intServiceId)" name = "action" class="btn modal-trigger btn-floating light-green center" data-position = "bottom" data-delay = "30" data-tooltip = "View Requirement/s" href = "#modalListOfRequirement"><i class="material-icons" style = "color: black;">visibility</i></button></td>
                                        <td><button tooltipped ng-click="getService(service.intServiceId, $index)" name = "action" class="btn modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Update Requirement"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                            <button tooltipped ng-click="deleteService(service.intServiceId, $index)" name = "action" class="btn modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Requirement"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Update -->
        <div id="modalUpdateService" class="modalUpdate modal modal-fixed-footer">
            <div class = "modal-header">
                <h4 class = "center updateService">Update Service</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <form>
                <div class="modal-content" id="formUpdate" ng-submit="fUpdateService()">

                    <div class="updateFormStyle row" style = "margin-top: -20px;">
                        <div class="input-field col s6">
                            <input ng-model="updateService.strServiceName" id="serviceNameUpdate" value=" " type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Installation" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                            <label id="updateName" for="serviceNameUpdate" data-error = "Check format field." data-success = "">New Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s6">
                            <input ng-model="updateService.price.deciPrice"
                                   ui-number-mask
                                   id="servicePriceUpdate" value="0" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" min="1" max="999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                            <label id="updatePrice" for="servicePriceUpdate" data-error = "Check format field." data-success = "">New Price<span style = "color: red;">*</span></label>
                        </div>
                    </div>
                    <div class="input-field col s12" style = "margin-top: -10px; margin-left: 20px;">
                        <input ng-model="updateService.strServiceDesc" id="serviceDescUpdate" value=" " type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Service offered to add additionals in a certain unit.">
                        <label id="updateDesc" for="serviceDescUpdate" data-error = "Check format field." data-success = "">New Description</label>
                    </div>
                    <div class = "serviceCategory row" style = "margin-left: 10px; margin-top: 0px;">
                        <div class="input-field col s6">
                            <select ng-model="updateService.intServiceCategoryId" material-select id="selectServiceCategory">
                                <option value="" disabled selected>Choose Category</option>
                                <option ng-repeat="serviceCategory in serviceCategoryList" value="@{{ serviceCategory.intServiceCategoryId }}">@{{ serviceCategory.strServiceCategoryName }}</option>
                            </select>
                        </div>
                        <a type = "submit" name = "action" class="modal-trigger btn light-green right" style = "color: black; margin-right: 0px; margin-top: 20px; width: 220px;" href = "#modalServiceCategory">New Category</a>
                    </div>

                    <a name = "action" class="modal-trigger btn light-green left" style = "color: black; margin-top: -15px; margin-left: 20px;" href = "#modalRequirement">Choose Requirement</a>
                    <br><br>
                    <i class = "createReqField left" style = "padding-left: 20px;">*Required Fields</i>
                </div>
                <div class="btnUpdateConfirm modal-footer">
                    <button type = "submit" name = "action" class="btn light-green" style = "margin-right: 20px; color: black; margin-left: 10px; ">Confirm</button>
                    <a name = "action" class="modal-close btn light-green" style = "color: black;">Cancel</a>
                </div>
            </form>
        </div>

        <div id="modalViewRequirement" class="modal modal-fixed-footer" style = "width: 550px; height: 370px;">
            <div class = "modal-header">
                <h4 class = "center" style = "font-family: roboto3; color: white; padding-top: 10px;">List of Requirement</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <div class="modal-content" style = "overflow-y: auto">
                <ul class="collection with-header">
                    <li class="center collection-header"><h4 class = "additionalListH4 center">Requirement/s:</h4></li>
                    <div ng-repeat="requirement in serviceRequirementList">
                        <li class="collection-item center">@{{ requirement.strRequirementName }}</li>
                    </div>
                </ul>
            </div>
            <div class="modal-footer">
                <button name = "action" class="btnRequirementDone modal-close btn light-green" style = "margin-right: 20px; color: black;">Done</button>
            </div>
        </div>

        <!-- Modal Requirements -->
        <div id="modalRequirement" class="modalRequirement modal modal-fixed-footer" style = "overflow-y: hidden; overflow-x: hidden;">
            <div class = "modal-header">
                <h4 class = "listOfReqH4 center">List of Requirement/s</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <div class="modal-content" style = "overflow-y: auto;">
                <div class = "col s12">
                    <br>
                    <div class="row" style = "margin-top: -40px;">
                        <div class = "col s6">
                            <p ng-repeat="requirement in requirementList">
                                <input class = "filled-in" type="checkbox" id="@{{ requirement.intRequirementId }} filled-in-box" name="requirement[]" value="@{{ requirement.intRequirementId }}" />
                                <label for="@{{ requirement.intRequirementId }} filled-in-box">@{{ requirement.strRequirementName }}</label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="$('#modalRequirement').closeModal()" name = "action" class="btn light-green right" style = "margin-right: 10px; color: black;">CONFIRM</button>
                <button name = "action" class="waves-effect waves-light modal-close btn light-green" style = "color: black; margin-right: 10px;">Cancel</button>
            </div>
        </div>

        <!-- Modal Service Category -->
        <div id="modalServiceCategory" class="modalServiceCategory modal modal-fixed-footer">
            <div class = "modalCategoryHeader modal-header">
                <h4 class = "center text">Service Category</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <form ng-submit="saveServiceCategory()" novalidate autocomplete="off">
                <div class="modal-content" style = "overflow-y: auto;">
                    <div class = "col s12">
                        <div class="input-field col s12" style = "margin-top: -10px; padding-left: 10px;">
                            <input ng-model="newServiceCategory.strServiceCategoryName" id="serviceCategoryDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Cremation" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                            <label for="serviceCategoryDesc" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
                        </div>

                        <div class = "row">
                            <div class="input-field col s6">
                                <select ng-model='newServiceCategory.intServiceType' id = "test" name = "form_select" onchange = "showDiv(this)" material-select>
                                    <option class = "serviceType" value="" disabled selected>Type</option>
                                    <option value="0" class = "serviceType">Unit Servicing</option>
                                    <option value="1" class = "serviceType">Scheduled Service</option>
                                    <option value="2" class = "serviceType">For Return</option>
                                </select>
                            </div>

                            <div class="input-field col s6" id = "hidden_scheduledService" style = "display: none;">
                                <input ng-model='newServiceCategory.intServiceSchedulePerDay' ng-change="createSchedule(newServiceCategory)" ui-number-mask="0" id = "serviceQuantity" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts number/s only.<br>*Example: 6" required = "" aria-required="true" min = "1" minlength = "1" maxlength="10" length = "10">
                                <label for="serviceQuantity" data-error = "Invalid Format." data-success = "">Service Schedule Log<span style = "color: red;">*</span></label>
                            </div>
                            <div class="input-field col s6" id = "hidden_forReturn" style = "display: none;">
                                <input ng-model='newServiceCategory.intServiceDayInterval' name = "numberOfDays" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts number/s only.<br>*Example: 5" required = "" aria-required="true" min = "1" minlength = "1" maxlength="10" length = "10">
                                <label for="numberOfDays" data-error = "Invalid Format." data-success = "">Number of Days<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <i class = "modalCatReqField left" style = "margin-top: -10px; padding-left: 10px;">*Required Fields</i>
                    </div>
                    <br>
                    <!-- Data Grid -->
                    <div class = "col s12" style = "margin-bottom: 50px; width: 100%;" ng-show="newServiceCategory.intServiceType == 1">
                        <div class="row">
                            <div id="admin">
                                <div class="z-depth-2 card material-table">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Room No</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="schedule in newServiceCategory.scheduleList">
                                            <td ng-bind="schedule.intScheduleNo"></td>
                                            <td ng-bind="schedule.room.strRoomName"></td>
                                            <td>
                                                <a ng-click="connectToRoom(schedule)" name = "action" class="btn light-green modal-trigger left" href = "#modalConnectToRoom" style = "font-size: 11px; margin-left: 10px; color: black; margin-right: 10px;">Connect to Room</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <br>

                <div class="modal-footer">
                    <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black; margin-right: 20px;">Confirm</button>
                    <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
                </div>
            </form>
        </div>

        <div id="modalConnectToRoom" class="modal modal-fixed-footer" style = "overflow-y: hidden; height: 380px; width: 650px;">
            <div class = "modal-header box" style = "height: 55px;">
                <h4 class = "center" style = "padding-top: 8px; color: white; font-family: roboto3;">Connect to Room</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <form>
                <div class = "modal-content" style = "overflow-y: auto;">
                    <ul class="collapsible" data-collapsible="accordion" watch>
                        <li ng-repeat="building in buildingList">
                            <div ng-click="getFloors(building)" class="collapsible-header" style = "background-color: #00897b">
                                <i class="material-icons">business</i><label class = "flow-text" style = "color: white; font-family: roboto3;">@{{ building.strBuildingName }}</label></div>
                            <div class="collapsible-body">
                                <div class="row">
                                    <div class="col s12 m12">
                                        <ul class="collapsible popout" data-collapsible="accordion" watch>
                                            <li ng-repeat="floor in building.floorList">
                                                <div ng-click="getRooms(floor)" class="collapsible-header" style = "background-color: #fb8c00;">
                                                    <i class="material-icons">view_module</i>Floor @{{ floor.intFloorNo }}</div>
                                                <div ng-repeat="room in floor.roomList" class="collapsible-body" style = "background-color: #fbc02d; max-height: 50px;">
                                                    <p style = "padding-top: 10px;">@{{ room.strRoomName }}
                                                        <button ng-click="connectRoom(room)" tooltipped name = "action" class="btn modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Connect to this room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;"><i class="material-icons" style = "color: black;">add</i></button>
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
                <div class="modal-footer">
                    <button name = "action" class="btn light-green" style = "margin-right: 10px; color: black; margin-left: 10px;">Confirm</button>
                    <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
                </div>
            </form>
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
            $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal({dismissible: false});
            });
        </script>

        <script type="text/javascript">
            function showDiv(elem){
                if(elem.value == 0)
                    document.getElementById('hidden_scheduledService').style.display = "none";
                if(elem.value == 0)
                    document.getElementById('hidden_forReturn').style.display = "none";
                if(elem.value == 1)
                    document.getElementById('hidden_scheduledService').style.display = "block";
                if(elem.value == 1)
                    document.getElementById('hidden_forReturn').style.display = "none";
                if(elem.value == 2)
                    document.getElementById('hidden_forReturn').style.display = "block";
                if(elem.value == 2)
                    document.getElementById('hidden_scheduledService').style.display = "none";
            }
        </script>

    @include('modals.service.archive')

@endsection