@extends('maintenanceLayout')
@section('title', 'Schedule Service')
@section('body')
<div class = "col s12" >
    <div class = "row">
        <div class = "col s5" style="margin-top: 20px;">
            <div class = "col s12">
                <div class = "aside aside z-depth-3" style="height: 450px; overflow: auto">
                    <div class="modal-header">
                        <label style="font-size: x-large; font-family: myFirstFont2;">Schedule Service</label>
                    </div>
                    <form action="scheduling.html" method="post">

                        <div id="time" class=" responsive modal">
                                <div id="admin1" class="col s12"    >
                                    <div class="z-depth-2 card material-table">
                                        <div class="table-header" style="background-color: #00897b;">
                                            <label style="font-size: large; color: #ffffff; font-family: myFirstFont2">Select Time</label>
                                            <button class="add-toggle btn-floating light-green nopadding" style = "margin-left: 510px;"><i class="material-icons" style="color: #000000">add</i></button>
                                        </div>

                                        <div id="addTime" style="display:none; background-color: rgba(10, 193, 232, 0.12); display: none; margin-top: 0;">
                                            <form class="modal-transfer"method="get" autocomplete="off">
                                                <div class="row">
                                                    <div class="input-field col s2">
                                                        <label>Add Time:</label>
                                                    </div>
                                                    <div class="input-field col s2">
                                                        <input id="sTime" type="text" required="" aria-required="true" class="validate" pattern= "([01]?[0-9]|2[0-3]):[0-5][0-9]">
                                                        <label for="sTime" data-error = "24 Hrs Format">Start Time</label>
                                                    </div>
                                                    <div class="input-field col s2">
                                                        <input id="eTime" type="text" class="validate" required="" aria-required="true" class="validate" pattern= "([01]?[0-9]|2[0-3]):[0-5][0-9]">
                                                        <label for="eTime" data-error = "24 Hrs Format">End Time</label>
                                                    </div>
                                                    <div id="h" class="input-field col s1" style="visibility: hidden">
                                                        <p>hidden</p>
                                                    </div>
                                                    <div class="input-field col s5">
                                                        <a class="light-green waves-light btn" style="text-align: center; color: #000000">Save</a>
                                                        <a class="light-green waves-light btn" style="text-align: center; color: #000000">Cancel</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <form class="cmxform" id="selectTime" method="get" autocomplete="off"   >
                                            <div class="row">
                                                <table id="datatable2" style="width: 100% !important; table-layout: fixed">
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
                        </div>
                        <div class="row">
                            <div class="input-field      col s6 ">
                                <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                                <label for="cname" data-error="No Existing Customer Found!">Customer Name<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s2">
                                <label>Services:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="checkbox" id="div1" name="colorCheckbox" value="d1"/>
                                <label for="div1">Cremation</label>
                                <div class="div1" style="display:none; background-color: rgba(10, 193, 232, 0.12); margin: 13px;">
                                    <div class="row">
                                        <div class="input-field col s3">
                                            <label>Date:</label>
                                        </div>
                                        <div class="input-field col s9">
                                            <input type="date" class="datepicker">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s7">
                                            <label>Schedule Time:</label>
                                        </div>
                                        <div class="input-field col s5">
                                            <input type="text" class="time"/>
                                        </div>
                                        <div class="input-field col s12">
                                            <a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100%; color: #000000;">Select Time</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <input type="checkbox" id="div2" name="colorCheckbox" value="d2"/>
                                <label for="div2">Internment</label>
                                <div class="div2" style="display:none; background-color: rgba(10, 193, 232, 0.12); margin: 13px;">
                                    <div class="row">
                                        <div class="input-field col s3">
                                            <label>Date:</label>
                                        </div>
                                        <div class="input-field col s9">
                                            <input type="date" class="datepicker">
                                        </div>
                                    </div>
                                        <div class="row">
                                        <div class="input-field col s7">
                                            <label>Schedule Time:</label>
                                        </div>
                                        <div class="input-field col s5">
                                            <input type="text" class="time"/>
                                        </div>
                                        <div class="input-field col s12">
                                            <a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100%; color: #000000">Select Time</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <input type="checkbox" id="div3" name="colorCheckbox" value="d3"/>
                                <label for="div3">Candle Installation</label>
                                <div class="div3" style="display:none; background-color: rgba(10, 193, 232, 0.12); margin: 13px;">
                                    <div class="row">
                                        <div class="input-field col s3">
                                            <label>Date:</label>
                                        </div>
                                        <div class="input-field col s9">
                                            <input type="date" class="datepicker">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s7">
                                            <label>Schedule Time:</label>
                                        </div>
                                        <div class="input-field col s5">
                                            <input type="text" class="time"/>
                                        </div>
                                        <div class="input-field col s12">
                                            <a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100%; color: #000000">Select Time</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <input type="checkbox" id="div4" name="colorCheckbox" value="d4"/>
                                <label for="div4">Transfer Deceased</label>
                                <div class="div4" style="display:none; background-color: rgba(10, 193, 232, 0.12); margin: 13px;">
                                    <div class="row">
                                        <div class="input-field col s3">
                                            <label>Date:</label>
                                        </div>
                                        <div class="input-field col s9">
                                            <input type="date" class="datepicker">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s7">
                                            <label>Schedule Time:</label>
                                        </div>
                                        <div class="input-field col s5">
                                            <input type="text" class="time"/>
                                        </div>
                                        <div class="input-field col s12">
                                            <a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100%; color: #000000">Select Time</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-field col s6">
                                <input type="checkbox" id="div5" name="colorCheckbox" value="d5"/>
                                <label for="div5">Transfer Ownership</label>
                                <div class="div5" style="display:none; background-color: rgba(10, 193, 232, 0.12); margin: 13px;">
                                    <div class="row">
                                        <div class="input-field col s3">
                                            <label>Date:</label>
                                        </div>
                                        <div class="input-field col s9">
                                            <input type="date" class="datepicker">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s7">
                                            <label>Schedule Time:</label>
                                        </div>
                                        <div class="input-field col s5">
                                            <input type="text" class="time"/>
                                        </div>
                                        <div class="input-field col s12">
                                            <a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100%; color: #000000">Select Time</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <input type="checkbox" id="div7" name="colorCheckbox" value="d7"/>
                                <label for="div7">Full Body Crypts</label>
                                <div class="div7" style="display:none; background-color: rgba(10, 193, 232, 0.12); margin: 13px;">
                                    <div class="row">
                                        <div class="input-field col s3">
                                            <label>Date:</label>
                                        </div>
                                        <div class="input-field col s9">
                                            <input type="date" class="datepicker">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s7">
                                            <label>Schedule Time:</label>
                                        </div>
                                        <div class="input-field col s5">
                                            <input type="text" class="time"/>
                                        </div>
                                        <div class="input-field col s12">
                                            <a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100%; color: #000000">Select Time</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <input type="checkbox" id="div8" name="colorCheckbox" value="d8"/>
                    
                            </div>
                        </div>
                        <br>
                        <div class="right modal-footer" style="margin-right: 20px">
                            <button name = "action" class="waves-light btn light-green" style = "margin-left: 10px; margin-right: 10px; color: #000000">Confirm</button>
                        </div>
                        <datalist id="nameList">
                            <option value="Monkey D. Luffy">
                            <option value="Roronoa Zoro">
                            <option value="Vinsmoke Sanji">
                            <option value="Tony Tony Chopper">
                            <option value="Nico Robin">
                        </datalist>
                    </form>
                </div>
            </div>
        </div>
        <div class = "col s7">
            <div class="row">
                <div id="admin" class="col s12" style="margin-top: 13px">
                    <div class="z-depth-2 card material-table">
                        <div class="table-header" style="background-color: #00897b;">
                            <span class="table-title" style="color:#ffffff; font-family: myFirstFont2">Schedule Table</span>
                            <div class="actions">
                                <i class="material-icons" style="color: white;">today</i><input type="date" class="datepicker">
                                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                            </div>
                        </div>
                        <table id="datatable">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Service</th>
                                <th>Time</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Service 1</td>
                                <td>P45,000</td>
                                <td>30</td>
                                <td><a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100px; color: #000000">RESCHEDULE</a></td>
                                <td><a class="waves-light btn light-green " style="width: 90%; color: #000000">CANCEL</a></td>
                            </tr>
                            <tr>
                                <td>Service 1</td>
                                <td>P45,000</td>
                                <td>30</td>
                                <td><a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100px; color: #000000">RESCHEDULE</a></td>
                                <td><a class="waves-light btn light-green " style="width: 90%; color: #000000">CANCEL</a></td>
                            </tr>
                            <tr>
                                <td>Service 1</td>
                                <td>P45,000</td>
                                <td>30</td>
                                <td><a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100px; color: #000000">RESCHEDULE</a></td>
                                <td><a class="waves-light btn light-green " style="width: 90%; color: #000000">CANCEL</a></td>
                            </tr>
                            <tr>
                                <td>Service 1</td>
                                <td>P45,000</td>
                                <td>30</td>
                                <td><a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100px; color: #000000">RESCHEDULE</a></td>
                                <td><a class="waves-light btn light-green " style="width: 90%; color: #000000">CANCEL</a></td>
                            </tr>
                            <tr>
                                <td>Service 1</td>
                                <td>P45,000</td>
                                <td>30</td>
                                <td><a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100px; color: #000000">RESCHEDULE</a></td>
                                <td><a class="waves-light btn light-green " style="width: 90%; color: #000000">CANCEL</a></td>
                            </tr>
                            <tr>
                                <td>Service 1</td>
                                <td>P45,000</td>
                                <td>30</td>
                                <td><a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100px; color: #000000">RESCHEDULE</a></td>
                                <td><a class="waves-light btn light-green " style="width: 90%; color: #000000">CANCEL</a></td>
                            </tr>
                            <tr>
                                <td>Service 1</td>
                                <td>P45,000</td>
                                <td>30</td>
                                <td><a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100px; color: #000000">RESCHEDULE</a></td>
                                <td><a class="waves-light btn light-green " style="width: 90%; color: #000000">CANCEL</a></td>
                            </tr>
                            <tr>
                                <td>Service 12311</td>
                                <td>P45,000</td>
                                <td>30</td>
                                <td><a class="waves-light btn light-green modal-trigger" href="#time" style="width: 100px; color: #000000">RESCHEDULE</a></td>
                                <td><a class="waves-light btn light-green " style="width: 90%; color: #000000">CANCEL</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>
            <script src='http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
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
            </script>
        </div>
    </div>
    <script>

        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal();
        });


        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
    <script>
        var today = new Date();
        var lastDate = new Date(today.getFullYear() +1, 11, 31);
        $( document ).ready(function() {
            $('.datepicker').pickadate({
                format: 'mm/dd/yyyy',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15, // Creates a dropdown of 15 years to control year
                minDate: 0
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[type="checkbox"]').click(function(){
                if($(this).attr("value")=="d1"){
                    $(".div1").toggle();
                }
                if($(this).attr("value")=="d2"){
                    $(".div2").toggle();
                }
                if($(this).attr("value")=="d3"){
                    $(".div3").toggle();
                }
                if($(this).attr("value")=="d4"){
                    $(".div4").toggle();
                }
                if($(this).attr("value")=="d5"){
                    $(".div5").toggle();
                }
                if($(this).attr("value")=="d6"){
                    $(".div6").toggle();
                }
                if($(this).attr("value")=="d7"){
                    $(".div7").toggle();
                }
                if($(this).attr("value")=="d8"){
                    $(".div8").toggle();
                }
                if($(this).attr("value")=="aR"){
                    $(".addRel").toggle();
                }
            });
        });
    </script>
</div>
@endsection