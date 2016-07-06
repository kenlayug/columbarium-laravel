@extends('v2.baseLayout')
@section('title', 'Additional Maintenance')
@section('body')
	    <!-- Import CSS/JS -->


	    <link rel = "stylesheet" href = "{!! asset('/css/additionalsMaintenance.css') !!}"/>
	    <script type="text/javascript" src="{!! asset('/additional/js/additionalController.js') !!}"></script>
	    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>

<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
	<div class = "row">
		<div class = "col s4" id = "fadeShow">

			<!-- Create Additionals -->
			<div class = "col s12" ng-controller="ctrl.newAdditional">
				<form ng-submit="SaveNewAdditional()" class = "formCreate aside aside z-depth-3" id="formCreate">
					<div class = "createHeader">
						<h4>Additionals Maintenance</h4>
					</div>
					<div class = "row">
						<div class = "itemName">
							<div class="input-field col s6">
								<input ng-model="additional.strAdditionalName" id="itemName" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Metallic Urn" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
								<label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
							</div>
						</div>
						<div class = "itemPrice">
							<div class="input-field col s6">
								<input ng-model="additional.deciPrice" id="itemPrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places.<br>*Example: P 0.00" name="item.dblPrice" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
								<label id="createPrice" for="itemPrice" data-error = "Invalid Format." data-success = "">Price<span style = "color: red;">*</span></label>
							</div>
						</div>
					</div>
					<div class = "additionalCategory row">
						<div class="input-field col s6">
							<select id="selectItemCategory" ng-model="additional.intAdditionalCategoryId" material-select>
								<option class = "additionalCategory2" value="" disabled selected>Choose Category</option>
								<option ng-repeat="additionalCategory in additionalCategories" value="@{{ additionalCategory.intAdditionalCategoryId }}">@{{ additionalCategory.strAdditionalCategoryName }}</option>
							</select>
						</div>
						<button type = "submit" name = "action" class="btnAdditionals modal-trigger btn light-green right" href = "#modalItemCategory">New Category</button>
					</div>
					<div class="additionalsDesc row">
						<div class="input-field col s12">
							<input ng-model="additional.strAdditionalDesc" id="itemDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric and special characters.<br>*Example: Storage for ash/bones." name="item.strItemDesc">
							<label id="createDesc" for="itemDesc" data-error = "Invalid Format" data-success = "">Description</label>
						</div>
					</div>
					<i class = "requiredField left">*Required Fields</i>
					<br><br>
					<button type = "submit" name = "action" class="btnCreate btn light-green right">Create</button>
				</form>
			</div>
		</div>



			<!-- Data Grid -->
			<div class = "dataGrid col s7" ng-controller="ctrl.additionalTable">
				<div class="row">
					<div id="admin">
						<div class="z-depth-2 card material-table">
							<div class="table-header">
								<h3>Additionals Record</h3>
								<div class="actions">
									<div id = "modalCreateBtn" style = "display: none;">
										<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Create Additionals" style = "margin-right: 10px;" href = "#modalCreateItem"><i class="material-icons" style = "color: black">add</i></button>
									</div>
									<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Additionals" style = "margin-right: 10px;" href = "#modalArchiveItem"><i class="material-icons" style = "color: black">delete</i></button>
									<a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
								</div>
							</div>
							<table id="datatable" datatable="ng">
								<thead >
								<tr>
									<th style = "font-size: .9vw; color: black;">Name</th>
									<th style = "font-size: .9vw; color: black;">Price</th>
									<th style = "font-size: .9vw; color: black;">Category</th>
									<th style = "font-size: .9vw; color: black;">Description</th>
									<th style = "font-size: .9vw; color: black;">Action</th>
								</tr>
								</thead>
								<tbody>
									<tr ng-repeat="additional in additionals">
										<td>@{{ additional.strAdditionalName }}</td>
										<td>@{{ additional.price.deciPrice|currency: "₱" }}</td>
										<td>@{{ additional.category.strAdditionalCategoryName }}</td>
										<td>@{{ additional.strAdditionalDesc }}</td>
										<td><button ng-click="UpdateAdditional(additional.intAdditionalId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
											<button ng-click="DeactivateAdditional(additional.intAdditionalId, $index)" name = "action" class="btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Additionals"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">
		$('input.number').keyup(function(event) {

			// skip for arrow keys
			if(event.which >= 37 && event.which <= 40){
				event.preventDefault();
			}

			$(this).val(function(index, value) {
				value = value.replace(/,/g,''); // remove commas from existing input
				return numberWithCommas(value); // add commas back in
			});
		});

		function numberWithCommas(x) {

			var parts = x.toString().split(".");
			parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			return parts.join(".");
		}

		$(document).ready(function(){
			// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
			$('.modal-trigger').leanModal({dismissible: false});
		});

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
	</script>

@include('modals.additionals.update')
@include('modals.additionals.additionalsCategory')
@include('modals.additionals.archive')

@endsection