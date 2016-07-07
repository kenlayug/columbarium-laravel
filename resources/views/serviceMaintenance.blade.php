@extends('v2.baseLayout')

@section('title', 'Service Maintenance')
@section('body')
	 <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
     <link rel = "stylesheet" href = "{!! asset('/css/serviceMaintenance.css') !!}"/>
     <script type="text/javascript" src="{!! asset('/service/controller.js') !!}"></script>
     <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>

<div ng-controller="ctrl.service">
<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
	<div class = "row">
		<div class = "col s4">
			<!-- Create Service -->
			<div class = "col s12">
				<div class = "formCreate aside aside z-depth-3" id="formCreate">
					<div class = "createFormHeader">
						<h4 class = "formCreateH4">Service Maintenance</h4>
					</div>
					<form ng-submit="saveService()">
						<div class="formCreateStyle row" id="formCreate">
							<div class = "row">
								<div class="input-field col s6">
									<input ng-model="newService.strServiceName" id="serviceName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Installation" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
									<label for="serviceName" data-error = "Invalid Format." data-success = "">Name<span style = "color: red;">*</span></label>
								</div>
								<div class="input-field col s6">
									<input ng-model="newService.deciPrice"
                                           ui-number-mask
                                           id="servicePrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" min="1" max = "999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
									<label for="servicePrice" data-error = "Invalid Format." data-success = "">Price<span style = "color: red;">*</span></label>
								</div>
							</div>
								<div class="input-field col s12">
									<input ng-model="newService.strServiceDesc" id="serviceDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Service offered to add additionals in a certain unit.">
									<label for="serviceDesc" data-error = "Invalid Format." data-success = "">Description</label>
								</div>
							<div class = "serviceCategory row">
								<div class="input-field col s6">
									<select ng-model="newService.intServiceCategoryId" id="selectServiceCategory" material-select>
										<option value="" disabled selected>Choose Category</option>
                                        <option ng-repeat="serviceCategory in serviceCategoryList" value="@{{ serviceCategory.intServiceCategoryId }}">@{{ serviceCategory.strServiceCategoryName }}</option>
									</select>
								</div>
								<a type = "submit" name = "action" class="modal-trigger btn light-green right" style = "color: black; margin-right: 10px; margin-top: 20px;" href = "#modalServiceCategory">New Category</a>
							</div>
                            <div class = "row">
                                <div class="input-field col s6">
                                    <select ng-model="newService.boolUnit" id="selectserviceType" material-select>
                                        <option class = "serviceType" value="" disabled selected>Type</option>
                                        <option value="1" class = "serviceType">Unit Servicing</option>
                                        <option value="0" class = "serviceType">Others</option>
                                    </select>
                                </div>
                                <button name = "action" class="modal-trigger btn light-green left" style = "color: black; font-size: 10px; width: 180px; margin-top: 20px; margin-left: 0px;" href = "#modalRequirement">Choose Requirement</button>
                            </div>
						</div>
                        <i class = "createReqField left" style = "padding-left: 20px;">*Required Fields</i>
						<button type = "submit" name = "action" class="btn light-green right" style = "margin-top: 30px; color: black; margin-right: 10px;">Create</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Data Grid -->
		<div class = "serviceDataGrid col s7" style = "margin-left: 50px;">
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
						<table id="datatable" datatable="ng">
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
							<tr ng-repeat="service in serviceList">
								<td>@{{ service.strServiceName }}</td>
								<td>@{{ service.price.deciPrice | currency: "₱"}}</td>
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

	<button class = "modal-trigger" href = "#modalUpdateService">OK</button>

	<!-- Modal Update -->
	<div id="modalUpdateService" class="modalUpdate modal modal-fixed-footer">
		<div class = "modal-header">
			<h4 class = "updateService">Update Service</h4>
		</div>
		<form class="modal-content" id="formUpdate">

			<div class="updateFormStyle row">
				<div class="input-field col s6">
					<input ng-model="update.intServiceId" id="serviceToBeUpdate" type="hidden">
					<input ng-model="update.strServiceName" id="serviceNameUpdate" value=" " type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Installation" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
					<label id="updateName" for="serviceNameUpdate" data-error = "Check format field." data-success = "">New Name<span style = "color: red;">*</span></label>
				</div>
				<div class="input-field col s6">
					<input ng-model="update.deciPrice" id="servicePriceUpdate" value="0" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" min="1" max="999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
					<label id="updatePrice" for="servicePriceUpdate" data-error = "Check format field." data-success = "">New Price<span style = "color: red;">*</span></label>
				</div>
			</div>
			<div class="input-field col s12" style = "margin-top: -10px; margin-left: 20px;">
				<input ng-model="update.strServiceDesc" id="serviceDescUpdate" value=" " type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Service offered to add additionals in a certain unit.">
				<label id="updateDesc" for="serviceDescUpdate" data-error = "Check format field." data-success = "">New Description</label>
			</div>
			<div class = "serviceCategory row" style = "margin-left: 10px; margin-top: 0px;">
				<div class="input-field col s6">
					<select class="browser-default" id="selectServiceCategory">
						<option value="" disabled selected>Choose Category</option>
						<option value="">Category</option>
						<option class = "serviceType">Others</option>
					</select>
				</div>
				<button type = "submit" name = "action" class="modal-trigger btn light-green right" style = "color: black; margin-right: 10px; margin-top: 20px; width: 220px;" href = "#modalServiceCategory">New Category</button>
			</div>
			<div class = "row" style = "margin-top: -20px; margin-left: 10px;">
				<div class="input-field col s6">
					<select class="browser-default" id="selectserviceType">
						<option class = "serviceType" value="" disabled selected>Type</option>
						<option class = "serviceType">Unit Servicing</option>
						<option class = "serviceType">Others</option>
					</select>
				</div>
				<button name = "action" class="modal-trigger btn light-green left" style = "color: black; font-size: 12px; width: 220px; margin-top: 20px; margin-left: 40px;" href = "#modalRequirement">Choose Requirement</button>
			</div>
			<i class = "createReqField left" style = "padding-left: 20px;">*Required Fields</i>
			<div class="btnUpdateConfirm modal-footer" style = "height: 55px; width: 570px;">
				<button type = "submit" name = "action" class="btn light-green" style = "margin-right: 20px; color: black; margin-left: 10px; ">Confirm</button>
				<button name = "action" class="modal-close btn light-green" style = "color: black;">Cancel</button>
			</div>
		</form>
	</div>

	<div id="modalViewRequirement" class="modal modal-fixed-footer" style = "width: 500px; height: 450px;">
		<div class = "modal-header">
			<h4 style = "font-family: fontSketch; font-size: 2.2vw; color: white; padding-left: 85px;">List of Requirement</h4>
		</div>
		<div class="modal-content">
			<ul class="collection with-header">
				<li class="collection-header"><h4 class = "additionalListH4" style = "font-size: 20px;">Requirement List</h4></li>
				<div>
					<li class="collection-item">Valid ID</li>
				</div>
			</ul>
		</div>
		<div class="modal-footer">
			<button name = "action" class="btnRequirementDone modal-close btn light-green" style = "margin-right: 20px; color: black;">Done</button>
		</div>
	</div>

    <script>
//		$('input.number').keyup(function(event) {
//
//			// skip for arrow keys
//			if(event.which >= 37 && event.which <= 40){
//				event.preventDefault();
//			}
//
//			$(this).val(function(index, value) {
//				value = value.replace(/,/g,''); // remove commas from existing input
//				return numberWithCommas(value); // add commas back in
//			});
//		});
//		function numberWithCommas(x) {
//
//			var parts = x.toString().split(".");
//			parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//			return parts.join(".");
//		}

	    $(document).ready(function(){
	        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
	        $('.modal-trigger').leanModal({dismissible: false});
	    });
	</script>

	@include('modals.service.archive')
	@include('modals.service.requirements')
	@include('modals.service.category')
</div>
@endsection