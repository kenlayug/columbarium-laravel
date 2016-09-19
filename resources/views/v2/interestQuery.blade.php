@extends('v2.baseLayout')
@section('title', 'Interest Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/interest/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.interest'>

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
            <h5 style="color: #ffffff; padding-left: 35%;">Interest Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table datatable='ng'>
            <thead>
              <tr>
                <th>No. of Years</th>
                <th>Regular Rate</th>
                <th>At Need Rate</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='interest in interestList'>
                <td>@{{ interest.intNoOfYear }}</td>
                <td>@{{ interest.interest_rate.regular.deciInterestRate | percentage: 2}}</td>
                <td>@{{ interest.interest_rate.atNeed.deciInterestRate | percentage: 2}}</td>      
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Interest -->


</div>
@endsection