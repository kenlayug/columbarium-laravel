@extends('v2.baseLayout')
@section('title', 'Service Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.queries'>

<!-- Service -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select ng-change='filterServices(serviceFilter.intServiceCategoryId)' ng-model='serviceFilter.intServiceCategoryId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value='0'>All Services</option>
            <option ng-repeat='serviceCategory in serviceCategoryList' value="@{{ serviceCategory.intServiceCategoryId }}">@{{ serviceCategory.strServiceCategoryName }}</option>
        </select>
        <label>Service Category</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 35%;">Service Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableService" datatable='ng'>
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='service in filterServiceList'>
                <td>@{{ service.strServiceName }}</td>
                <td>@{{ service.strServiceDesc }}</td>
                <td>@{{ service.price.deciPrice | currency : 'P' }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Service -->

</div>
@endsection