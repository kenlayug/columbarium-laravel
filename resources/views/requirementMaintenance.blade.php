@extends('maintenanceLayout')
@section('title', 'Requirement Maintenance')

@section('body')
	<script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/requirementMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/requirement/requirement-controller.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>


    <div ng-app="requirementApp">
	<!-- Section -->
	<div class = "container">
		<div class = "row">
			<div class = "col s12 m6 l4" id = "fadeShow">
				<!-- Create Requirement -->
				<div ng-controller="ctrl.newRequirement">
					<form class = "createForm aside aside z-depth-3" id="formCreate" ng-submit="SaveRequirement()" autocomplete="off">
						<div class = "createFormHeader">
							<h4 class = "center flow-text createFormH4">Requirement Maintenance</h4>
						</div>
						<div class="requirementName row" id = "formCreate">
							<div class="input-field col s6">
								<input ng-model="requirement.strRequirementName" id="requirementName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Valid ID" required = "" aria-required = "true" minlength = "1" maxlength="20" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
								<label for="requirementName" data-error = "Invalid Format." data-success = "">Name<span style = "color: red;">*</span></label>
							</div>
						</div>
						<div class="requirementDesc row">
							<div class="input-field col s12">
								<input ng-model="requirement.strRequirementDesc" id="requirementDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric and special characters.<br>*Example: Requirement that is required in cremation.">
								<label for="requirementDesc">Description</label>
							</div>
						</div>
						<div class = "row">
							<i class = "createFormReqField left">*Required Fields</i>
							<br>
							<button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-bottom: 10px; margin-top: 30px; margin-right: 20px;">Create</button>
						</div>
					</form>
				</div>
			</div>

			<!-- Data Grid -->
			<div class = "requirementDataGrid col s12 m6 l8" ng-controller="ctrl.requirementTable">
				<div class="row">
					<div id="admin">
						<div class="z-depth-2 card material-table">
							<div class="table-header">
								<h4 class = "flow-text requirementDataGridH4">Requirement Record</h4>
								<div class="actions">
									<div id = "modalCreateBtn" style = "display: none;">
										<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Create Requirement" style = "margin-right: 10px;" href = "#modalCreateRequirement"><i class="material-icons" style = "color: black">add</i></button>
									</div>
									<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Requirement/s" style = "margin-right: 10px;" href = "#modalArchiveRequirement"><i class="material-icons" style = "color: black;">delete</i></button>
									<a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
								</div>
							</div>
							<table id="datatable" datatable="ng">
								<thead>
								<tr>
									<th>Requirement Name</th>
									<th>Requirement Description</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<tr ng-repeat="requirement in requirements">
									<td>@{{ requirement.strRequirementName }}</td>
									<td>@{{ requirement.strRequirementDesc }}</td>
									<td><button tooltipped ng-click="UpdateRequirement(requirement.intRequirementId, $index)" name = "action" class="btn modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Update Requirement"><i class="material-icons" style = "color: black;">mode_edit</i></button>
									<button tooltipped ng-click="DeleteRequirement(requirement.intRequirementId, $index)" name = "action" class="btn modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Requirement"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
	</div>

	<script>
		$(window).resize(function() {
			if ($(this).width() < 1026) {
				$('#fadeShow').hide();
			} else {
				$('#fadeShow').show();
			}
		});

		$(window).resize(function() {
			if ($(this).width() > 1026) {
				$('#modalCreateBtn').hide();
			} else {
				$('#modalCreateBtn').show();
			}
		});

		$('#buttonID').click(function(){
			$('#img').show();
			$.ajax({
					....
					success:function(result){
				$('#img').hide();  //<--- hide again
			}
		};
	</script>

	<script>
	
		$(document).ready(function(){
		    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
		    $('.modal-trigger').leanModal({dismissible: false});
		});
	
	</script>
</div>
	@include('modals.requirement.archive')
	@include('modals.requirement.update')
</div>
@endsection