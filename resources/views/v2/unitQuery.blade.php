@extends('v2.baseLayout')
@section('title', 'Unit Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/block/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.block'>


<!-- Unit-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Status Types</option>
            <option value="1">Pay Once</option>
            <option value="2">Reserve Unit</option>
            <option value="3">At Need</option>
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
          <table id="datatable">
            <thead>
              <tr>
                <th style="color: #000000;">Unit Code</th>
                <th style="color: #000000;">Customer Name</th>
                <th style="color: #000000;">Downpayment Balance</th>
                <th style="color: #000000;">Monthly Amortization</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>E3</td>
                <td>Sabi, Sabi Niya</td>
                <td>P 2,300.00</td>
                <td>P 3,000.00</td>
              </tr>
              <tr>
                <td>B12</td>
                <td>Tawang, Tawang Siya</td>
                <td>P 0.00</td>
                <td>P 4,000.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Unit -->
</div>
@endsection