@extends('v2.baseLayout')
@section('title', 'Unit Purchases Report')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/highcharts.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/exporting.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/unitPurchaseReport.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/report/unit-purchase/controller.js') !!}"></script>

<div ng-controller='ctrl.report.unit-purchase'>

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
                                        <input ng-change='changeFilter()' ng-model='filter.dateFrom' id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                                        <label for="dateOfBirth">To<span style = "color: red;">*</span></label>
                                    </div>
                                    <div class="dateOfBirth input-field col s4" style = "padding-left: 25px; margin-top: 10px;">
                                        <i class="material-icons prefix">today</i>
                                        <input ng-change='changeFilter()' ng-model='filter.dateTo' id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                                        <label for="dateOfBirth">From<span style = "color: red;">*</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Unit Report -->
                <div class = "row">
                    <div class = "col s12 m6 l12" id = "hiddenUnitReport">
                        <div class = "serviceDataGrid">
                            <div class="row">
                                <div id="admin">
                                    <div class="z-depth-2 card material-table">
                                        <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                            <h4 class = "dataGridH4" style = "color: white; font-family: roboto3; font-size: 2.3vw">Unit Purchases Report</h4>
                                            <div class="actions">
                                                <button ng-click="printTabular()" name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "margin-right: 10px;" href = "#modalArchiveService"><i class="material-icons" style = "color: black;">print</i></button>
                                                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                            </div>
                                        </div>
                                        <table datatable='ng'>
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Customer Name</th>
                                                <th>Transaction Id</th>
                                                <th>Purchase Type</th>
                                                <th>Unit Type</th>
                                                <th>Unit Id</th>
                                                <th>Unit Price</th>
                                                <th>Amount Received</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat='unitPurchaseReport in unitPurchaseReportList'>
                                                <td>@{{ unitPurchaseReport.created_at | amDateFormat : 'MM/DD/YYYY' }}</td>
                                                <td>@{{ unitPurchaseReport.strLastName+', '+unitPurchaseReport.strFirstName+' '+unitPurchaseReport.strMiddleName }}</td>
                                                <td>@{{ unitPurchaseReport.intTransactionUnitId }}</td>
                                                <td>@{{ unitPurchaseReport.strTransactionType }}</td>
                                                <td tooltipped data-tooltip="@{{ unitPurchaseReport.strUnitTypeName }}" data-position="bottom" data-delay="50">@{{ unitPurchaseReport.strUnitTypeName }}</td>
                                                <td>@{{ unitPurchaseReport.intUnitId }}</td>
                                                <td>@{{ unitPurchaseReport.deciPrice | currency : 'P'}}</td>
                                                <td>@{{ unitPurchaseReport.deciAmount | currency : 'P' }}</td>
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
                        <select ng-model='statisticType' ng-change='changeStatisticalChart(statisticType, filter.dateAsOf)'>
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
                        <input ng-change='changeStatisticalChart(statisticType)' ng-model="filter.dateAsOf" id="asOf" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                        <label for="asOf">As of:<span style = "color: red;">*</span></label>
                    </div>
                </div>

                <div class = "row" ng-show="statisticType != null">
                    <div class = "teal col s12 m6 l12" id = "hiddenWeeklyStatistics" style = "margin-bottom: 25px; margin-top: -20px; height: 420px;">
                        <div id="stackedWeeklyStatisticalGraph" style="min-width: 96.5%; height: 400px; padding-top: 20px;"></div>
                    </div>
                </div>
            </div>

            <!-- Growth Rate -->
            <div id="growthRate" class="col s12">
                <div class = "row" style = "margin-top: 20px; margin-left: 500px;">
                    <div class="input-field col s3" style = "margin-top: 10px;">
                        <select ng-model="growthRateType" ng-change="changeGrowthRate(growthRateType)">
                            <option disabled selected>Choose option from:</option>
                            <option value="1">Monthly</option>
                            <option value="2">Quarterly</option>
                            <option value="3">Yearly</option>
                        </select>
                        <label>Growth Rate:</label>
                    </div>

                </div>

                <div ng-show="growthRateType != null" id = "hiddenMonthlyGrowth" class = "teal" style = "margin-bottom: 25px; margin-top: -20px; height: 420px; width: 940px; margin-left: 230px;">
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
                                                <td>Spotcash</td>
                                                <td ng-bind="prevReportList.payOnce"></td>
                                                <td ng-bind="currentReportList.payOnce"></td>
                                                <td ng-bind="prevReportList.payOnce - currentReportList.payOnce"></td>
                                                <td>
                                                    <span ng-if="growthRate.payOnce != 0" ng-bind="growthRate.payOnce+'%'"></span>
                                                    <span ng-if="growthRate.payOnce == 0">N/A</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Reservation</td>
                                                <td ng-bind="prevReportList.reservation"></td>
                                                <td ng-bind="currentReportList.reservation"></td>
                                                <td ng-bind="prevReportList.reservation - currentReportList.reservation"></td>
                                                <td>
                                                    <span ng-if="growthRate.reservation != 0" ng-bind="growthRate.reservation+'%'"></span>
                                                    <span ng-if="growthRate.reservation == 0">N/A</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>At Need</td>
                                                <td ng-bind="prevReportList.atNeed"></td>
                                                <td ng-bind="currentReportList.atNeed"></td>
                                                <td ng-bind="prevReportList.atNeed - currentReportList.atNeed"></td>
                                                <td>
                                                    <span ng-if="growthRate.atNeed != 0" ng-bind="growthRate.atNeed+'%'"></span>
                                                    <span ng-if="growthRate.atNeed == 0">N/A</span>
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