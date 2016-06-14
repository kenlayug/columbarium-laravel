@extends('maintenanceLayout')

@section('title', 'Additional Maintenance')
@section('body')
	    <!-- Import CSS/JS -->

	    <link rel = "stylesheet" href = "{!! asset('/css/additionalsMaintenance.css') !!}"/>
	    <script type="text/javascript" src="{!! asset('/additional/js/additionalController.js') !!}"></script>
	    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>

<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
	<div class = "row">
		<div class = "col s4" id = "fadeShow">

			<!-- Create Items -->
			<div class = "col s12" ng-controller="ctrl.newAdditional">
				<form ng-submit="SaveNewAdditional()" class = "formCreate aside aside z-depth-3" id="formCreate">
					<div class = "createHeader">
						<h4>Additionals Maintenance</h4>
					</div>
					<div class = "row">
						<div class = "itemName">
							<div class="input-field col s6">
								<input ng-model="additional.strAdditionalName" id="itemName" type="text" class="validate" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
								<label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Additionals Name<span style = "color: red;">*</span></label>
							</div>
						</div>
						<div class = "itemPrice">
							<div class="input-field col s6">
								<input ng-model="additional.deciPrice" id="itemPrice" type="text" class="validate" name="item.dblPrice" required = "" min="1" max="999999" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
								<label id="createPrice" for="itemPrice" data-error = "Invalid Format." data-success = "">Additionals Price<span style = "color: red;">*</span></label>
							</div>
						</div>
					</div>

					<div class = "additionalCategory row">
						<div class="input-field col s6">
							<select class="browser-default" id="selectItemCategory" ng-model="additional.intAdditionalCategoryId">
								<option class = "additionalCategory2" value="" disabled selected>Addionals Category</option>
								<option ng-repeat="additionalCategory in additionalCategories" value="@{{ additionalCategory.intAdditionalCategoryId }}">@{{ additionalCategory.strAdditionalCategoryName }}</option>
							</select>
						</div>
						<button type = "submit" name = "action" class="btnAdditionals modal-trigger btn light-green right" href = "#modalItemCategory">New Category</button>
					</div>


					<div class="additionalsDesc row">
						<div class="input-field col s12">
							<input ng-model="additional.strAdditionalDesc" id="itemDesc" type="text" class="validate" name="item.strItemDesc">
							<label id="createDesc" for="itemDesc" data-error = "Invalid Format" data-success = "">Additionals Description</label>
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
							<td>@{{ additional.price.deciPrice }}</td>
							<td>@{{ additional.category.strAdditionalCategoryName }}</td>
							<td>@{{ additional.strAdditionalDesc }}</td>
							<td><button ng-click="UpdateAdditional(additional.intAdditionalId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
								<button ng-click="DeactivateAdditional(additional.intAdditionalId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
