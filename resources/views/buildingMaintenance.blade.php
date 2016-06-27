@extends('maintenanceLayout')
@section('title', 'Building Maintenance')
@section('body')
	<link rel = "stylesheet" href = "{!! asset('/css/buildingMaintenance.css') !!}"/>

	<script type="text/javascript" src = "{!! asset('/js/index.js') !!}"></script>
	<script type="text/javascript" src = "{!! asset('/building/building-controller.js') !!}"></script>

<style>


</style>

<div ng-app="buildingApp">

<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
	<div class = "row">
		<div class = "col s4">
			<!-- Create Building -->
			<div class = "col s12" ng-controller="ctrl.newBuilding">
				<form class = "createForm aside aside z-depth-3" id="formCreate" ng-submit="SaveBuilding()">
					<div class = "createHeader">
						<h4 class = "createFormH4">Building Maintenance</h4>
					</div>
					<div class="nameOfBuilding row">
						<div class="input-field required col s6">
							<input ng-model="building.strBuildingName" id="buildingName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
							<label id="lblCreateName" class="@{{ createInputStatus }}" for="buildingName" data-error = "Invalid format." data-success = "">Name of Building <span style = "color: red;">*</span></label>
						</div>
						<div class="input-field required col s6">
							<input ng-model="building.strBuildingCode" id="buildingCode" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="5" length = "5">
							<label id="lblCreateCode" class="@{{ createInputStatus }}" for="buildingCode" data-error = "Invalid format." data-success = "">Building Code <span style = "color: red;">*</span></label>
						</div>
					</div>

					<div class = "buildingLocation">
						<div class="required input-field col s12">
							<input ng-model="building.strBuildingLocation" id="buildingAddress" type="text" class="validate" required = "" aria-required="true" minlength = "1" pattern= "[a-zA-Z0-9\-|\.|\,|]+[a-zA-Z0-9\-|\.|\,| ]+">
							<label id="lblCreateLocation" class="@{{ createInputStatus }}" for="buildingAddress" data-error = "Invalid format." data-success = "">Building Location <span style = "color: red;">*</span></label>
						</div>
					</div>

					<div class = "numberOfFloors">
						<div class="required input-field col s12">
							<input ng-model="building.intFloorNo" id="floorNumber" type="number" onkeypress = 'return isNumberKey(event)' class="validate" required = "" aria-required = "true" min = "1" max = "10">
							<label id="lblCreateFloorNo" class="@{{ createInputStatus }}" for="floorNumber" data-error = "Invalid format." data-success = "">Number of floor/s to create: <span style = "color: red;">*</span></label>
						</div>
					</div>

					<i class = "createFormReq left">*Required Fields</i>
					<button type = "submit" name = "action" class="btnCreate btn light-green right">Create</button>
				</form>
			</div>
		</div>
	
	        <!-- Modal Update -->
	        <form id="modalUpdateBuilding" class="modalUpdate modal" ng-controller="ctrl.updateBuilding">
	            <div class = "modalUpdateHeader modal-header">
	                <h4 class = "modalUpdateH4">Update Building</h4>
	            </div>
	            <div class="modal-content" id="formUpdate">

                    <div class="row updateForm" ng-submit="SaveBuilding()">
							<div class="input-field col s6">
								<input ng-model="update.intBuildingId" id="buildingToBeUpdated" type="hidden">
								<input ng-model="update.strBuildingName" placeholder = "Building Name" id="buildingNameUpdate" type="text" class="validate"  required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
								<label id="updateName" for="buildingNameUpdate" data-error = "Invalid format." data-success = "">New Building Name <span style = "color: red;">*</span></label>
							</div>
							<div class="input-field required col s6">
								<input ng-model="update.strBuildingCode" id="buildingCodeUpdate" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="5" length = "5">
								<label id="updateCode" for="buildingCodeUpdate" data-error = "Invalid format." data-success = "">Building Code <span style = "color: red;">*</span></label>
							</div>

                        <div class="input-field col s12">
                            <input ng-model="update.strBuildingLocation" placeholder = "Building Name" id="buildingAddressUpdate" type="text" class="validate"  required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "[a-zA-Z0-9\-|\.|\,|]+[a-zA-Z0-9\-|\.|\,| ]+">
                            <label id="updateLocation" for="buildingAddressUpdate" data-error = "Invalid Format." data-success = "">New Building Location <span style = "color: red;">*</span></label>
                        </div>
						<i class = "updateFormReq left">*Required Fields</i>
                    </div>
	            </div>
				<div class="modal-footer">
					<button name = "action" type = "submit" class="btnConfirm btn light-green" style = "margin-right: 30px;">Confirm</button>
					<button class="btnCancel btn light-green modal-close" style = "margin-right: 5px;">Cancel</button>
				</div>
	        </form>

			<!-- Modal Archive Building-->
			<div id="modalArchiveBuilding" class="archiveDataGrid modal" ng-controller="ctrl.deactivatedTable">
				<div class="modal-content">
					<!-- Data Grid Deactivated Building/s-->
					<div id="admin1" class="col s12">
						<div class="z-depth-2 card material-table">
							<div class="archiveHeader table-header">
								<h4 class = "archiveH4">Archive Building/s</h4>
								<a href="#" class="archiveSearch search-toggle btn-flat right"><i class="material-icons right">search</i></a>
							</div>
							<table id="datatable2">
								<thead>
								<tr>
									<th>Name</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<tr ng-repeat="building in deactivatedBuildings">
									<td>@{{ building.strBuildingName }}</td>
									<td>
										<button ng-click="ReactivateBuilding(building.intBuildingId, $index)" name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<button name = "action" class="btnArchiveDone btn light-green modal-close right">DONE</button>
			</div>
	
	        <!-- Data Grid -->
			<div class = "dataGrid col s7" ng-controller="ctrl.buildingTable">
				<div class="row">
					<div id="admin">
						<div class="z-depth-2 card material-table">
							<div class="dataGridHeader table-header">
								<h4 class = "dataGridH4">Building Record</h4>
								<div class="actions">
									<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Building/s" style = "margin-right: 10px;" href = "#modalArchiveBuilding"><i class="material-icons" style = "color: black;">delete</i></button>
									<a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
								</div>
							</div>
							<table id="datatable">
								<thead>
								<tr>
									<th>Name</th>
									<th>Code</th>
									<th>Location</th>
									<th>No. of Floor/s</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<tr ng-repeat="building in buildings">
									<td>@{{ building.strBuildingName }}</td>
									<td>@{{ building.strBuildingCode }}</td>
									<td>@{{ building.strBuildingLocation }}</td>
									<td>@{{ building.floorNo }}</td>
									<td><button ng-click="UpdateBuilding(building.intBuildingId, $index)" name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateBuilding"><i class="material-icons" style = "color: black;">mode_edit</i></button>
										<button ng-click="DeactivateBuilding(building.intBuildingId, $index)" name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateBuilding"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

	<script>
		function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			var num = document.getElementById('floorNumber').value;
			if ((charCode > 31 && (charCode < 48 || charCode > 57)) || (num > 10)){
				if (num > 10){
					alert('choose number from 1-10');
				}
				return false;
			}else{
				return true;
			}
		}
		$('.modal-trigger').leanModal({
					dismissible: false
				}
		);
	
	</script>
	</div>
	</div>
</div>
@endsection