@extends('maintenanceLayout')
@section('body')
	<link rel = "stylesheet" href = "{!! asset('/css/Building_Record_Form.css') !!}"/>

	<script type="text/javascript" src = "{!! asset('/js/index.js') !!}"></script>
	<script type="text/javascript" src = "{!! asset('/building/building-controller.js') !!}"></script>

<div ng-app="buildingApp">

<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
	<div class = "row">
		<div class = "col s4">
			<!-- Create Building -->
			<div class = "col s12" ng-controller="ctrl.newBuilding">
				<form class = "aside aside z-depth-3" style = "margin-top: 20px; height: 400px; margin-left: 30px;" id="formCreate" ng-submit="SaveBuilding()">
					<div class = "header">
						<h4 style = "font-family: myFirstFont2; font-size: 1.8vw;padding-top: 10px; margin-top: 10px;">Building Maintenance</h4>
					</div>
					<div class="row" style = "padding-left: 10px;">
						<div class="input-field required col s6">
							<input ng-model="building.strBuildingName" id="buildingName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
							<label for="buildingName" data-error = "Invalid format." data-success = "">Name of Building <span style = "color: red;">*</span></label>
						</div>
						<div class="input-field required col s6">
							<input ng-model="building.strBuildingCode" id="buildingCode" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="5">
							<label for="buildingCode" data-error = "Invalid format." data-success = "">Building Code <span style = "color: red;">*</span></label>
						</div>
					</div>

					<div style = "padding-left: 10px;">
						<div class="required input-field col s12">
							<input ng-model="building.strBuildingLocation" id="buildingAddress" type="text" class="validate" required = "" aria-required="true" minlength = "1" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
							<label for="buildingAddress" data-error = "Invalid format." data-success = "">Building Location <span style = "color: red;">*</span></label>
						</div>
					</div>

					<div style = "padding-left: 10px;">
						<div class="required input-field col s12">
							<input ng-model="building.intFloorNo" id="floorNumber" type="number" onkeypress = 'return isNumberKey(event)' class="validate" required = "" aria-required = "true" min = "1" max = "10">
							<label for="floorNumber" data-error = "Invalid format." data-success = "">Number of floor/s to create: <span style = "color: red;">*</span></label>
						</div>
					</div>

					<i class = "left" style = "margin-bottom: 50px; padding-left: 20px; color: red;">*Required Fields</i>
					<button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 30px; margin-right: 10px;">Create</button>

				</form>

			</div>
		</div>
	
	        <!-- Modal Update -->
	        <div id="modalUpdateBuilding" class="modal" style = "width: 550px; height: 400px;" ng-controller="ctrl.updateBuilding">
	            <div class = "modal-header" style = "height: 55px;">
	                <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">Update Building</h4>
	            </div>
	            <div class="modal-content" id="formUpdate">
					<br>
                    <form class="row"  style = "padding-left: 20px;" ng-submit="SaveBuilding()">
						<div class = "row">
							<div class="input-field col s6">
								<input ng-model="update.intBuildingId" id="buildingToBeUpdated" type="hidden">
								<input ng-model="update.strBuildingName" placeholder = "Building Name" id="buildingNameUpdate" type="text" class="validate"  required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
								<label class = "active" for="buildingNameUpdate" data-error = "Invalid format." data-success = "">New Building Name <span style = "color: red;">*</span></label>
							</div>
							<div class="input-field required col s6">
								<input ng-model="update.strBuildingCode" id="buildingCodeUpdate" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="5">
								<label for="buildingCodeUpdate" data-error = "Invalid format." data-success = "">Building Code <span style = "color: red;">*</span></label>
							</div>
						</div>

                        <div class="input-field col s12">
                            <input ng-model="update.strBuildingLocation" placeholder = "Building Name" id="buildingAddressUpdate" type="text" class="validate"  required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                            <label for="buildingAddressUpdate" data-error = "Invalid Format." data-success = "">New Building Location <span style = "color: red;">*</span></label>
                        </div>
						<i class = "left" style = "margin-top: 10px; padding-left: 10px; color: red;">*Required Fields</i>
						<div class="modal-footer">
							<div style = "margin-top: 0px; margin-bottom: 0px;">
								<button name = "action" type = "submit" class="btn light-green" style = "color: black; margin-bottom: 0px; margin-top: 65px;margin-left: 10px; ">Confirm</button>
                    </form>
                       			<button name = "action" class="btn light-green modal-close" style = "color: black; margin-top: 65px; margin-bottom: 0px;">Cancel</button>
							</div>
                    	</div>
	            </div>
	        </div>

			<!-- Modal Archive Building-->
			<div id="modalArchiveBuilding" class="modal" style = "height: 400px; width: 600px;" ng-controller="ctrl.deactivatedTable">
				<div class="modal-content">
					<!-- Data Grid Deactivated Building/s-->
					<div id="admin1" class="col s12" style="margin-top: 0px">
						<div class="z-depth-2 card material-table" style="margin-top: 0px">
							<div class="table-header" style="height: 45px; background-color: #00897b;">
								<h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 1.8vw; color: white; padding-left: 0px;">Archive Building/s</h4>
								<a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 150px; color: #ffffff;">search</i></a>
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
				<button name = "action" class="btn light-green modal-close right" style = "color: black; margin-bottom: 10px; margin-right: 30px;">DONE</button>
			</div>
	
	        <!-- Data Grid -->
			<div class = "col s7" style = "margin-top: 20px; margin-left: 30px;" ng-controller="ctrl.buildingTable">
				<div class="row">
					<div id="admin">
						<div class="z-depth-2 card material-table">
							<div class="table-header" style="background-color: #00897b;">
								<h4 style = "font-family: myFirstFont2; font-size: 1.8vw; color: white; padding-left: 0px;">Building Record</h4>
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