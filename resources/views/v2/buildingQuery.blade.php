@extends('v2.baseLayout')
@section('title', 'Building Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.queries'>

<!-- Building-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select ng-change='filterBuildings(buildingFilter)' ng-model='buildingFilter.intNoOfFloor' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value='0'>All Buildings</option>
            <option ng-repeat='n in [] | range: intMaxFloorNo' value="@{{ $index+1 }}">@{{ $index+1 }}</option>
          </select>
          <label>Building Floor</label>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 35%;">Building Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableBuilding" datatable='ng'>
            <thead>
              <tr>
                <th>Name</th>
                <th>Location</th>
                <th>No. of Floors</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='building in filterBuildingList'>
                <td>@{{ building.strBuildingName }}</td>
                <td>@{{ building.strBuildingLocation }}</td>
                <td>@{{ building.floorNo }}</td>
              </tr>
            </tbody>
            </table>
        </div>
      </div>
    </div>

<!-- Building -->

</div>
@endsection