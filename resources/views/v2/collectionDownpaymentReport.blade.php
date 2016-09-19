@extends('v2.baseLayout')
@section('title', 'Collection Downpayment Report')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/collectionDownpaymentReport.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/highcharts.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/exporting.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
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
                                <div class="input-field col s4" style = "margin-top: 10px;">
                                    <select>
                                        <option value="" disabled selected>For the last:</option>
                                        <option value="1">Daily</option>
                                        <option value="2">Weekly</option>
                                        <option value="3">Monthly</option>
                                        <option value="4">Yearly</option>
                                    </select>
                                    <label>For the last:</label>
                                </div>

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
                                    <table id="datatableCollectionReport" datatable="ng">
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
                    <input id="asOf" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                    <label for="asOf">As of:<span style = "color: red;">*</span></label>
                </div>
            </div>

            <div class = "row" ng-show="statistic != null" style = "margin-left: 100px;">
                <div class = "teal darken-1 col s12 m6 l11" id = "hiddenWeeklyStatistics" style = "margin-bottom: 25px; margin-top: -20px; height: 370px;">
                    <div id="stackedWeeklyStatisticalGraph" style="min-width: 80%; height: 350px; padding-top: 20px;"></div>
                </div>
            </div>
        </div>

        <!-- Growth Rate -->
        <div id="growthRate" class="col s12">
            <div class = "row" style = "margin-top: 20px; margin-left: 500px;">
                <div class="input-field col s3" style = "margin-top: 10px;">
                    <select onchange = "showGrowthRate(this)">
                        <option value="" disabled selected>Choose option from:</option>
                        <option value="0">Monthly</option>
                        <option value="1">Quarterly</option>
                        <option value="2">Yearly</option>
                    </select>
                    <label>Growth Rate:</label>
                </div>

                <div class="input-field col s3" style = "margin-top: 10px;">
                    <select onchange = "showDiv(this)">
                        <option value="" disabled selected>Choose option from:</option>
                        <option value="0">Line Graph</option>
                        <option value="1">Bar Graph</option>
                    </select>
                    <label>Type of Graph:</label>
                </div>

            </div>

            <div id = "hiddenMonthlyGrowth" class = "teal" style = "display: none; margin-bottom: 25px; margin-top: -20px; height: 420px; width: 940px; margin-left: 230px;">
                <div id="monthlyGrowthRate" style="min-width: 900px; height: 400px; margin-top: 30px; padding-top: 20px; margin-left: 20px;"></div>
            </div>
            <div id = "hiddenQuarterlyGrowth" class = "teal" style = "display: none; margin-bottom: 25px; margin-top: -20px; height: 420px; width: 940px; margin-left: 230px;">
                <div id="quarterlyGrowthRate" style="min-width: 900px; height: 400px; margin-top: 30px; padding-top: 20px; margin-left: 20px;"></div>
            </div>
            <div id = "hiddenYearlyGrowth" class = "teal" style = "display: none; margin-bottom: 25px; margin-top: -20px; height: 420px; width: 940px; margin-left: 230px;">
                <div id="yearlyGrowthRate" style="min-width: 900px; height: 400px; margin-top: 30px; padding-top: 20px; margin-left: 20px;"></div>
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
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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