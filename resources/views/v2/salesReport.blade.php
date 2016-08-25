@extends('v2.baseLayout')
@section('title', 'Sales Report')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/report.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/report/sales/controller.js') !!}"></script>

<di ng-controller='ctrl.report.sales'>
    <div class ="row">
        <div class = "col s12 m6 l8" style = "margin-top: 20px; margin-left: 250px;">
            <div class = "aside aside z-depth-3" style = "height: 150px;">
                <div class = "createHeader" style = "background-color: #00897b; height: 50px;"></div>
                <div class = "row">
                    <div  style = "margin-top: 10px;">
                        <div class="input-field col s3" style = "margin-top: 10px;">
                            <select ng-change='changeFrequency()' ng-model='frequency'>
                                <option value="" disabled selected>For the last</option>
                                <option value="1">Day</option>
                                <option value="2">Week</option>
                                <option value="3">Month</option>
                                <option value="4">Year</option>
                            </select>
                            <label>For the last:</label>
                        </div>

                        <div class="dateOfBirth input-field col s3" style = "padding-left: 25px; margin-top: 10px;">
                            <i class="material-icons prefix">today</i>
                            <input ng-change='changeReportRange()' ng-model='reports.dateFrom' id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                            <label for="dateOfBirth">From<span style = "color: red;">*</span></label>
                        </div>
                        <div class="dateOfBirth input-field col s3" style = "padding-left: 25px; margin-top: 10px;">
                            <i class="material-icons prefix">today</i>
                            <input ng-change='changeReportRange()' ng-model='reports.dateTo' id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                            <label for="dateOfBirth">To<span style = "color: red;">*</span></label>
                        </div>
                        <div class='input-field col s3'>
                            <input ng-change='changeReportRange()' ng-model='reports.intTransactionId' id='searchBar' type='text'/>
                            <label for='searchBar'>Transaction Code</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Sales Report -->
    <div class = "row">
        <div class = "col s12 m6 l12">
            <div class = "serviceDataGrid">
                <div class="row">
                    <div id="admin">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Sales Report</h4>
                                <div class="actions">
                                    <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; width: 100px; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                    <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatableSalesReport" datatable='ng'>
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Customer Name</th>
                                    <th>Transaction Code</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat='transaction in transactionList'>
                                    <td>@{{ transaction.created_at | amDateFormat : 'MM/DD/YYYY' }}</td>
                                    <td><span title="@{{ transaction.strLastName+', '+transaction.strFirstName+' '+transaction.strMiddleName }}">@{{ transaction.strLastName+', '+transaction.strFirstName+' '+transaction.strMiddleName }}</span></td>
                                    <td>Trans. Id @{{ transaction.intTransactionPurchaseId }}</td>
                                    <td>
                                        <span ng-if='transaction.intTPurchaseDetailType == 1'>Additionals</span>
                                        <span ng-if='transaction.intTPurchaseDetailType == 2'>Services</span>
                                        <span ng-if='transaction.intTPurchaseDetailType == 3'>Packages</span>
                                    </td>
                                    <td>
                                        <span title='@{{ transaction.strAdditionalName }}' ng-if='transaction.intTPurchaseDetailType == 1'>@{{ transaction.strAdditionalName }}</span>
                                        <span title='@{{ transaction.strServiceName }}' ng-if='transaction.intTPurchaseDetailType == 2'>@{{ transaction.strServiceName }}</span>
                                        <span title='@{{ transaction.strPackageName }}' ng-if='transaction.intTPurchaseDetailType == 3'>@{{ transaction.strPackageName }}</span>
                                    </td>
                                    <td>
                                        <span ng-if='transaction.intTPurchaseDetailType == 1'>@{{ transaction.additionalPrice | currency : 'P' }}</span>
                                        <span ng-if='transaction.intTPurchaseDetailType == 2'>@{{ transaction.servicePrice | currency : 'P' }}</span>
                                        <span ng-if='transaction.intTPurchaseDetailType == 3'>@{{ transaction.packagePrice | currency : 'P' }}</span>
                                    </td>
                                    <td>@{{ transaction.intQuantity }}</td>
                                    <td>
                                        <span ng-if='transaction.intTPurchaseDetailType == 1'>@{{ transaction.additionalPrice * transaction.intQuantity | currency : 'P' }}</span>
                                        <span ng-if='transaction.intTPurchaseDetailType == 2'>@{{ transaction.servicePrice * transaction.intQuantity | currency : 'P' }}</span>
                                        <span ng-if='transaction.intTPurchaseDetailType == 3'>@{{ transaction.packagePrice * transaction.intQuantity | currency : 'P' }}</span>
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
    <div class='row'>
        <div class='col s6 offset-s6'>
            <h3>Total Sales : @{{ grandTotalSales | currency : 'P' }}</h3>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('select').material_select();
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