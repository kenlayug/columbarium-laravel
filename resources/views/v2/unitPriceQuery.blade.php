@extends('v2.baseLayout')
@section('title', 'Unit Price Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/unit-price/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.unit-price'>

<!-- Unit Price -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select ng-change='filterUnitPrices()' ng-model='filter.intBuildingId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Buildings</option>
            <option ng-repeat='building in buildingList' value="@{{ building.intBuildingId }}">@{{ building.strBuildingName }}</option>
          </select>
          <label>Building Name</label>
        </div>
        <div class="row">
          <select ng-change='filterUnitPrices()' ng-model='filter.intFloorNo' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Floors</option>
            <option ng-repeat='n in [] | range: intFloorNo' value="@{{ $index+1 }}">@{{ $index+1 }}</option>
          </select>
          <label style="margin-top: 80px;">Floor Number</label>
        </div>
        <div class="row">
          <select ng-change='filterUnitPrices()' ng-model='filter.intUnitTypeId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Unit Types</option>
            <option ng-repeat='unitType in unitTypeList' value='@{{ unitType.intRoomTypeId }}'>@{{ unitType.strRoomTypeName }}</option>
          </select>
          <label style="margin-top: 160px;">Unit Type</label>
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
          <table id="datatableUnitPrice" datatable='ng'>
            <thead>
              <tr>
                <th>Building Name</th>
                <th>Floor No</th>
                <th>Unit Type</th>
                <th>Level</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='unitCategory in filterUnitCategoryList'>
                <td>@{{ unitCategory.strBuildingName }}</td>
                <td>@{{ unitCategory.intFloorNo }}</td>
                <td><span title='@{{ unitCategory.strRoomTypeName }}'>@{{ unitCategory.strRoomTypeName}}</span></td>
                <td>@{{ unitCategory.display }}</td>
                <td>@{{ unitCategory.price.deciPrice | currency : 'P'}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Unit Price -->

</div>
@endsection