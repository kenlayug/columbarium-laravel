@extends('v2.baseLayout')
@section('title', 'Additional Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/schedule/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.schedule'>

<!-- Schedules -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Status Types</option>
            <option value="1">Scheduled</option>
            <option value="2">Rescheduled</option>
            <option value="3">Finished</option>
            <option value="3">Ongoing</option>
            <option value="3">Canceled</option>
          </select>
          <label>Schedule Status</label>
        </div>
        <div class="row">
          <select ng-model='filter.intServiceCategoryId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Services</option>
            <option ng-repeat='service in serviceList' value="@{{ service.intServiceCategoryId }}">@{{ service.strServiceCategoryName }}</option>
          </select>
          <label style="margin-top: 80px;">Service Name</label>
        </div>
        <div class='row'>
          <i class="material-icons prefix">today</i>
          <input ng-model='filter.dateSchedule' id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
          <label style='margin-top: 160px ' for="dateOfBirth">Schedule Date<span style = "color: red;">*</span></label>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont2; padding-left: 35%;">Schedules Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatable">
            <thead>
              <tr>
                <th>Transaction Code</th>
                <th>Customer Name</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>T314</td>
                <td>Pig, Peppa</td>
                <td>Cremation</td>
                <td>09/09/09</td>
                <td>12:30 - 2:30 PM</td>
              </tr>
              <tr>
                <td>T425</td>
                <td>Pig, George</td>
                <td>Installation</td>
                <td>05/02/01</td>
                <td>10:30 - 12:30 PM</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Schedules -->

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