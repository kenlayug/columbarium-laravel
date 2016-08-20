@extends('v2.baseLayout')
@section('title', 'Additional Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.queries'>

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
          <label>Unit Status</label>
        </div>
        <div class="row">
          <select material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Services</option>
            <option value="1">Cremation</option>
            <option value="2">Exhumation</option>
          </select>
          <label style="margin-top: 80px;">Service Name</label>
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
                <th>Date</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>T314</td>
                <td>Pig, Peppa</td>
                <td>09/09/09</td>
                <td>12:30 - 2:30 PM</td>
              </tr>
              <tr>
                <td>T425</td>
                <td>Pig, George</td>
                <td>05/02/01</td>
                <td>10:30 - 12:30 PM</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Schedules -->

</div>
@endsection