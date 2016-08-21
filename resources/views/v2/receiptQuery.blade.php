@extends('v2.baseLayout')
@section('title', 'Receipt Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/block/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.block'>


<!-- Receipt-->
  <div class="row">
    <div class="col s3" style="margin-top: 105px;">
      <div class="row">
        <select material-select watch>
          <option value="" disabled selected>Choose your filter</option>
          <option value="1">Day</option>
          <option value="2">Week</option>
          <option value="3">Month</option>
          <option value="4">Year</option>
        </select>
        <label style="margin-top: 170px;">For the last</label>
      </div>
      <div class="row">
        <select material-select watch>
          <option value="" disabled selected>Choose your filter</option>
          <option value="1">Unit Purchase</option>
          <option value="2">Collection & Downpayment</option>
          <option value="3">Manage Unit</option>
          <option value="4">Service Purchases</option>
          <option value="5">Assign Schedule</option>
        </select>
        <label style="margin-top: 250px;">Transaction Name</label>
      </div>
    </div>

    <div class="col s9">

      <div class="row">
        <div class="z-depth-1 input-field col s4 offset-s4">

          <div style="margin-right: 40px;">
            <input type="text" placeholder="Search Transaction ID">  
          </div>

          <a class="right waves-effect waves-light btn tooltipped" data-position="right" data-delay="50" data-tooltip="Search"  style="padding-left: 10px; padding-right: 10px; margin-top: -50px;">
            <i class="material-icons">search</i>
          </a>

        </div>
      </div>  

      <div class="col s12">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont2; padding-left: 35%;">Receipt Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatable">
            <thead>
              <tr>
                <th>Transaction ID</th>
                <th>Transaction Name</th>
                <th>Unit</th>
                <th>Print</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>T234</td>
                <td>Manage Unit</td>
                <td>E11</td>
                <td>
                  <button data-target="" class="waves-light btn light-green modal-trigger" href="#" style = "color: black;">Receipt</button>
                </td>
              </tr>
              <tr>
                <td>T765</td>
                <td>Service Purchases</td>
                <td></td>
                <td>
                  <button data-target="" class="waves-light btn light-green modal-trigger" href="#" style = "color: black;">Receipt</button>
                </td>
              </tr>
              <tr>
                <td>T012</td>
                <td>Unit Purchases</td>
                <td>C6</td>
                <td>
                  <button data-target="" class="waves-light btn light-green modal-trigger" href="#" style = "color: black;">Receipt</button>
                </td>
              </tr>
              <tr>
                <td>T120</td>
                <td>Collection & Downpayment</td>
                <td>C6</td>
                <td>
                  <button data-target="" class="waves-light btn light-green modal-trigger" href="#" style = "color: black;">Receipt</button>
                </td>
              </tr>
              <tr>
                <td>T632</td>
                <td>Assign Schedule</td>
                <td></td>
                <td>
                  <button data-target="" class="waves-light btn light-green modal-trigger" href="#" style = "color: black;">Receipt</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


<!-- Receipt -->


</div>
@endsection