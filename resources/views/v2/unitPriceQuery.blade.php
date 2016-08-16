@extends('v2.baseLayout')
@section('title', 'Unit Price Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.queries'>

<!-- Unit Price -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <label>Building Name</label>
        </div>
        <div class="row">
          <select material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
          <label style="margin-top: 80px;">Floor Number</label>
        </div>
        <div class="row">
          <select material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <label style="margin-top: 160px;">Block Name</label>
        </div>
        
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 35%;">Unit Price Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableUnitPrice">
            <thead>
              <tr>
                <th>Column</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>2</td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>3</td>
                <td>P 1,500.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Unit Price -->

</div>
@endsection