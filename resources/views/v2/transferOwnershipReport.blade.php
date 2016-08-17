@extends('v2.baseLayout')
@section('title', 'Transfer Ownership Report')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/report.js') !!}"></script>

    <div class ="row">
        <div class = "col s12 m6 l8" style = "margin-top: 20px; margin-left: 250px;">
            <div class = "aside aside z-depth-3" style = "height: 150px;">
                <div class = "createHeader" style = "background-color: #00897b; height: 50px;"></div>
                <div class = "row">
                    <div  style = "margin-top: 10px;">
                        <div class="input-field col s4" style = "margin-top: 10px;">
                            <select>
                                <option value="" disabled selected>Frequency</option>
                                <option value="1">Daily</option>
                                <option value="2">Weekly</option>
                                <option value="3">Monthly</option>
                                <option value="4">Yearly</option>
                            </select>
                            <label>Frequency</label>
                        </div>

                        <div class="dateOfBirth input-field col s4" style = "padding-left: 25px; margin-top: 10px;">
                            <i class="material-icons prefix">today</i>
                            <input id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                            <label for="dateOfBirth">To<span style = "color: red;">*</span></label>
                        </div>
                        <div class="dateOfBirth input-field col s4" style = "padding-left: 25px; margin-top: 10px;">
                            <i class="material-icons prefix">today</i>
                            <input id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                            <label for="dateOfBirth">From<span style = "color: red;">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Transfer Ownership Report -->
    <div class = "row">
        <div class = "col s12 m6 l12">
            <div class = "serviceDataGrid">
                <div class="row">
                    <div id="admin">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style = "background-color: #00897b; height: 55px;">
                                <h4 class = "dataGridH4" style = "color: white; font-family: fontSketch; font-size: 2.3vw">Transfer Ownership Report</h4>
                                <div class="actions">
                                    <button name = "action" class="btn tooltipped modal-trigger light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Print Report" style = "color: black; margin-right: 10px;" href = "#modalArchiveService">PRINT</button>
                                    <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatableServicesReport">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Customer Name</th>
                                    <th>Unit Code</th>
                                    <th>New Customer Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
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
            format: 'dd/mm/yyyy'
        });
    </script>


@endsection