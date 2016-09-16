@extends('v2.baseLayout')
@section('title', 'Room Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/room/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.room'>

<!-- Room-->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select ng-change='filterRooms()' ng-model='roomFilter.intBuildingId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value='0'>All Buildings</option>
            <option ng-repeat='building in buildingList' value="@{{ building.intBuildingId }}">@{{ building.strBuildingName }}</option>
          </select>
          <label>Building Name</label>
        </div>
        <div class="row">
          <select ng-change='filterRooms()' ng-model='roomFilter.intFloorNo' id='floorNo' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value='0'>All Floors</option>
            <option ng-repeat='n in [] | range: intFloorNo' value="@{{ $index+1 }}">@{{ $index+1 }}</option>
          </select>
          <label for='floorNo' style="margin-top: 80px;">Floor No</label>
        </div>
        <div class="row" style="margin-top: -30px;">
          <label style="margin-top: 120px;">Room Type:</label><br>
          <p>
            <input ng-change='toggleAll(roomTypeAll.selected)' ng-model='roomTypeAll.selected' type="checkbox" id="roomTypeAll" value=1/>
              <label for="roomTypeAll" style="padding-right: 10px;">All Room Types</label><br>
            <div ng-repeat='roomType in roomTypeList'>
              <input ng-change='filterRooms()' ng-model='roomType.selected' type="checkbox" id="roomType@{{ roomType.intRoomTypeId }}" value=1/>
              <label for="roomType@{{ roomType.intRoomTypeId }}" style="padding-right: 10px;">@{{ roomType.strRoomTypeName }}</label><br>
            </div>
          </p>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; padding-left: 35%;">Room Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatable" datatable='ng'>
            <thead>
              <tr>
                <th>Building Name</th>
                <th>Floor No.</th>
                <th>Name</th>
                <th>No. of Blocks</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='room in filterRoomList'>
                <td>@{{ room.strBuildingName }}</td>
                <td>Floor No. @{{ room.intFloorNo }}</td>
                <td>@{{ room.strRoomName }}</td>
                <td>@{{ room.blockCount }}</td>
                <td><span ng-repeat='roomType in room.roomDetails'>@{{ roomType.strRoomTypeName }}<span ng-if='$index != room.roomDetails.length-1'>, </span></span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
<!-- Room -->


</div>
@endsection