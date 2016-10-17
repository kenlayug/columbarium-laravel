@extends('v2.baseLayout')
@section('title', 'Discount Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.queries'>

<!-- Discount -->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value='0'>All Discount Types</option>
            <option value='1'>Percentage</option>
            <option value='2'>Amount</option>
          </select>
          <label>Discount Type</label>
        </div>
        <div class="row">
          <select material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value='0'>All Services</option>
            <option value='1'>Cremation</option>
            <option value='2'>Interment</option>
          </select>
          <label style="margin-top: 80px;">Services</label>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <h5 style="color: #ffffff; padding-left: 35%;">Discount Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatable">
            <thead>
              <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Rate</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Senior's Discount</td>
                <td>Percentage</td>
                <td>20.00%</td>
              </tr>
            </tbody>
            </table>
        </div>
      </div>
    </div>

<!-- Discount -->

</div>
@endsection