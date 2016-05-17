@extends('maintenanceLayout')

@section('title', 'Service Maintenance')
@section('body')
     <link rel = "stylesheet" href = "{!! asset('/css/Services_Record_Form.css') !!}"/>
     <script type="text/javascript" src="{!! asset('/service/service-controller.js') !!}"></script>
     <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>

<div ng-app="serviceApp">
<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
	<div class = "row">
		<div class = "col s4">
			<div id="alertDiv">

			</div>
			<!-- Create Service -->
			<div class = "col s12" ng-controller="ctrl.newService">
				<div class = "aside aside z-depth-3" style = "margin-top: 20px; height: 430px; margin-left: 30px;" id="formCreate">
					<div class = "header">
						<h4 style = "font-family: myFirstFont2; font-size: 1.8vw;padding-top: 10px; margin-top: 10px;">Service Maintenance</h4>
					</div>
					<form id="formCreate" ng-submit="CreateNewService()">
						<div class="row" style = "padding-left: 10px;" id="formCreate">
							<div class = "row">
								<div class="input-field col s6">
									<input ng-model="strServiceName" id="serviceName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
									<label for="serviceName" data-error = "Invalid Format." data-success = "">Service Name <span style = "color: red;">*</span></label>
								</div>
								<div class="input-field col s6">
									<input ng-model="deciPrice" id="servicePrice" type="number" class="validate" min="1" max = "999999" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
									<label for="servicePrice" data-error = "Invalid Format." data-success = "">Service Price <span style = "color: red;">*</span></label>
								</div>
							</div>
							<div class="row" style = "padding-left: 0px;">
								<div class="input-field col s12">
									<input ng-model="strServiceDesc" id="serviceDesc" type="text" class="validate">
									<label for="serviceDesc" data-error = "Invalid Format." data-success = "">Service Description</label>
									<i class = "left" style = "margin-top: 0px; padding-left: 0px; color: red;">*Required Fields</i>
								</div>
							</div>
						</div>
						<div class = "row" style = "margin-top: -20px;">
							<button name = "action" class="modal-trigger btn light-green left" style = "color: black; font-size: 10px; width: 180px; margin-left: 20px;" href = "#modalRequirement">Choose Requirement</button>
						</div>
						<button type = "submit" name = "action" class="btn light-green right" style = "margin-top: 40px; color: black; margin-right: 10px;">Create</button>
					</form>


				</div>

			</div>
		</div>


            <!-- Modal Requirements -->
            <div id="modalRequirement" class="modal" style = "width: 600px;" ng-controller="ctrl.getRequirement">
                <div class = "modal-header" style = "height: 55px;">
                    <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">List of Requirement/s</h4>
                </div>
                <div class="modal-content">
                        <div class = "col s12">
                            <br>
                            <div class="row">
                                <div class = "col s6">
									<p ng-repeat="requirement in requirements">
                                        <input type="checkbox" id="@{{ requirement.intRequirementId }}" name="requirement[]" value="@{{ requirement.intRequirementId }}" />
                                        <label for="@{{ requirement.intRequirementId }}">@{{ requirement.strRequirementName }}</label>
                                    </p>
                                </div>

                                <div class = "col s6">
                                    
                                </div>
                            </div>
                        </div>
                        <br><br><br><br><br><br><br><br><br><br><br><br>

                <div class="modal-footer">
                    <button onclick="$('#modalRequirement').closeModal()" name = "action" class="btn light-green right" style = "color: black; margin-right: 0px; width: 130px;">CONFIRM</button>
					<button name = "action" class="waves-effect waves-light modal-close btn light-green" style = "color: black; margin-right: 10px;">Cancel</button>
                </div>
            </div>
        </div>


        <!-- Modal Update -->
        <div id="modalUpdateService" class="modal" style = "width: 550px;" ng-controller="ctrl.updateRequirement">
            <div class = "modal-header" style = "height: 55px;">
                <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw;">Update Service</h4>
            </div>
            <form class="modal-content" id="formUpdate" ng-submit="SaveRequirement()">

                    <div class="row" style = "padding-left: 10px;">
                        <div class="input-field col s6">
                        	<input ng-model="update.intServiceId" id="serviceToBeUpdate" type="hidden">
                            <input ng-model="update.strServiceName" id="serviceNameUpdate" value=" " type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                            <label id="updateName" for="serviceNameUpdate" data-error = "Check format field." data-success = "">New Service Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s6">
                            <input ng-model="update.deciPrice" id="servicePriceUpdate" value="0" type="number" class="validate" min="1" max="999999" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                            <label id="updatePrice" for="servicePriceUpdate" data-error = "Check format field." data-success = "">New Service Price <span style = "color: red;">*</span></label>
                        </div>
                    </div>

                <div class="row">
                        <div class="row" style = "padding-left: 10px;">
                            <div class="input-field col s12">
								<input ng-model="update.strServiceDesc" id="serviceDescUpdate" value=" " type="text" class="validate">
                                <label id="updateDesc" for="serviceDescUpdate" data-error = "Check format field." data-success = "">New Service Description</label>
                            </div>
                        </div>
                </div>
                <div class = "row" style = "margin-top: -20px;">
					<button name = "action" class="modal-trigger btn light-green left" style = "color: black; font-size: 10px; width: 180px; margin-left: 20px;" href = "#modalRequirement">Choose Requirement</button>
				</div>
			<div class="modal-footer" style = "margin-top: -50px;">
				<button type = "submit" name = "action" class="btn light-green" style = "margin-right: 30px; color: black; margin-left: 10px; ">Confirm</button>
            </form>
				<a name = "action" class="modal-close btn light-green" style = "color: black;">Cancel</a>
			</div>

        </div>

		<!-- Modal List of Requirement/s -->
		<div id="modalListOfRequirement" class="modal" style = "width: 550px;">
			<div class = "modal-header" style = "height: 55px;">
				<h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">List of Requirement/s</h4>
			</div>
			<div class="modal-content" ng-controller="ctrl.serviceTable">
				<ul class="collection with-header">
					<li class="collection-header"><h4 style = "padding-left: 150px; font-family: arial; font-size: 20px;">Requirement List</h4></li>
					<div ng-repeat="serviceRequirement in serviceRequirements">
					<li class="collection-item">@{{ serviceRequirement.requirement.strRequirementName }}</li>
					</div>
				</ul>
			</div>
			<div class="modal-footer">
				<button name = "action" class="modal-close btn light-green" style = "color: black; margin-right: 20px;">Done</button>
			</div>
		</div>

        <!-- Modal Deactivate -->
        <div id="modalDeactivateService" class="modal" style = "width: 400px;">
            <div class = "modal-header" style = "height: 55px;">
                <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">Deactivate Service</h4>
            </div>
            <div class="modal-content">
				<input id="serviceToBeDeactivated" type="hidden">
				<p style = "padding-left: 20px; font-size: 15px;">Are you sure you want to deactivate this service?</p>
            </div>
            <div class="modal-footer">
                <button onclick="deactivateService()" name = "action" class="btn light-green" style = "color: black; margin-left: 10px; ">Confirm</button>
                <button name = "action" class="modal-close btn light-green" style = "color: black;">Cancel</button>
            </div>
        </div>

		<!-- Modal Archive Service-->
		<div id="modalArchiveService" class="modal" style = "height: 400px; width: 600px;" ng-controller="ctrl.deactivatedTable">
			<div class="modal-content">
				<!-- Data Grid Deactivated Service/s-->
				<div id="admin1" class="col s12" style="margin-top: 0px">
					<div class="z-depth-2 card material-table" style="margin-top: 0px">
						<div class="table-header" style="height: 45px; background-color: #00897b;">
							<h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 1.8vw; color: white; padding-left: 0px;">Archive Service/s</h4>
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
							<tr ng-repeat="service in deactivatedServices">
								<td>@{{ service.strServiceName }}</td>
								<td>
									<button ng-click="ReactivateService(service.intServiceId, $index)" name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<button name = "action" class="btn light-green modal-close right" style = "margin-bottom: 10px; margin-right: 30px; color: black;">DONE</button>
		</div>


		<!-- Data Grid -->
		<div class = "col s7" style = "margin-left: 50px; margin-top: 20px;" ng-controller="ctrl.serviceTable">
			<div class="row">
				<div id="admin">
					<div class="z-depth-2 card material-table">
						<div class="table-header" style="background-color: #00897b;">
							<h4 style = "font-size: 1.8vw; color: white; padding-left: 0px; font-family: myFirstFont2;">Service Record</h4>
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
    </div>
    @endsection