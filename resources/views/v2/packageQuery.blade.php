@extends('v2.baseLayout')
@section('title', 'Package Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/package/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.package'>

<!-- Package-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select ng-change='filterPackages(packageFilter.intServiceId)' ng-model='packageFilter.intServiceId' material-select watch>
          <option value="" disabled selected>Choose your filter</option>
          <option value='0'>All Packages</option>
          <option ng-repeat='service in serviceList' value='@{{ service.intServiceId }}'>@{{ service.strServiceName }}</option>
        </select>       
        <label>Service Name</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <h5 style="color: #ffffff; padding-left: 35%;">Package Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table datatable='ng'>
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Service/s</th>
                <th>Additionals</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='package in filterPackageList'>
                <td>@{{ package.strPackageName }}</td>
                <td>@{{ package.strPackageDesc }}</td>
                <td><button class='btn'>View</button></td>
                <td><button class='btn'>View</button></td>
                <td>@{{ package.price.deciPrice | currency : 'P'}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Package -->

  <div class="row">
    <div class="input-field col s3">
        <select ng-change='filterPackages(packageFilter.intServiceId, packageFilter.intAdditionalId)' ng-model='packageFilter.intAdditionalId' material-select watch>
          <option value="" disabled selected>Choose your filter</option>
          <option value='0'>All Packages</option>
          <option ng-repeat='additional in additionalList' value='@{{ additional.intAdditionalId }}'>@{{ additional.strAdditionalName }}</option>
        </select>       
        <label>Additional Name</label>
      </div>
  </div>

</div>
@endsection