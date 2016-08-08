@extends('maintenanceLayout')
@section('title', 'Requirement Maintenance')

@section('body')
	<script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/requirementMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/requirement/requirement-controller.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>

    <script type="text/javascript">
    	$(document).ready(function() {
    	$('select').material_select();
  	});
    </script>

<!-- Package-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select>
		    	<option value="" disabled selected>Choose your filter</option>
		    	<option value="1">Installment</option>
		    	<option value="2">Exhumation</option>
	      	<option value="3">Cremation</option>
    	  </select>	    	
        <label>Service Name</label>
	  	</div>
    
      <div class="col s9">
    	  <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 30%;">Package Queries</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatablePackage">
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
              <tr>
                <td>Bone Cremation</td>
                <td></td>
                <td>Cremation</td>
                <td>Pouch</td>
                <td>P 19,000.00</td>
              </tr>
              <tr>
                <td>Bone Cremation</td>
                <td></td>
                <td>Cremation</td>
                <td>Pouch</td>
                <td>P 19,000.00</td>
              </tr>
              <tr>
                <td>Bone Cremation</td>
                <td></td>
                <td>Cremation</td>
                <td>Pouch</td>
                <td>P 19,000.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Package -->

<!-- Service -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Unit Servicing</option>
            <option value="2">Scheduled Service</option>
            <option value="3">For Return</option>
        </select>
        <label>Service Category</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 30%;">Service Queries</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableService">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Cremation</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>Cremation</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>Cremation</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Service -->

<!-- Additionals -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Urn</option>
            <option value="2">Holder</option>
            <option value="3">Epitaph</option>
        </select>
        <label>Additionals Category</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 30%;">Additionals Queries</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableAdditionals">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Candle Holder</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>Candle Holder</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>Candle Holder</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Additionals -->

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
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 30%;">Unit Price Queries</h5>
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
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 30%;">Block Queries</h5>
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
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 30%;">Room Queries</h5>
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
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 30%;">Building Queries</h5>
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


<!-- Interest -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Pre-Need</option>
            <option value="2">At-Need</option>
        </select>
        <label>Interest Status</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 30%;">Interest Queries</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableInterest">
            <thead>
              <tr>
                <th>No. of Years</th>
                <th>Interest Rate</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>4</td>
                <td>4.00%</td>         
              </tr>
              <tr>
                <td>4</td>
                <td>4.00%</td>         
              </tr>
              <tr>
                <td>4</td>
                <td>4.00%</td>         
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Interest -->

    <div ng-app="requirementApp">
	<!-- Section -->
	<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
		<div class = "row">
			<div class = "col s12 m6 l4" id = "fadeShow">
				<!-- Create Requirement -->
				<div ng-controller="ctrl.newRequirement">
					<form class = "createForm aside aside z-depth-3" id="formCreate" ng-submit="SaveRequirement()" autocomplete="off">
						<div class = "createFormHeader">
							<h4 class = "createFormH4">Requirement Maintenance</h4>
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

						<i class = "createFormReqField left">*Required Fields</i>
						<br>
						<button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-top: 30px; margin-right: 10px;">Create</button>

					</form>
				</div>
			</div>

			<!-- Data Grid -->
			<div class = "requirementDataGrid col s12 m6 l8" ng-controller="ctrl.requirementTable">
				<div class="row">
					<div id="admin">
						<div class="z-depth-2 card material-table">
							<div class="table-header">
								<h4 class = "requirementDataGridH4">Requirement Record</h4>
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
									<td><button ng-click="UpdateRequirement(requirement.intRequirementId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
									<button ng-click="DeleteRequirement(requirement.intRequirementId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
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