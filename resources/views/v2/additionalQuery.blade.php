@extends('v2.baseLayout')
@section('title', 'Additional Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.queries'>


	<center><h4 style="font-family: myFirstFont; color: #000000; padding-top: 20px;">QUERIES</h4></center><br>
	
<hr>
<!-- Additionals -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select ng-change='filterAdditionals(additionalFilter.intAdditionalCategoryId)' ng-model='additionalFilter.intAdditionalCategoryId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value='0'>All Additionals</option>
            <option ng-repeat='additionalCategory in additionalCategoryList' value="@{{ additionalCategory.intAdditionalCategoryId }}">@{{ additionalCategory.strAdditionalCategoryName }}</option>
        </select>
        <label>Additionals Category</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Additionals</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableAdditionals" datatable='ng'>
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='additional in additionalList'>
                <td>@{{ additional.strAdditionalName }}</td>
                <td>@{{ additional.strAdditionalDesc }}</td>
                <td>@{{ additional.price.deciPrice | currency : 'P' }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Additionals -->
<hr>

</div>
@endsection