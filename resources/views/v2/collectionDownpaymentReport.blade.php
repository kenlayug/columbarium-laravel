@extends('v2.baseLayout')
@section('title', 'Collection Downpayment Report')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/collectionDownpaymentReport.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/highcharts.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/exporting.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/report.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/report/collection/controller.js') !!}"></script>
<div ng-controller="ctrl.report.collection">

    <div class="row z-depth-3" style = "width: 1320px; margin-top: 30px;">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s4"><a href="#tabular">Tabular</a></li>
                <li class="tab col s4"><a href="#statistical">Statistical</a></li>
                <li class="tab col s4"><a href="#growthRate">Growth Rate</a></li>
            </ul>
        </div>

        <!-- Tabular -->
        <div id="tabular" class="col s12">
            <div class ="row">
                <div class = "col s12 m6 l8" style = "margin-top: 20px; margin-left: 250px;">
                    <div class = "aside aside z-depth-3" style = "height: 140px;">
                        <div class = "createHeader" style = "background-color: #00897b; height: 40px;"></div>
                        <div class = "row">
                            <div  style = "margin-top: 10px;">
                                <!-- <div class="input-field col s4" style = "margin-top: 10px;">
                                    <select>
                                        <option value="" disabled selected>For the last:</option>
                                        <option value="1">Daily</option>
                                        <option value="2">Weekly</option>
                                        <option value="3">Monthly</option>
                                        <option value="4">Yearly</option>
                                    </select>
                                    <label>For the last:</label>
                                </div> -->

                                <div class="dateOfBirth input-field col s4" style = "padding-left: 25px; margin-top: 10px;">
                                    <i class="material-icons prefix">today</i>
                                    <input ng-change="changeReport()" ng-model="filter.dateFrom" id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                                    <label for="dateOfBirth">To<span style = "color: red;">*</span></label>
                                </div>
                                <div class="dateOfBirth input-field col s4" style = "padding-left: 25px; margin-top: 10px;">
                                    <i class="material-icons prefix">today</i>
                                    <input ng-change="changeReport()" ng-model="filter.dateTo" id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                                    <label for="dateOfBirth">From<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Collection Report -->
            <div class = "row">
                <div class = "col s12 m6 l12" id = "hiddenCollectionReport">
                    <div class = "serviceDataGrid">
                        <div class="row">
                            <div id="admin">
                                <div class="z-depth-2 card material-table">
                                    <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                        <h4 class = "dataGridH4" style = "color: white; font-family: roboto3; font-size: 2.3vw">Collections Report</h4>
                                        <div class="actions">
                                            <button ng-click="generatePdf()" name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "margin-right: 10px;" href = "#modalArchiveService"><i class="material-icons" style = "color: black;">print</i></button>
                                            <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                        </div>
                                    </div>
                                    <table datatable="ng">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Category</th>
                                            <th>Unit Type</th>
                                            <th>Unit Code</th>
                                            <th>Unit Price</th>
                                            <th>Amount Paid</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="report in reportList">
                                            <td ng-bind="report.dateTransaction | amDateFormat : 'MMMM D, YYYY'"></td>
                                            <td ng-bind="report.strCustomerName"></td>
                                            <td ng-bind="reportCategory[report.intCategory]"></td>
                                            <td ng-bind="report.strUnitType"></td>
                                            <td ng-bind="report.intUnitId"></td>
                                            <td ng-bind="report.deciPrice | currency : 'P'"></td>
                                            <td ng-bind="report.deciAmountPaid | currency : 'P'"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class= "row">
                <div class='col s6 offset-s6'>
                    <h3 class = "flow-text right" style = "font-family: roboto3;">Total Sales : @{{ deciTotalSales | currency : 'P' }}</h3>
                </div>
            </div>
        </div>

        <!-- Statistical -->
        <div id="statistical" class="col s12">
            <div class = "row" style = "margin-top: 20px; margin-left: 90px;">
                <div class="input-field col s3" style = "margin-top: 10px;">
                    <select ng-model="statistic" ng-change="changeStatistics(statistic)">
                        <option value="" disabled selected>Choose option from:</option>
                        <option value="1">Weekly</option>
                        <option value="2">Monthly</option>
                        <option value="3">Quarterly</option>
                        <option value="4">Yearly</option>
                    </select>
                    <label>From:</label>
                </div>
                <div class="input-field col s3">
                    <i class="material-icons prefix">perm_contact_calendar</i>
                    <input ng-model="filter.dateAsOf" ng-change="changeStatistics(statistic)" id="asOf" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                    <label for="asOf">As of:<span style = "color: red;">*</span></label>
                </div>
            </div>

            <div class = "row" ng-show="statistic != null" style = "margin-left: 100px;">
                <div class = "teal darken-1 col s12 m6 l11" id = "hiddenWeeklyStatistics" style = "margin-bottom: 25px; margin-top: -20px; height: 370px;">
                    <div id="stackedWeeklyStatisticalGraph" style="min-width: 79%; height: 350px; padding-top: 20px;"></div>
                </div>
            </div>
        </div>

        <!-- Growth Rate -->
        <div id="growthRate" class="col s12">
            <div class = "row" style = "margin-top: 20px; margin-left: 500px;">
                <div class="input-field col s3" style = "margin-top: 10px;">
                    <select ng-model="growthRateType" ng-change="changeGrowthRate(growthRateType)">
                        <option value="" disabled selected>Choose option from:</option>
                        <option value="1">Monthly</option>
                        <option value="2">Quarterly</option>
                        <option value="3">Yearly</option>
                    </select>
                    <label>Growth Rate:</label>
                </div>
            </div>

            <div ng-show="growthRateType" id = "hiddenMonthlyGrowth" class = "teal" style = "margin-bottom: 25px; margin-top: -20px; height: 420px; width: 940px; margin-left: 230px;">
                <div id="monthlyGrowthRate" style="min-width: 900px; height: 400px; margin-top: 30px; padding-top: 20px; margin-left: 20px;"></div>
            </div>


            <!-- Growth Rate Record -->
            <div class = "row">
                <div class = "col s12 m6 l12">
                    <div class = "serviceDataGrid">
                        <div class="row">
                            <div id="admin">
                                <div class="z-depth-2 card material-table">
                                    <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                        <h4 class = "dataGridH4" style = "color: white; font-family: roboto3; font-size: 2.3vw">Growth Rate Record</h4>
                                        <div class="actions">
                                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "margin-right: 10px;" href = "#modalArchiveService"><i class="material-icons" style = "color: black;">print</i></button>
                                            <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                        </div>
                                    </div>
                                    <table id="datatableGrowthRate">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Previous Month Sales</th>
                                            <th>Current Month Sales</th>
                                            <th>Difference</th>
                                            <th>Growth Rate</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Collections</td>
                                            <td ng-bind="prevReportList.collections | currency : 'P'"></td>
                                            <td ng-bind="currentReportList.collections | currency : 'P'"></td>
                                            <td ng-bind="currentReportList.collections - prevReportList.collections | currency : 'P'"></td>
                                            <td>
                                                <span ng-if="prevReportList.collections == 0">N/A</span>
                                                <span ng-if="prevReportList.collections != 0" ng-bind="growthRate.collections+'%'"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Downpayments</td>
                                            <td ng-bind="prevReportList.downpayments | currency : 'P'"></td>
                                            <td ng-bind="currentReportList.downpayments | currency : 'P'"></td>
                                            <td ng-bind="currentReportList.downpayments - prevReportList.downpayments | currency : 'P'"></td>
                                            <td>
                                                <span ng-if="prevReportList.downpayments == 0">N/A</span>
                                                <span ng-if="prevReportList.downpayments != 0" ng-bind="growthRate.downpayments+'%'"></span>
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
            $('#datatableSalesReport').dataTable({
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

        $(document).ready(function() {
            $('#datatableGrowthRate').dataTable({
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

    <script type="text/javascript">
        function showGrowthRate(elem){
            if(elem.value == 0)
                document.getElementById('hiddenMonthlyGrowth').style.display = "block";
            if(elem.value == 0)
                document.getElementById('hiddenQuarterlyGrowth').style.display = "none";
            if(elem.value == 0)
                document.getElementById('hiddenYearlyGrowth').style.display = "none";
            if(elem.value == 1)
                document.getElementById('hiddenMonthlyGrowth').style.display = "none";
            if(elem.value == 1)
                document.getElementById('hiddenQuarterlyGrowth').style.display = "block";
            if(elem.value == 1)
                document.getElementById('hiddenYearlyGrowth').style.display = "none";
            if(elem.value == 2)
                document.getElementById('hiddenMonthlyGrowth').style.display = "none";
            if(elem.value == 2)
                document.getElementById('hiddenQuarterlyGrowth').style.display = "none";
            if(elem.value == 2)
                document.getElementById('hiddenYearlyGrowth').style.display = "block";
        }
    </script>
    <script type="text/javascript">
        function showStatistics(elem){
            if(elem.value == 0)
                document.getElementById('hiddenMonthlyStatistics').style.display = "none";
            if(elem.value == 0)
                document.getElementById('hiddenWeeklyStatistics').style.display = "block";
            if(elem.value == 1)
                document.getElementById('hiddenMonthlyStatistics').style.display = "block";
            if(elem.value == 1)
                document.getElementById('hiddenWeeklyStatistics').style.display = "none";
        }
    </script>
    <script type="text/javascript">
        function showDiv(elem){
            if(elem.value == 0)
                document.getElementById('hiddenLineChart').style.display = "block";
            if(elem.value == 0)
                document.getElementById('hiddenBarChart').style.display = "none";
            if(elem.value == 1)
                document.getElementById('hiddenLineChart').style.display = "none";
            if(elem.value == 1)
                document.getElementById('hiddenBarChart').style.display = "block";
        }
    </script>


    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
        $(document).ready(function(){
            $('ul.tabs').tabs();
        });
    </script>

    <script>
        $('.datepicker').pickadate({
            selectMonths: true,//Creates a dropdown to control month
            selectYears: 15,//Creates a dropdown of 15 years to control year
//The title label to use for the month nav buttons
            labelMonthNext: 'Next Month',
            labelMonthPrev: 'Last Month',
//The title label to use for the dropdown selectors
            labelMonthSelect: 'Select Month',
            labelYearSelect: 'Select Year',
//Months and weekdays
            monthsFull: [ 'January', 'February', 'March', 'April', 'March', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
            monthsShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mar', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
            weekdaysFull: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ],
            weekdaysShort: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ],
//Materialize modified
            weekdaysLetter: [ 'S', 'M', 'T', 'W', 'T', 'F', 'S' ],
//Today and clear
            today: 'Today',
            clear: 'Clear',
            close: 'Close',
//The format to show on the `input` element
            format: 'mm/dd/yyyy'
        });
    </script>

</div>
@endsection