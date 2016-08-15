@extends('v2.baseLayout')
@section('title', 'Queries')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/controller.js') !!}"></script>

<div ng-controller='ctrl.queries'>
	<style type="text/css">
		hr{
			border-top: 1px solid #8c8b8b;
			text-align: center;
		}
		hr:after {
			content: ':)';
			display: inline-block;
			position: relative;
			top: -14px;
			padding: 0 10px;
			background: #f0f0f0;
			color: #8c8b8b;
			font-size: 18px;
			-webkit-transform: rotate(60deg);
			-moz-transform: rotate(60deg);
			transform: rotate(60deg);
		}
	</style>


	<center><h4 style="font-family: myFirstFont; color: #000000; padding-top: 20px;">QUERIES</h4></center><br>
	
	<hr>
<!-- Package-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select material-select watch>
		    	<option value="" disabled selected>Choose your filter</option>
          <option ng-repeat='service in serviceList' value='service.intServiceId'>@{{ service.strServiceName }}</option>
    	  </select>	    	
        <label>Service Name</label>
	  	</div>
    
      <div class="col s9">
    	  <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Package</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatablePackage" datatable='ng'>
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
<hr>
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
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Service</h5>
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
<!-- Unit Price -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        <label>Block Name</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Unit Price</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableUnitPrice">
            <thead>
              <tr>
                <th>Column</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>2</td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>3</td>
                <td>P 1,500.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Unit Price -->
<hr>
<!-- Block-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Armin</option>
            <option value="2">Erwim</option>
            <option value="3">Levi</option>
            <option value="4">Mikasa</option>
          </select>
          <label>Building Name</label>
        </div>
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <label style="margin-top: 100px;">Building Floor</label>
        </div>
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Armin</option>
            <option value="2">Erwim</option>
        </select>
        <label style="margin-top: 200px;">Building Room</label>
        </div>
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Fullbody Crypts</option>
            <option value="2">Columbary Vaults</option>
        </select>
        <label style="margin-top: 300px;">Type of Block</label>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Block</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableBlock">
            <thead>
              <tr>
                <th>Name</th>
                <th>No. of Columns</th>
                <th>No. of Rows</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Armin</td>
                <td>4</td>
                <td>5</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>4</td>
                <td>5</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>4</td>
                <td>5</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>4</td>
                <td>5</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>4</td>
                <td>5</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>


<!-- Block -->
<hr>
<!-- Room-->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Armin</option>
            <option value="2">Erwim</option>
            <option value="3">Levi</option>
            <option value="4">Mikasa</option>
          </select>
          <label>Building Name</label>
        </div>
        <div class="row" style="margin-top: -30px;">
          <label style="margin-top: 80px;">Room Type:</label><br>
          <p>
              <input type="checkbox" id="cv"/>
              <label for="cv" style="padding-right: 10px;">Columbary Vaults</label><br>
              <input type="checkbox" id="fc"/>
              <label for="fc" style="padding-right: 10px;">Fullbody Crypts</label><br>
              <input type="checkbox" id="office"/>
              <label for="office" style="padding-right: 10px;">Office</label><br>
              <input type="checkbox" id="cashier"/>
              <label for="cashier" style="padding-right: 10px;">Cashier</label><br>
          </p>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Room</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableRoom">
            <thead>
              <tr>
                <th>Name</th>
                <th>No. of Blocks</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Armin</td>
                <td>3</td>
                <td>Fullbody, Columbary</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>3</td>
                <td>Fullbody, Columbary</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>3</td>
                <td>Fullbody, Columbary</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
<!-- Room -->
<hr>
<!-- Building-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
          <label>Building Floor</label>
        </div>
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">North</option>
            <option value="2">East</option>
            <option value="3">West</option>
            <option value="4">South</option>
          </select>
          <label style="margin-top: 100px;">Building Location</label>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Building</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableBuilding">
            <thead>
              <tr>
                <th>Name</th>
                <th>Location</th>
                <th>No. of Floors</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Armin</td>
                <td>North</td>
                <td>2</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>North</td>
                <td>2</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>North</td>
                <td>2</td>
              </tr>
            </tbody>
            </table>
        </div>
      </div>
    </div>

<!-- Building -->
<hr>

<!-- Interest -->

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
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Interest</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableInterest" datatable='ng'>
            <thead>
              <tr>
                <th>No. of Years</th>
                <th>Interest Rate</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='interest in filterInterestList'>
                <td>@{{ interest.intNoOfYear }}<span ng-if='interest.intAtNeed == 1'>(At Need)</span></td>
                <td>@{{ interest.interestRate.deciInterestRate | percentage: 2}}</td>         
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Interest -->
</div>
@endsection