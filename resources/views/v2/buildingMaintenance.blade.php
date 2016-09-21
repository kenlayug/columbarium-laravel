@extends('v2.baseLayout')
@section('title', 'Building Maintenance')
@section('body')

	<script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
	<link rel = "stylesheet" href = "{!! asset('/css/buildingMaintenance.css') !!}"/>
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
								<button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated<br>Building/s" style = "margin-right: 10px;" href = "#modalArchiveBuilding"><i class="material-icons" style = "color: black;">delete</i></button>
								<a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
							</div>
						</div>
						<table id = "datatable" datatable="ng">
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
								<td><button tooltipped ng-click="getBuilding(building, $index)" name = "action" class="modal-trigger btn-floating light-green btn" data-position = "bottom" data-delay = "30" data-tooltip = "Update Building" href = "#modalUpdateBuilding"><i class="material-icons" style = "color: black;">mode_edit</i></button>
									<button tooltipped ng-click="deleteBuilding(building, $index)" name = "action" class="modal-trigger btn-floating light-green btn" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Building" href = "#modalDeactivateBuilding"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- Datatable -->
		<script>
			(function(window, document, undefined) {

				var factory = function($, DataTable) {
					"use strict";

					$('.search-toggle').click(function() {
						if ($('.hiddensearch').css('display') == 'none')
							$('.hiddensearch').slideDown();
						else
							$('.hiddensearch').slideUp();
					});

					$('.add-toggle').click(function() {
						if ($('#addTime').css('display') == 'none')
							$('#addTime').slideDown();
						else
							$('#addTime').slideUp();
					});


					/* Set the defaults for DataTables initialisation */
					$.extend(true, DataTable.defaults, {
						dom: "<'hiddensearch'f'>" +
						"tr" +
						"<'table-footer'lip'>",
						renderer: 'material'
					});

					/* Default class modification */
					$.extend(DataTable.ext.classes, {
						sWrapper: "dataTables_wrapper",
						sFilterInput: "form-control input-sm",
						sLengthSelect: "form-control input-sm"
					});

					/* Bootstrap paging button renderer */
					DataTable.ext.renderer.pageButton.material = function(settings, host, idx, buttons, page, pages) {
						var api = new DataTable.Api(settings);
						var classes = settings.oClasses;
						var lang = settings.oLanguage.oPaginate;
						var btnDisplay, btnClass, counter = 0;

						var attach = function(container, buttons) {
							var i, ien, node, button;
							var clickHandler = function(e) {
								e.preventDefault();
								if (!$(e.currentTarget).hasClass('disabled')) {
									api.page(e.data.action).draw(false);
								}
							};

							for (i = 0, ien = buttons.length; i < ien; i++) {
								button = buttons[i];

								if ($.isArray(button)) {
									attach(container, button);
								} else {
									btnDisplay = '';
									btnClass = '';

									switch (button) {

										case 'first':
											btnDisplay = lang.sFirst;
											btnClass = button + (page > 0 ?
															'' : ' disabled');
											break;

										case 'previous':
											btnDisplay = '<i class="material-icons">chevron_left</i>';
											btnClass = button + (page > 0 ?
															'' : ' disabled');
											break;

										case 'next':
											btnDisplay = '<i class="material-icons">chevron_right</i>';
											btnClass = button + (page < pages - 1 ?
															'' : ' disabled');
											break;

										case 'last':
											btnDisplay = lang.sLast;
											btnClass = button + (page < pages - 1 ?
															'' : ' disabled');
											break;

									}

									if (btnDisplay) {
										node = $('<li>', {
											'class': classes.sPageButton + ' ' + btnClass,
											'id': idx === 0 && typeof button === 'string' ?
											settings.sTableId + '_' + button : null
										})
												.append($('<a>', {
															'href': '#',
															'aria-controls': settings.sTableId,
															'data-dt-idx': counter,
															'tabindex': settings.iTabIndex
														})
																.html(btnDisplay)
												)
												.appendTo(container);

										settings.oApi._fnBindAction(
												node, {
													action: button
												}, clickHandler
										);

										counter++;
									}
								}
							}
						};

						// IE9 throws an 'unknown error' if document.activeElement is used
						// inside an iframe or frame.
						var activeEl;

						try {
							// Because this approach is destroying and recreating the paging
							// elements, focus is lost on the select button which is bad for
							// accessibility. So we want to restore focus once the draw has
							// completed
							activeEl = $(document.activeElement).data('dt-idx');
						} catch (e) {}

						attach(
								$(host).empty().html('<ul class="material-pagination"/>').children('ul'),
								buttons
						);

						if (activeEl) {
							$(host).find('[data-dt-idx=' + activeEl + ']').focus();
						}
					};

					/*
					 * TableTools Bootstrap compatibility
					 * Required TableTools 2.1+
					 */
					if (DataTable.TableTools) {
						// Set the classes that TableTools uses to something suitable for Bootstrap
						$.extend(true, DataTable.TableTools.classes, {
							"container": "DTTT btn-group",
							"buttons": {
								"normal": "btn btn-default",
								"disabled": "disabled"
							},
							"collection": {
								"container": "DTTT_dropdown dropdown-menu",
								"buttons": {
									"normal": "",
									"disabled": "disabled"
								}
							},
							"print": {
								"info": "DTTT_print_info"
							},
							"select": {
								"row": "active"
							}
						});

						// Have the collection use a material compatible drop down
						$.extend(true, DataTable.TableTools.DEFAULTS.oTags, {
							"collection": {
								"container": "ul",
								"button": "li",
								"liner": "a"
							}
						});
					}

				}; // /factory

				// Define as an AMD module if possible
				if (typeof define === 'function' && define.amd) {
					define(['jquery', 'datatables'], factory);
				} else if (typeof exports === 'object') {
					// Node/CommonJS
					factory(require('jquery'), require('datatables'));
				} else if (jQuery) {
					// Otherwise simply initialise as normal, stopping multiple evaluation
					factory(jQuery, jQuery.fn.dataTable);
				}

			})(window, document);

			$(document).ready(function() {
				$('#datatable').dataTable({
					"iDisplayLength": 5,
					"oLanguage": {
						"sStripClasses": "",
						"sSearch": "",
						"sSearchPlaceholder": "Enter Keywords Here",
						"sInfo": "_START_ -_END_ of _TOTAL_",
						"sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
						'<option value="5">5</option>' +
						'<option value="10">10</option>' +
						'<option value="20">20</option>' +
						'<option value="30">30</option>' +
						'<option value="40">40</option>' +
						'<option value="50">50</option>' +
						'<option value="-1">All</option>' +
						'</select></div>'
					},
					bAutoWidth: true
				});
			});

		</script>


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