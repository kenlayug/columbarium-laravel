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
									<label for="serviceName" data-error = "Invalid Format." data-success = "">Service Name <span style = "color: red;">*</span></label>
								</div>
								<div class="input-field col s6">
									<input ng-model="deciPrice" id="servicePrice" type="number" class="validate" min="1" max = "999999" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
									<label for="servicePrice" data-error = "Invalid Format." data-success = "">Service Price <span style = "color: red;">*</span></label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input ng-model="strServiceDesc" id="serviceDesc" type="text" class="validate">
									<label for="serviceDesc" data-error = "Invalid Format." data-success = "">Service Description</label>
									<i class = "createReqField left">*Required Fields</i>
								</div>
							</div>

						</div>
						<div class = "row btnRequirement">
							<button name = "action" class="modal-trigger btn light-green left" style = "color: black; font-size: 10px; width: 180px; margin-left: 20px;" href = "#modalRequirement">Choose Requirement</button>
							<div class = "col s6">
								<form action="#">
									<p class = "checkbox">
										<input type="checkbox" id="test5" />
										<label for="test5">Unit?</label>
									</p>
								</form>
							</div>
						</div>
						<button type = "submit" name = "action" class="btn light-green right" style = "margin-top: 40px; color: black; margin-right: 10px;">Create</button>
					</form>


				</div>

			</div>
		</div>


            <!-- Modal Requirements -->
            <div id="modalRequirement" class="modalRequirement modal" ng-controller="ctrl.getRequirement">
                <div class = "modal-header">
                    <h4 class = "listOfReqH4">List of Requirement/s</h4>
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
        <div id="modalUpdateService" class="modalUpdate modal" ng-controller="ctrl.updateRequirement">
            <div class = "modal-header">
                <h4 class = "updateService">Update Service</h4>
            </div>
            <form class="modal-content" id="formUpdate" ng-submit="SaveRequirement()">

                    <div class="updateFormStyle row">
                        <div class="input-field col s6">
                        	<input ng-model="update.intServiceId" id="serviceToBeUpdate" type="hidden">
                            <input ng-model="update.strServiceName" id="serviceNameUpdate" value=" " type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
                            <label id="updateName" for="serviceNameUpdate" data-error = "Check format field." data-success = "">New Service Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s6">
                            <input ng-model="update.deciPrice" id="servicePriceUpdate" value="0" type="number" class="validate" min="1" max="999999" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                            <label id="updatePrice" for="servicePriceUpdate" data-error = "Check format field." data-success = "">New Service Price <span style = "color: red;">*</span></label>
                        </div>
                    </div>

                <div class="row">
                        <div class="serviceDesc row">
                            <div class="input-field col s12">
								<input ng-model="update.strServiceDesc" id="serviceDescUpdate" value=" " type="text" class="validate">
                                <label id="updateDesc" for="serviceDescUpdate" data-error = "Check format field." data-success = "">New Service Description</label>
                            </div>
                        </div>
                </div>
                <div class = "btnUpdateReq row">
					<button name = "action" class="modal-trigger btn light-green left" style = "color: black; font-size: 10px; width: 180px; margin-left: 20px;" href = "#modalRequirement">Choose Requirement</button>
					<div class = "col s6">
						<form action="#">
							<p class = "checkbox">
								<input type="checkbox" id="test5" />
								<label for="test5">Unit?</label>
							</p>
						</form>
					</div>
				</div>
			<div class="btnUpdateConfirm modal-footer">
				<button type = "submit" name = "action" class="btn light-green" style = "margin-right: 30px; color: black; margin-left: 10px; ">Confirm</button>
            </form>
				<a name = "action" class="modal-close btn light-green" style = "color: black;">Cancel</a>
			</div>

        </div>

		<!-- Modal List of Requirement/s -->
		<div id="modalListOfRequirement" class="modalListOfReq modal">
			<div class = "modal-header">
				<h4 class = "modalListOfReqH4">List of Requirement/s</h4>
			</div>
			<div class="modal-content" ng-controller="ctrl.serviceTable">
				<ul class="collection with-header">
					<li class="collection-header"><h4 class = "requirementList">Requirement List</h4></li>
					<div ng-repeat="serviceRequirement in serviceRequirements">
					<li class="collection-item">@{{ serviceRequirement.requirement.strRequirementName }}</li>
					</div>
				</ul>
			</div>
			<div class="modal-footer">
				<button name = "action" class="modal-close btn light-green" style = "color: black; margin-right: 20px;">Done</button>
			</div>
		</div>

		<!-- Modal Archive Service-->
		<div id="modalArchiveService" class="modalArchive modal" ng-controller="ctrl.deactivatedTable">
			<div class="modal-content">
				<!-- Data Grid Deactivated Service/s-->
				<div id="admin1" class="col s12">
					<div class="z-depth-2 card material-table">
						<div class="table-header">
							<h4 class = "archiveServiceH4" >Archive Service/s</h4>
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
    </div>
    @endsection