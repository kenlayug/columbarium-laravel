@extends('maintenanceLayout')

@section('body')

		    <!-- Import CSS/JS -->

		    <link rel = "stylesheet" href = "{!! asset('/css/Inventory_Form.css') !!}"/>
			<script type="text/javascript" src="{!! asset('/additional/js/additionalController.js') !!}"></script>
			<script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>

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

	<!-- Section --> 
	<div ng-app="additionalController">
	<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
		<div class = "row">
			<div class = "col s4" id = "fadeShow">
				<div id="alertDiv">
				</div>

				<!-- Create Items -->
				<div class = "col s12" ng-controller="ctrl.newAdditional">
					<form class = "aside aside z-depth-3" style = "margin-top: 20px; height: 430px; margin-left: 30px;" id="formCreate" ng-submit="CreateNewAdditional()">
						<div class = "header">
							<h4 style = "font-family: myFirstFont2; font-size: 1.8vw;padding-top: 10px; margin-top: 10px;">Additional Maintenance</h4>
						</div>
						<div class = "row">
							<div style = "padding-left: 10px;">
								<div class="input-field col s6" style = "font-size: 1vw;">
									<input type="hidden" name="_token" value="{!! csrf_token() !!}">
									<input ng-model="strAdditionalName" id="itemName" type="text" class="validate" name="strAdditionalName" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
									<label for="itemName" data-error = "Invalid format." data-success = "">Additionals Name<span style = "color: red;">*</span></label>
								</div>
							</div>
							<div style = "padding-left: 10px;">
								<div class="input-field col s6">
									<input ng-model="deciPrice" id="itemPrice" type="text" class="validate" name="deciPrice" required = "" min="1" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
									<label for="itemPrice" data-error = "Invalid Format." data-success = "">Additionals Price<span style = "color: red;">*</span></label>
								</div>
							</div>
						</div>

						<div class = "row" style = "padding-left: 10px;">
							<div class="input-field col s6">
								<select name="additionalCategory" ng-model="selectedItem" ng-options="additionalCategory as additionalCategory.strAdditionalCategoryName for additionalCategory in additionalCategories | orderBy: 'strAdditionalCategoryName'" material-select ng-if="hasLoaded" ng-change="getSelectValue(selectedItem)">
									<option value="" disabled selected>Additional Category</option>
								</select>
								<label>Select Additionals Category</label>
							</div>
							<button type = "submit" name = "action" class="modal-trigger btn light-green right" style = "font-size: 10px; color: black; margin-top: 20px; margin-right: 10px;" href = "#modalItemCategory">Additionals Category</button>
						</div>


						<div class="row" style = "padding-left: 10px;">
							<div class="input-field col s12">
								<input ng-model="strAdditionalDesc" id="itemDesc" type="text" class="validate" name="strAdditionalDesc">
								<label for="itemDesc" data-error = "Invalid Format" data-success = "">Addionals Description</label>
							</div>
						</div>
						<i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>
						<br>
						<button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-right: 10px;">Create</button>
					</form>

				</div>
			</div>


	<!-- Data Grid -->
	<div class = "col s7" style = "height: 500px; margin-top: 20px; margin-left: 40px;">
		<div class="row">
			<div id="admin">
				<div class="z-depth-2 card material-table" ng-controller="ctrl.tblAdditionals">
					<div class="table-header" style="background-color: #00897b;">
						<h4 style = "font-family: myFirstFont2; font-size: 1.8vw; color: white; padding-left: 0px;">Additionals Record</h4>
						<div class="actions">
							<div id = "modalCreateBtn" style = "display: none;">
								<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Create Additionals" style = "margin-right: 10px;" href = "#modalCreateItem"><i class="material-icons" style = "color: black">add</i></button>
							</div>
							<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Additionals" style = "margin-right: 10px;" href = "#modalArchiveItem"><i class="material-icons" style = "color: black">delete</i></button>
							<a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
						</div>
					</div>
					<table id="datatable">
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
							<tr ng-repeat="additional in additionals | orderBy: 'strAdditionalName'">
								<td>@{{additional.strAdditionalName}}</td>
								<td>@{{ additional.price.deciPrice | currency }}</td>
								<td>@{{ additional.additional_category.strAdditionalCategoryName }}</td>
								<td>@{{additional.strAdditionalDesc}}</td>
								<td><button name = "action" class="modal-trigger btn-floating light-green" ng-click="UpdateAdditional(additional.intAdditionalId, $index)"><i class="material-icons" style = "color: black;">mode_edit</i></button>
									<button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateItem"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
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
		        <div id="modalUpdateItem" class="modal" style = "width: 500px;" ng-controller="ctrl.updateAdditional">
		            <div class = "modal-header" style = "height: 55px;">
		                <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw;">Update Additionals</h4>
		            </div>
						<form id="formUpdate" ng-submit="UpdateAdditional()">
							<br>
			                <div class = "col s12">
			                    <div class = "row">
			                        <div style = "padding-left: 10px;">
			                            <div class="input-field col s6">
			                            	<input ng-model="token" type="hidden" value="{!! csrf_token() !!}" name="_token">
			                            	<input ng-model="update.intAdditionalId" id="additionalIdUpdate" type="hidden" name="intAdditionalId"/>
			                                <input ng-model="update.strAdditionalName" id="additionalNameUpdate" type="text" class="validate" name="strAdditionalName" required = ""  minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
			                                <label class="active" for="additionalNameUpdate" data-error = "Invalid format." data-success = "">Additional Name<span style = "color: red;">*</span></label>
			                            </div>
			                        </div>
			                        <div style = "padding-left: 10px;">
			                            <div class="input-field col s6">
			                                <input ng-model="update.deciPrice" id="additionalPriceUpdate" type="text" class="validate" name="deciPrice" required = "" min="1" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
			                                <label class="active" for="additionalPriceUpdate" data-error = "Invalid format." data-success = "">Additional Price<span style = "color: red;">*</span></label>
			                            </div>
			                        </div>
			                    </div>
			                </div>
		
		                    <div style = "padding-left: 20px;">
		                        <div class="input-field col s12">
		                            <input ng-model="update.strAdditionalDesc" value=" " id="additionalDescUpdate" type="text" class="validate" name="strAdditionalDesc">
		                            <label class="active" for="additionalDescUpdate" data-error = "Invalid format." data-success = "">Additional Description</label>
		                        </div>
		                    </div>

						<i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>
						<br>

						<div class="modal-footer">
								<button type="submit" name="action" class="btn light-green" style = "color: black; margin-top: 30px; margin-left: 10px; ">Confirm</button>
							<button class="btn light-green modal-close" style = "color: black; margin-top: 30px" onclick="$('modalUpdateItem').closeModal()">Cancel</button>
						</div>
					</form>
		        </div>


				<!-- Modal Deactivate -->
				<div id="modalDeactivateItem" class="modal" style = "width: 400px;">
					<div class = "modal-header" style = "height: 55px;">
						<h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw;">Deactivate Additionals</h4>
					</div>
					<div class="modal-content">
						<p style = "padding-left: 30px; font-size: 15px;">Are you sure you want to deactivate this item?</p>
					</div>
					<input id="itemToBeDeactivated" type="hidden"/>
					<div class="modal-footer">
						<button onclick = "deactivateItem()" name = "action" class="btn light-green" style = "color: black; margin-left: 10px; ">Confirm</button>
						<button name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</button>
					</div>
				</div>

				<!-- Modal Item Category -->
				<div id="modalItemCategory" class="modal" style = "width: 400px;" ng-controller="ctrl.newAdditionalCategory">
					<div class = "modal-header" style = "height: 55px;">
						<h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw;;">Additionals Category</h4>
					</div>
					<form class="modal-content" id="formCreateAdditionalCategory" ng-submit="CreateNewAdditionalCategory()">
						<div style = "padding-left: 10px;" >
							<div class="input-field col s12">
								<input ng-model="additionalCategory.token" type="hidden" value="{!! csrf_token() !!}" />
								<input ng-model="additionalCategory.strAdditionalCategoryName" id="additionalCategoryName" type="text" class="validate" name="item.strItemCategory" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
								<label for="additionalCategoryName" data-error = "Invalid format." data-success = "">Item Category<span style = "color: red;">*</span></label>
								<i class = "left" style = "padding-bottom: 20px; margin-top: 20px; padding-left: 0px; color: red;">*Required Fields</i>
							</div>
							<br>
						</div>
						<div class="modal-footer">
							<button type="submit" name = "action" class="btn light-green" style = "color: black; margin-left: 10px; margin-top: 42px;">Confirm</button>
					</form>
							<button name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</button>
						</div>

				</div>

				<!-- Modal Archive Item-->
				<div id="modalArchiveItem" class="modal" style = "width: 550px;">
					<div class="modal-content" style = "margin-left: -23px; margin-top: -23px; margin-right: -23px; margin-bottom: -40px;">
						<!-- Data Grid Deactivated Item/s-->
						<div id="admin1" class="col s12" style="margin-top: 0px">
							<div class="z-depth-2 card material-table" style="margin-top: 0px">
								<div class="table-header" style="height: 45px; background-color: #00897b;">
									<h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 1.2vw; color: white; padding-left: 0px;">Archive Additionals</h4>
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
									<tr>
										<td>Item One</td>
										<td>
											<button name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
										</td>
									</tr>
									<tr>
										<td>Item Two</td>
										<td>
											<button name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
										</td>
									</tr>
									<tr>
										<td>Item Three</td>
										<td>
											<button name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
										</td>
									</tr>
									<tr>
										<td>Item Three</td>
										<td>
											<button name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
										</td>
									</tr>
									<tr>
										<td>Item Four</td>
										<td>
											<button name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
										</td>
									</tr>
									<tr>
										<td>Item Five</td>
										<td>
											<button name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
										</td>
									</tr>
									<tr>
										<td>Item Six</td>
										<td>
											<button name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
										</td>
									</tr>
									<tr>
										<td>Item Seven</td>
										<td>
											<button name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
	</div>

		<script type="text/javascript">
			$(document).ready(function(){
				// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
				$('.modal-trigger').leanModal({dismissible: false});
			});
		
		</script>

@endsection