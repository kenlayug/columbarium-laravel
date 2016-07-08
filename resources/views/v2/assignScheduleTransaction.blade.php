@extends('v2.baseLayout')
@section('title', 'Assign Schedule')
@section('body')

    <div id="scheduleService" class="modal modal-fixed" style="width:75% !important; max-height: 100% !important;">
        <div class="modal-header">
            <center><h4 style = "font-size: 20px; font-family: myFirstFont2; color: white; padding-top: 20px;">Assign Schedule</h4></center>
            <button class="add-toggle light-green nopadding btn tooltipped" data-delay="50" data-tooltip="Add New Time"
                    style = "margin-left: 880px; margin-top: -105px; color: #000000"><i class="material-icons" style="color: #000000">add</i> Time</button>
        </div>
        <div class="modal-content">
            <div class="z-depth-2 card material-table">

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
                        <table id="datatable3" style="width: 100% !important; table-layout: fixed">
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

    <div id="sched" class="modal modal-fixed" style="width:75% !important; max-height: 100% !important;">
        <div id="admin" class="col s12">
            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                <div class="table-header" style="background-color: #00897b;">
                    <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Transactions: Aaron Clyde Garil</h4>
                    <div class="actions">
                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                    </div>
                </div>
                <table id="datatable2">
                    <thead>
                    <tr>
                        <th>Service/s</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>C001</td>
                        <td><button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style="color: #000000">Schedule</button>
                            <button class="waves-light btn light-green" style="color: #000000">Remove</button></td>
                    </tr>
                    <tr>
                        <td>C002</td>
                        <td><button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style="color: #000000">Schedule</button>
                            <button class="waves-light btn light-green" style="color: #000000">Remove</button></td>
                    </tr>
                    <tr>
                        <td>C003</td>
                        <td><button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style="color: #000000">Schedule</button>
                            <button class="waves-light btn light-green" style="color: #000000">Remove</button></td>
                    </tr>
                    <tr>
                        <td>C004</td>
                        <td><button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style="color: #000000">Schedule</button>
                            <button class="waves-light btn light-green" style="color: #000000">Remove</button></td>
                    </tr>
                    <tr>
                        <td>C005</td>
                        <td><button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style="color: #000000">Schedule</button>
                            <button class="waves-light btn light-green" style="color: #000000">Remove</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="reSched" class="modal modal-fixed" style="width:75% !important; max-height: 100% !important;">
        <div id="admin" class="col s12">
            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                <div class="table-header" style="background-color: #00897b;">
                    <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Transactions: Aaron Clyde Garil</h4>
                    <div class="actions">
                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                    </div>
                </div>
                <table id="datatable4">
                    <thead>
                    <tr>
                        <th>Service/s</th>
                        <th>Schedule</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>C001</td>
                        <td>C001</td>
                        <td><button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style="color: #000000">Reschedule</button>
                            <button class="waves-light btn light-green" style="color: #000000">Cancel</button></td>
                    </tr>
                    <tr>
                        <td>C002</td>
                        <td>C002</td>
                        <td><button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style="color: #000000">Reschedule</button>
                            <button class="waves-light btn light-green" style="color: #000000">Cancel</button></td>
                    </tr>
                    <tr>
                        <td>C003</td>
                        <td>C003</td>
                        <td><button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style="color: #000000">Reschedule</button>
                            <button class="waves-light btn light-green" style="color: #000000">Cancel</button></td>
                    </tr>
                    <tr>
                        <td>C004</td>
                        <td>C004</td>
                        <td><button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style="color: #000000">Reschedule</button>
                            <button class="waves-light btn light-green" style="color: #000000">Cancel</button></td>
                    </tr>
                    <tr>
                        <td>C005</td>
                        <td>C005</td>
                        <td><button data-target="scheduleService" class="waves-light btn light-green modal-trigger" href="#scheduleService" style="color: #000000">Reschedule</button>
                            <button class="waves-light btn light-green" style="color: #000000">Cancel</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class = "col s12" >
        <h4 style = "margin-top: 20px; margin-left: 25px; font-family: myFirstFont2">Assign Schedule</h4>
        <div class = "row">
            <div class = "col s6">
                <div class = "col s12">
                    <div class = "aside aside z-depth-3">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont">Unscheduled Services</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aaron Clyde Garil</td>
                                    <td><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#sched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>John Ezekiel Martinez</td>
                                    <td><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#sched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Aila Bianca Jacalne</td>
                                    <td><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#sched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Tiffany Banzuela</td>
                                    <td><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#sched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Alvin John Perez</td>
                                    <td><button data-target="sched" class="waves-light btn light-green modal-trigger" href="#schedn" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class = "col s12">
                    <div class = "aside aside z-depth-3">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont">Scheduled Services</h4>
                                <div class="actions">
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable1">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Aaron Clyde Garil</td>
                                    <td><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>John Ezekiel Martinez</td>
                                    <td><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Aila Bianca Jacalne</td>
                                    <td><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Tiffany Banzuela</td>
                                    <td><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                <tr>
                                    <td>Alvin John Perez</td>
                                    <td><button data-target="reSched" class="waves-light btn light-green modal-trigger" href="#reSched" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "col s6" style="margin-top: 20px;">

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
                $('#datatable4').dataTable({
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

@endsection