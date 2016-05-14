@extends('maintenanceLayout')
@section('title', 'Requirement Maintenance')

@section('body')

    <link rel = "stylesheet" href = "{!! asset('/css/Requirements_Maintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/requirement/requirement-controller.js') !!}"></script>

<script>
	$(window).resize(function() {
		if ($(this).width() < 1026) {
			$('#fadeShow').hide();
		} else {
			$('#fadeShow').show();
		}
	})
</script>
<script>
	$(window).resize(function() {
		if ($(this).width() > 1026) {
			$('#modalCreateBtn').hide();
		} else {
			$('#modalCreateBtn').show();
		}
	})
</script>
<div ng-app="requirementApp">
	<!-- Section -->
	<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
		<div class = "row">
			<div class = "col s4" id = "fadeShow">
				<!-- Create Requirement -->
				<div class = "col s12" ng-controller="ctrl.newRequirement">
					<form class = "aside aside z-depth-3" style = "margin-top: 0px; height: 360px; margin-left: 30px;" id="formCreate" ng-submit="SaveRequirement()">
						<div class = "header">
							<h4 style = "font-family: myFirstFont2; font-size: 1.8vw;padding-top: 10px; margin-top: 10px;">Requirement Maintenance</h4>
						</div>
						<div class="row" style = "padding-left: 10px;" id = "formCreate">
							<div class="input-field col s6">
								<input ng-model="requirement.strRequirementName" id="requirementName" type="text" class="validate" required = "" aria-required = "true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
								<label for="requirementName" data-error = "Invalid Format." data-success = "">Requirement Name<span style = "color: red;">*</span></label>
							</div>
						</div>
						<div class="row" style = "padding-left: 10px;">
							<div class="input-field col s12">
								<input ng-model="requirement.strRequirementDesc" id="requirementDesc" type="text" class="validate" >
								<label for="requirementDesc">Requirement Description</label>
							</div>
						</div>

						<i class = "left" style = "margin-bottom: 50px; padding-left: 20px; color: red;">*Required Fields</i>
						<br>
						<button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 30px; margin-right: 10px;">Create</button>

					</form>

				</div>
			</div>


			<!-- Modal Create Requirement -->
			<div id="modalCreateRequirement" class="modal" style = "width: 600px;">
				<div class = "modal-header" style = "height: 55px;">
					<h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 2.5vw;">Create Requirement</h4>
				</div>
				<form class="form">
					<div class="row" style = "padding-left: 10px;" id = "formCreate">
						<div class="input-field col s6">
							<input id="requirementName" type="text" class="validate" required = "" aria-required = "true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
							<label for="requirementName">Requirement Name<span style = "color: red;">*</span></label>
						</div>
					</div>
					<div class="row" style = "padding-left: 10px;">
						<div class="input-field col s12">
							<input id="requirementDesc" type="text" class="validate" >
							<label for="requirementDesc">Requirement Description</label>
						</div>
					</div>
					<i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>

					<div class="modal-footer">
						<button onclick = "createRequirement()" name = "action" class="btn light-green" style = "color: black; margin-left: 10px; ">Confirm</button>
						<button name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</button>
					</div>
				</form>
			</div>

			<div id="modalLoading" class="modal" style = "width: 600px; height: 200px">
				<div class = "modal-header" style = "height: 55px;">
					<h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 2.5vw;">Please wait</h4>
				</div>
				<div class="row">
                  <div class="col s12 m4 center">
                    <div class="preloader-wrapper big active">
                      <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                          <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                          <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                          <div class="circle"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
			</div>
			

	        <!-- Modal Update -->
	        <div id="modalUpdateRequirement" class="modal" style = "width: 600px;" ng-controller="ctrl.updateRequirement">
	            <div class = "modal-header" style = "height: 55px; margin-bottom: 0px;">
	                <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">Update Requirement</h4>
	            </div>
	            <form class="modal-content" id="formUpdate" ng-submit="SaveRequirement()">

					<div class="row">
						<div class="input-field col s6">
							<input ng-model="update.intRequirementId" id="requirementToBeUpdated" type="hidden"/>
							<input ng-model="update.strRequirementName" placeholder = "Requirement Name" id="requirementNameUpdate" type="text" class="validate" required = "" aria-required = "true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
							<label class = "active" for="requirementNameUpdate">New Requirement Name<span style = "color: red;">*</span></label>
						</div>
					</div>

					<div class="row">
						<div class="input-field col s12">
							<input ng-model="update.strRequirementDesc" placeholder = "Requirement Description" id="requirementDescUpdate" type="text" class="validate">
							<label for="requirementNameUpdate">New Requirement Description</label>
						</div>
					</div>

					<i class = "left" style = "margin-bottom: 50px; padding-left: 10px; color: red;">*Required Fields</i>
					<br>

						<div class="modal-footer">
							<button type = "submit" name = "action" class="btn light-green bottom" style = "color: black; margin-top: 30px; margin-left: 10px; ">Confirm</button>
				</form>
							<button name = "action" class="btn light-green modal-close bottom" style = "color: black; margin-top: 30px;">Cancel</button>
						</div>


	        </div>

			<!-- Modal Archive Requirement-->
			<div id="modalArchiveRequirement" class="modal" style = "height: 400px; width: 600px;" ng-controller="ctrl.deactivateTable">
				<div class="modal-content">
					<!-- Data Grid Deactivated Requirement/s-->
					<div id="admin1" class="col s12" style="margin-top: 0px">
						<div class="z-depth-2 card material-table" style="margin-top: 0px">
							<div class="table-header" style="height: 45px; background-color: #00897b;">
								<h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 1.5vw; color: white; padding-left: 0px;">Archive Requirement/s</h4>
								<a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 60px; color: #ffffff;">search</i></a>
							</div>
							<table id="datatable2">
								<thead>
								<tr>
									<th>Name</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<tr ng-repeat="requirement in deactivatedRequirements">
									<td>@{{ requirement.strRequirementName }}</td>
									<td>
										<button ng-click="ReactivateRequirement(requirement.intRequirementId, $index)" name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
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
			<div class = "col s7" style = "margin-top: 20px; margin-left: 50px;" ng-controller="ctrl.requirementTable">
				<div class="row">
					<div id="admin">
						<div class="z-depth-2 card material-table">
							<div class="table-header" style="background-color: #00897b;">
								<h4 style = "font-family: myFirstFont2; font-size: 1.8vw; color: white; padding-left: 0px;">Requirement Record</h4>
								<div class="actions">
									<div id = "modalCreateBtn" style = "display: none;">
										<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Create Requirement" style = "margin-right: 10px;" href = "#modalCreateRequirement"><i class="material-icons" style = "color: black">add</i></button>
									</div>
									<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Requirement/s" style = "margin-right: 10px;" href = "#modalArchiveRequirement"><i class="material-icons" style = "color: black;">delete</i></button>
									<a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
								</div>
							</div>
							<table id="datatable">
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
									<td><button ng-click="UpdateRequirement(requirement.intRequirementId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
									<button ng-click="DeleteRequirement(requirement.intRequirementId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<script type="text/javascript" src = "../js/index.js"></script>
			</div>
	</div>

	<script>
		$('#buttonID').click(function(){
			$('#img').show();
			$.ajax({
					....
					success:function(result){
				$('#img').hide();  //<--- hide again
			}
		}
	</script>

	<script>
	
		$(document).ready(function(){
		    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
		    $('.modal-trigger').leanModal({dismissible: false});
		});
	
	</script>
</div>
	@endsection