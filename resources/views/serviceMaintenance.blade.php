@extends('maintenanceLayout')

@section('title', 'Service Maintenance')
@section('body')
     <link rel = "stylesheet" href = "{!! asset('/css/serviceMaintenance.css') !!}"/>
     <script type="text/javascript" src="{!! asset('/service/service-controller.js') !!}"></script>
     <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>

<div ng-app="serviceApp">
<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
	<div class = "row">
		<div class = "col s4">
			<!-- Create Service -->
			<div class = "col s12" ng-controller="ctrl.newService">
				<div class = "formCreate aside aside z-depth-3" id="formCreate">
					<div class = "createFormHeader">
						<h4 class = "formCreateH4">Service Maintenance</h4>
					</div>
					<form ng-submit="CreateNewService()">
						<div class="formCreateStyle row" id="formCreate">
							<div class = "row">
								<div class="input-field col s6">
									<input ng-model="strServiceName" id="serviceName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
									<label for="serviceName" data-error = "Invalid Format." data-success = "">Name<span style = "color: red;">*</span></label>
								</div>
								<div class="input-field col s6">
									<input ng-model="deciPrice" id="servicePrice" type="number" class="validate" min="1" max = "999999" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
									<label for="servicePrice" data-error = "Invalid Format." data-success = "">Price<span style = "color: red;">*</span></label>
								</div>
							</div>
								<div class="input-field col s12">
									<input ng-model="strServiceDesc" id="serviceDesc" type="text" class="validate">
									<label for="serviceDesc" data-error = "Invalid Format." data-success = "">Description</label>
								</div>
                            <div class = "row">
                                <div class="input-field col s6">
                                    <select class="browser-default" id="selectserviceType">
                                        <option class = "serviceType" value="" disabled selected>Type</option>
                                        <option class = "serviceType">Unit Servicing</option>
                                        <option class = "serviceType">Others</option>
                                    </select>
                                </div>
                                <button name = "action" class="modal-trigger btn light-green left" style = "color: black; font-size: 10px; width: 180px; margin-top: 20px; margin-left: 0px;" href = "#modalRequirement">Choose Requirement</button>
                            </div>
						</div>
                        <i class = "createReqField left" style = "padding-left: 20px;">*Required Fields</i>
						<button type = "submit" name = "action" class="btn light-green right" style = "margin-top: 40px; color: black; margin-right: 10px;">Create</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Data Grid -->
		<div class = "serviceDataGrid col s7" style = "margin-left: 50px;" ng-controller="ctrl.serviceTable">
			<div class="row">
				<div id="admin">
					<div class="z-depth-2 card material-table">
						<div class="table-header">
							<h4 class = "dataGridH4">Service Record</h4>
							<div class="actions">
								<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Service/s" style = "margin-right: 10px;" href = "#modalArchiveService"><i class="material-icons" style = "color: black;">delete</i></button>
								<a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
							</div>
						</div>
						<table id="datatable">
							<thead>
							<tr>
								<th>Name</th>
								<th>Price</th>
								<th>Description</th>
								<th>Requirement</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<tr ng-repeat="service in services">
								<td>@{{ service.strServiceName }}</td>
								<td>@{{ service.price.deciPrice | currency}}</td>
								<td>@{{ service.strServiceDesc }}</td>
								<td><button ng-click="GetRequirement(service.intServiceId)" name = "action" class="btn tooltipped modal-trigger btn light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "View Requirement/s" style = "color: black; font-size: 10px; width: 100px; margin-right: 10px;" href = "#modalListOfRequirement">View</button></td>
								<td><button ng-click="UpdateService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
									<button ng-click="DeleteService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
    </div>
	</div>
    
    <script>
	    $(document).ready(function(){
	        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
	        $('.modal-trigger').leanModal({dismissible: false});
	    });
	</script>

	@include('modals.service.archive')
	@include('modals.service.requirements')
	@include('modals.service.update')
</div>
@endsection