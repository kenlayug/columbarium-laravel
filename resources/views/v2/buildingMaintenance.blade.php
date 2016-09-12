@extends('v2.baseLayout')
@section('title', 'Building Maintenance')
@section('body')

	<script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
	<link rel = "stylesheet" href = "{!! asset('/css/buildingMaintenance.css') !!}"/>
	<script type="text/javascript" src = "{!! asset('/js/index.js') !!}"></script>
	<script type="text/javascript" src = "{!! asset('/building/controller.js') !!}"></script>


<div ng-controller='ctrl.building'>

<!-- Section -->
<div class = "container">
	<div class = "row">

		<!-- Create Building -->
		<div class = "col s12 m6 l4">
			<form class = "createForm aside aside z-depth-3" id="formCreate" ng-submit="saveBuilding()" autocomplete="off">
				<div class = "createHeader">
					<h5 class = "center createFormH4 flow-text">Building Maintenance</h5>
				</div>
				<div class="nameOfBuilding row" style = "padding-right: 10px;">
					<div class="input-field required col s6">
						<input ng-model="newBuilding.strBuildingName" id="buildingName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Building One" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
						<label id="lblCreateName" class="@{{ createInputStatus }}" for="buildingName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
					</div>
					<div class="input-field required col s6">
						<input ng-model="newBuilding.strBuildingCode" id="buildingCode" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: B001" required = "" aria-required="true" minlength = "1" maxlength="5" length = "5">
						<label id="lblCreateCode" class="@{{ createInputStatus }}" for="buildingCode" data-error = "Invalid format." data-success = "">Code<span style = "color: red;">*</span></label>
					</div>

					<div class="required input-field col s12">
						<input ng-model="newBuilding.strBuildingLocation" id="buildingAddress" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Summoner's Rift" required = "" aria-required="true" minlength = "1" pattern= "^[-.',a-zA-Z0-9]+(\s+[-.',a-zA-Z0-9]+)*$">
						<label id="lblCreateLocation" class="@{{ createInputStatus }}" for="buildingAddress" data-error = "Invalid format." data-success = "">Location<span style = "color: red;">*</span></label>
					</div>

					<div class="required input-field col s12">
						<input ng-model="newBuilding.intFloorNo" id="floorNumber" type="number" onkeypress = 'return isNumberKey(event)' class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole number only. Max input: 10<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "10">
						<label id="lblCreateFloorNo" class="@{{ createInputStatus }}" for="floorNumber" data-error = "Invalid format." data-success = "">Number of floor/s to create: <span style = "color: red;">*</span></label>
					</div>

					<br>
					<i class = "createFormReq left">*Required Fields</i>
					<button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 25px; margin-right: 10px;">Create</button>
				</div>
			</form>
		</div>

	
	        <!-- Data Grid -->
			<div class = "dataGrid col s12 m6 l8">
				<div class="row">
					<div id="admin">
						<div class="z-depth-2 card material-table">
							<div class="dataGridHeader table-header">
								<h5 class = "flow-text dataGridH4">Building Record</h5>
								<div class="actions">
									<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Building/s" style = "margin-right: 10px;" href = "#modalArchiveBuilding"><i class="material-icons" style = "color: black;">delete</i></button>
									<a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
								</div>
							</div>
							<table datatable="ng">
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
								<tr ng-repeat="building in buildingList">
									<td>@{{ building.strBuildingName }}</td>
									<td>@{{ building.strBuildingCode }}</td>
									<td>@{{ building.strBuildingLocation }}</td>
									<td>@{{ building.floorNo }}</td>
									<td><button ng-click="getBuilding(building, $index)" name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateBuilding"><i class="material-icons" style = "color: black;">mode_edit</i></button>
										<button ng-click="deleteBuilding(building, $index)" name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateBuilding"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>


	<script>
		$('.modal-trigger').leanModal({
					dismissible: false
				}
		);
	</script>

	</div>
</div>
	@include('modals.building.v2.update')
	@include('modals.building.v2.archive')
</div>

@endsection