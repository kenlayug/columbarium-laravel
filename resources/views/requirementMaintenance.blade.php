@extends('maintenanceLayout')
@section('title', 'Requirement Maintenance')

@section('body')
	<script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/requirementMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/requirement/requirement-controller.js') !!}"></script>


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
							<table datatable="ng">
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