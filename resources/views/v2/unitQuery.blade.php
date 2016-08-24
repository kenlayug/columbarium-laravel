@extends('v2.baseLayout')
@section('title', 'Unit Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/unit/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.unit'>


<!-- Unit-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intUnitStatus' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Status Types</option>
            <option value="3">Owned</option>
            <option value="2">Reserved</option>
            <option value="4">At Need</option>
            <option value="5">Deactivated</option>
        </select>
        <label>Unit Status</label>
        </div>
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intBuildingId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Buildings</option>
            <option ng-repeat='building in buildingList' value="@{{ building.intBuildingId }}">@{{ building.strBuildingName }}</option>
          </select>
          <label style="margin-top: 80px;">Building Name</label>
        </div>
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intFloorNo' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Floors</option>
            <option ng-repeat='n in [] | range: intFloorNo' value="@{{ $index+1 }}">@{{ $index+1 }}</option>
        </select>
        <label style="margin-top: 160px;">Building Floor</label>
        </div>
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intRoomId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Rooms</option>
            <option ng-repeat='room in filterRoomList' value="@{{ room.intRoomId }}">@{{ room.strBuildingCode+'-'+room.intFloorNo+'-'+room.strRoomName }}</option>
        </select>
        <label style="margin-top: 240px;">Building Room</label>
        </div>
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intUnitTypeId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Unit Types</option>
            <option ng-repeat='unitType in unitTypeList' value="@{{ unitType.intRoomTypeId }}">@{{ unitType.strRoomTypeName }}</option>
        </select>
        <label style="margin-top: 320px;">Type of Block</label>
        </div>
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intBlockNo' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Blocks</option>
            <option ng-repeat='block in filterBlockList' value="@{{ block.intBlockNo }}">@{{ block.intBlockNo }}</option>
        </select>
        <label style="margin-top: 400px;">Block</label>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont2; padding-left: 35%;">Unit Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatable" datatable='ng'>
            <thead>
              <tr>
                <th style="color: #000000;">Building Name</th>
                <th style="color: #000000;">Floor No.</th>
                <th style="color: #000000;">Room Name</th>
                <th style="color: #000000;">Block No.</th>
                <th style="color: #000000;">Unit Type</th>
                <th style="color: #000000;">Unit Id</th>
                <th style="color: #000000;">Customer</th>
                <th style="color: #000000;">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='unit in filterUnitList'>
                <td><span title="@{{ unit.strBuildingName }}">@{{ unit.strBuildingName }}</span></td>
                <td>@{{ unit.intFloorNo }}</td>
                <td><span title="@{{ unit.strRoomName }}">@{{ unit.strRoomName }}</span></td>
                <td>@{{ unit.intBlockNo }}</td>
                <td><span title="@{{ unit.strRoomTypeName }}">@{{ unit.strRoomTypeName }}</span></td>
                <td>@{{ unit.intUnitId }}</td>
                <td><span title="@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}">@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</span></td>
                <td>@{{ unitStatusList[unit.intUnitStatus] }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Unit -->
</div>
@endsection