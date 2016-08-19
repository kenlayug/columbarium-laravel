@extends('v2.baseLayout')
@section('title', 'Receipt Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/block/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.block'>


<!-- Receipt-->
    <div class="row" style="margin: 30px;">
      
    
      <div class="col s12">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 35%;">Receipt Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableBlock" datatable='ng'>
            <thead>
              <tr>
                <th>Building Name</th>
                <th>Floor No.</th>
                <th>Room Name</th>
                <th>Block No.</th>
                <th>Unit Type</th>
                <th>Level/s</th>
                <th>Receipt</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='block in filterBlockList'>
                <td>@{{ block.strBuildingName }}</td>
                <td>@{{ block.intFloorNo }}</td>
                <td>@{{ block.strRoomName }}</td>
                <td>@{{ block.intBlockNo }}</td>
                <td>@{{ block.strRoomTypeName }}</td>
                <td>@{{ block.row }}</td>
                <td>@{{ block.column }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>


<!-- Receipt -->


</div>
@endsection