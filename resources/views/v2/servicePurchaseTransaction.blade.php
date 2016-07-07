@extends('v2.baseLayout')
@section('title', 'Service Purchase')
@section('body')

    <div id="newCustomer" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden">
        <div class="modal-header1" style="background-color: #00897b;">
            <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Add New Customer</h4></center>
        </div>
        <form class="modal-content" style="overflow-y: auto;">
            <div class="row">
                <div class="input-field col s4">
                    <input id="FirstName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="FirstName">First Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input id="MidName" type="text" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="MidName">Middle Name</label>
                </div>
                <div class="input-field col s4">
                    <input id="LastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="LastName">Last Name<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8">
                    <input id="address" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="100" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,100}">
                    <label for="address">Address<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input id="cNum" type="text" required="" aria-required="true" class="validate" pattern="\d{4}[\-, ., ]\d{3}[\-, ., ]\d{4}">
                    <label for="cNum" data-error="Format: XXXX-XXX-XXXX">Contact Number<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s2">
                    <label for="dayB">Date of Birth:</label>
                </div>
                <div class="input-field col s4">
                    <input id="dayB" type="date" class="">
                </div>
                <div class="input-field col s2">
                    <label>Gender:</label>
                </div>
                <div class="input-field col s4">
                    <p>
                        <input name="group1" type="radio" id="gender1" checked="checked"/>
                        <label for="gender1">Male</label>
                        <input name="group1" type="radio" id="gender2" />
                        <label for="gender2">Female</label>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s3">
                    <label>Civil Status:</label>
                </div>
                <div class="input-field col s8">
                    <p>
                        <input name="group11" type="radio" id="test1" checked="checked"/>
                        <label for="test1">Single</label>
                        <input name="group11" type="radio" id="test2" />
                        <label for="test2">Married</label>
                        <input name="group11" type="radio" id="test3" />
                        <label for="test3">Widow/Widower</label>
                    </p>
                </div>
                <i class = "left" style = "color: red; margin-top: 10px;">*Required Fields</i>
            </div>
            <br><br>
        </form>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
        </div>
    </div>


    <div id="requirements" class="modal modal-fixed-footer" style="height: 300px; overflow-y: hidden">
        <div class="modal-header1" style="background-color: #00897b;">
            <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Service Requirement/s</h4></center>
        </div>
        <form class="modal-content" style="overflow-y: auto">
            <center>
            <div class="row">
                <div class="col s6">
                    <i>- Death Certificate</i><br>
                    <i>- Transfer Permit</i><br>
                    <i>- Marriage Certificate</i>
                </div>
                <div class="col s6">
                    <i>- Exhumation Permit</i><br>
                    <i>- ID of Informant</i><br>
                    <i>- Reburial Permit</i>
                </div>
            </div></center>
            <br><br>
        </form>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Close</button>
        </div>
    </div>

    <div id="schedule" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden">
        <div class="modal-header1" style="background-color: #00897b;">
            <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Assign Schedule</h4></center>
            <button class="add-toggle light-green nopadding btn tooltipped" data-delay="50" data-tooltip="Add New Time"
                    style = "margin-left: 880px; margin-top: -75px; color: #000000"><i class="material-icons" style="color: #000000">add</i> Time</button>
        </div>
        <div class="modal-content" style="overflow-y: auto">
            <div class="row" style="margin-top: -10px;">
                <input type="checkbox" id="future"/>
                <label for="future" style="font-family: Arial">For Future Use</label>
            </div>
            <div class="z-depth-2 card material-table" style="margin-top: -10px;">
                <div id="addTime" style="display:none; background-color: rgba(10, 193, 232, 0.12); display: none; margin-top: 0;">
                    <div class="row">
                        <div class="input-field col s2">
                            <label>Add Time:</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="sTime" type="text" required="" aria-required="true" class="validate" pattern= "([01]?[0-9]|2[0-3]):[0-5][0-9]">
                            <label for="sTime" data-error = "24 Hrs Format">Start Time</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="eTime" type="text" class="validate" required="" aria-required="true" class="validate" pattern= "([01]?[0-9]|2[0-3]):[0-5][0-9]">
                            <label for="eTime" data-error = "24 Hrs Format">End Time</label>
                        </div>
                        <div class="input-field col s3">
                            <a class="light-green waves-light btn" style="text-align: center; color: #000000">Save</a>
                        </div>
                    </div>
                </div>

                <form class="cmxform" id="selectTime" method="get" autocomplete="off" style="margin-top: -10px; margin-bottom: 0;">
                    <div class="row">
                        <table id="datatable1" style="width: 100% !important; table-layout: fixed">
                            <thead>
                            <tr>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>9:00 AM</td>
                                <td>11:00 AM</td>
                                <td>Reserved</td>
                                <td><button class="light-green waves-light btn" style="cursor: not-allowed; color: #000000" disabled>Select</button></td>
                            </tr>
                            <tr>
                                <td>11:00 AM</td>
                                <td>1:00 PM</td>
                                <td>Available</td>
                                <td><button class="light-green waves-light btn" style="color: #000000">Select</button></td>
                            </tr>
                            <tr>
                                <td>1:00 PM</td>
                                <td>3:00 PM</td>
                                <td>Reserved</td>
                                <td><button class="light-green waves-light btn" style="cursor: not-allowed; color: #000000" disabled>Select</button></td>
                            </tr>
                            <tr>
                                <td>3:00 PM</td>
                                <td>5:00 PM</td>
                                <td>Available</td>
                                <td><button class="light-green waves-light btn" style="color: #000000">Select</button></td>
                            </tr>
                            <tr>
                                <td>5:00 PM</td>
                                <td>7:00 PM</td>
                                <td>Available</td>
                                <td><button class="light-green waves-light btn" style="color: #000000">Select</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Save</button>
            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
        </div>
    </div>

    <div class = "col s12" >
        <div class = "row">
            <div class = "col s5" style="margin-top: 20px;">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3" style="height: 500px; overflow: auto">
                        <div class="header" style="background-color: #00897b; margin-top: -15px;">
                            <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Service Purchases</h4></center>
                        </div>
                        <div class="row" style="margin-top: -15px;">
                            <div class="input-field col s8">
                                <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                                <label for="cname" data-error="No Existing Customer Found!">Customer Name<span style = "color: red;">*</span></label>
                            </div>
                            <datalist id="nameList">
                                <option value="Monkey D. Luffy">
                                <option value="Roronoa Zoro">
                                <option value="Vinsmoke Sanji">
                                <option value="Tony Tony Chopper">
                                <option value="Nico Robin">
                            </datalist>

                            <div class="col s3">
                                <a data-target="newCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer"
                                   href="#newCustomer" style="color: #000000; margin-top: 15px; margin-left: -15px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -30px">
                            <div class="input-field col s6">
                                <select>
                                    <option value="" disabled selected>Service/Package</option>
                                    <option value="1">Service</option>
                                    <option value="2">Package</option>
                                </select>
                                <label>Avail Options</label>
                            </div>
                            <div class="input-field col s6">
                                <select multiple>
                                    <option value="" disabled selected>List of Service/s and Package/s</option>
                                    <option value="1">Cremation</option>
                                    <option value="2">Interment</option>
                                    <option value="3">Exhumation</option>
                                </select>
                                <label>Select Package/Service</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -45px;">
                            <div class="input-field col s12">
                                <textarea id="textarea1" class="materialize-textarea"></textarea>
                                <label for="textarea1">Remarks</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -30px;">
                            <div class="input-field col s3">
                                <i>Total Amount:</i><br>
                            </div>
                            <div class="input-field col s4">
                                <i>P54,000.00</i><br>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -20px;">
                            <div class="input-field col s3">
                                <label for="amountPaid">Amount Paid:</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="amountPaid" type="text" required="" aria-required="true" class="validate" >
                            </div>
                        </div>
                        <div class="right submit" style="margin-right: 15px; margin-top: -20px;">
                            <button name = "action" class="waves-light btn light-green" style="color: #000000; margin-top: 0px;">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class = "col s7" style="margin-top: 20px;">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3" style="height: 500px; overflow: hidden">
                        <div class="header" style="background-color: #00897b; margin-top:-15px;">
                            <center><h4 style = "font-size: 20px; font-family: myFirstFont; color: white; padding: 20px;">Purchase Details</h4></center>
                        </div>
                        <div class="row" style="margin-top: 0px;">
                            <div class="input-field col s1">
                                <i>Date:</i><br>
                            </div>
                            <div class="input-field col s4">
                                <i>03/07/16</i><br>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -13px;">
                            <div class="input-field col s3">
                                <i>Customer Name:</i><br>
                            </div>
                            <div class="input-field col s4" style="margin-left: -50px;">
                                <i>Aaron Clyde Garil</i><br>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -13px;">
                            <div class="input-field col s3">
                                <i>Package Avail:</i><br>
                            </div>
                            <div class="input-field col s9" style="margin-left: -50px;">
                                <i>Cremation, Interment, Exhumation</i><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card material-table">
                                <table id="datatable" style="color: black; background-color: white; border: 2px solid white;">
                                    <thead>
                                    <tr>
                                        <th>Service Name</th>
                                        <th>Requirements</th>
                                        <th>Schedule</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Cremation</td>
                                        <td><a class="waves-light btn light-green modal-trigger" style="width: 70%; color: #000000" data-target="requirements" href="#requirements">view</a></td>
                                        <td>07/03/16 12:00 pm</td>
                                        <td><a class="waves-light btn light-green modal-trigger" style="width: 70%; color: #000000" data-target="schedule" href="#schedule">Schedule</a></td>
                                    </tr>
                                        <td>Interment</td>
                                    <td><a class="waves-light btn light-green modal-trigger" style="width: 70%; color: #000000" data-target="requirements" href="#requirements">view</a></td>
                                        <td>N/a</td>
                                        <td><a class="waves-light btn light-green modal-trigger" style="width: 70%; color: #000000" data-target="schedule" href="#schedule">Schedule</a></td>
                                    </tr>
                                    </tr>
                                        <td>Exhumation</td>
                                    <td><a class="waves-light btn light-green modal-trigger" style="width: 70%; color: #000000" data-target="requirements" href="#requirements">view</a></td>
                                        <td>N/a</td>
                                        <td><a class="waves-light btn light-green modal-trigger" style="width: 70%; color: #000000" data-target="schedule" href="#schedule">Schedule</a></td>
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

        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
    <script>
        $("input[name='test']").click(function () {
            $('#addServiceForm').css('display', ($(this).val() === 'addService') ? 'block':'none');
            $('#addPackageForm').css('display', ($(this).val() === 'addPackage') ? 'block':'none');
        });
    </script>




@endsection