</div>


			<!-- Modal Create Additionals -->
			<div id="modalCreateItem" class="modal" style = "width: 600px;">
				<div class = "modal-header" style = "height: 55px;">
					<h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 2.5vw;">Create Additionals</h4>
				</div>
				<form class="form">
					<div class = "row">
						<div style = "padding-left: 10px;">
							<div class="input-field col s6">
								<input id="itemName" type="text" class="validate" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
								<label for="itemName" data-error = "Invalid format." data-success = "">Item Name<span style = "color: red;">*</span></label>
							</div>
						</div>
						<div style = "padding-left: 10px;">
							<div class="input-field col s6">
								<input id="itemPrice" type="text" class="validate" name="item.dblPrice" required = "" min="1" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
								<label for="itemPrice" data-error = "Invalid Format." data-success = "">Item Price<span style = "color: red;">*</span></label>
							</div>
						</div>
					</div>

					<div class = "row" style = "padding-left: 10px;">
						<div class="input-field col s6">
							<select id="selectItemCategory">
								<option value="" disabled selected>Item Category</option>
								<c:if test="${itemCategoryList != null}">
									<c:forEach items="${itemCategoryList }" var="itemCategory">
										<option value="${itemCategory.strItemCategoryDesc }">${itemCategory.strItemCategoryDesc }</option>
									</c:forEach>
								</c:if>
							</select>
							<label>Select Item Category</label>
						</div>
						<button type = "submit" name = "action" class="modal-trigger btn light-green right" style = "color: black; margin-top: 20px; margin-right: 10px;" href = "#modalItemCategory">Item Category</button>
					</div>


					<div class="row" style = "padding-left: 10px;">
						<div class="input-field col s12">
							<input id="itemDesc" type="text" class="validate" name="item.strItemDesc">
							<label for="itemDesc" data-error = "Invalid Format" data-success = "">Item Description</label>
						</div>
					</div>
					<i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>

					<div class="modal-footer">
						<button onclick = "createItem()" name = "action" class="btn light-green" style = "color: black; margin-left: 10px; ">Confirm</button>
						<button name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</button>
					</div>
				</form>
			</div>
	
	        <!-- Modal Update -->
	        <div id="modalUpdateItem" class="modalUpdateItem modal" ng-controller="ctrl.updateAdditional">
	            <div class = "itemHeaderUpdate modal-header">
	                <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw;">Update Additionals</h4>
	            </div>
					<form id="formUpdate" ng-submit="SaveAdditional()">
						<br>
		                <div class = "col s12">
		                    <div class = "row">
		                        <div class = "itemNameUpdate">
		                            <div class="input-field col s6">
		                            	<input ng-model="update.intAdditionalId" id="itemNameToBeUpdated" type="hidden"/>
		                                <input ng-model="update.strAdditionalName" value=" " id="itemNameUpdate" type="text" class="validate" name="item.strItemName" required = ""  minlength = "1" maxlength="50" length = "50" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
		                                <label id="lblUpdateName" class="active" for="itemNameUpdate" data-error = "Invalid format." data-success = "">New Additionals Name<span style = "color: red;">*</span></label>
		                            </div>
		                        </div>
		                        <div class = "itemPriceUpdate">
		                            <div class="input-field col s6">
		                                <input ng-model="update.deciPrice" value="0" id="itemPriceUpdate" type="number" class="validate" name="item.dblPrice" required = "" min="1" max = "999999" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
		                                <label id="lblUpdatePrice" class="active" for="itemPriceUpdate" data-error = "Invalid format." data-success = "">New Additionals Price<span style = "color: red;">*</span></label>
		                            </div>
		                        </div>
		                    </div>
		                </div>
	
	                    <div class = "itemDescUpdate">
	                        <div class="input-field col s12">
	                            <input ng-model="update.strAdditionalDesc" value=" " id="itemDescUpdate" type="text" class="validate" name="item.strItemDesc">
	                            <label id="lblUpdateDesc" class="active" for="itemDescUpdate" data-error = "Invalid format." data-success = "">New Additionals Description</label>
	                        </div>
	                    </div>

					<i class = "requiredField left">*Required Fields</i>
					<br>

					<div class="modal-footer">
							<button type="submit" name="action" class="btnModalUpdateConfirm btn light-green">Confirm</button>

				</form>
						<a class="btnModalUpdateCancel btn light-green modal-close">Cancel</a>
					</div>
	        </div>


			<!-- Modal Deactivate -->
			<div id="modalDeactivateItem" class="modalDeactivateItem modal">
				<div class = "modalDeactivateHeader modal-header">
					<h4>Deactivate Additionals</h4>
				</div>
				<div class="modal-content">
					<p>Are you sure you want to deactivate this additionals?</p>
				</div>
				<input id="itemToBeDeactivated" type="hidden"/>
				<div class="modal-footer">
					<button onclick = "deactivateItem()" name = "action" class="btnConfirm btn light-green">Confirm</button>
					<button name = "action" class="btnCancel btn light-green modal-close">Cancel</button>
				</div>
			</div>

			<!-- Modal Additionals Category -->
			<form id="modalItemCategory" class="modalItemCategory modal" ng-controller="ctrl.newAdditionalCategory" ng-submit="SaveAdditionalCategory()">
				<div class = "modalCategoryHeader modal-header">
					<h4 class = "text">Additionals Category</h4>
				</div>
				<div class="modal-content" id="formCreateItemCategory">
					<div class = "additionalsNewCategory">
						<div class="input-field col s12">
							<input ng-model="additionalCategory.strAdditionalCategoryName" id="itemCategoryDesc" type="text" class="validate" name="item.strItemCategory" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
							<label for="itemCategoryDesc" data-error = "Invalid format." data-success = "">Additionals Category<span style = "color: red;">*</span></label>
							<i class = "modalCatReqField left">*Required Fields</i>
						</div>
						<br>
					</div>

				</div>
					<div class="modal-footer">
						<button name = "action" class="btnConfirmCategory btn light-green">Confirm</button>
						<a name = "action" class="btnCancel btn light-green modal-close" style = "margin-right: 10px;">Cancel</a>
					</div>

			</form>

			<!-- Modal Archive Additionals-->
			<div id="modalArchiveItem" class="modalArchive modal" ng-controller="ctrl.deactivatedTable">
				<div class="modalArchiveContent modal-content">
					<!-- Data Grid Deactivated Additionals/s-->
					<div id="admin1" class="col s12">
						<div class="z-depth-2 card material-table">
							<div class="table-header">
								<h4>Archive Additionals</h4>
								<a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 270px; color: #ffffff;">search</i></a>
							</div>
							<table id="datatable2">
								<thead>
								<tr>
									<th>Name</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<tr ng-repeat="additional in deactivatedAdditionals">
									<td>@{{ additional.strAdditionalName }}</td>
									<td>
										<button ng-click="ReactivateAdditional(additional.intAdditionalId, $index)" name = "action" class="btnActivate btn light-green modal-close">Activate</button>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

	<script type="text/javascript">
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


@endsection