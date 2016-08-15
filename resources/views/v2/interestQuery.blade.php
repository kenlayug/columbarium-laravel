@extends('v2.baseLayout')
@section('title', 'Interest Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.queries'>


	<center><h4 style="font-family: myFirstFont; color: #000000; padding-top: 20px;">QUERIES</h4></center><br>
	
<hr>
<!-- Interest -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select ng-change='filterInterests(interestFilter.intAtNeed)' ng-model='interestFilter.intAtNeed' material-select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="2">All Interests</option>
            <option value="0">Pre-Need</option>
            <option value="1">At-Need</option>
        </select>
        <label>Interest Status</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Interest</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableInterest" datatable='ng'>
            <thead>
              <tr>
                <th>No. of Years</th>
                <th>Interest Rate</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='interest in filterInterestList'>
                <td>@{{ interest.intNoOfYear }}<span ng-if='interest.intAtNeed == 1'>(At Need)</span></td>
                <td>@{{ interest.interestRate.deciInterestRate | percentage: 2}}</td>         
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Interest -->
<hr>

</div>
@endsection