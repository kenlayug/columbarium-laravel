@extends('v2.baseLayout')
@section('title', 'Additional Maintenance')
@section('body')
	    <!-- Import CSS/JS -->

	    <link rel = "stylesheet" href = "{!! asset('/css/additionalsMaintenance.css') !!}"/>
	    <script type="text/javascript" src="{!! asset('/additional/js/additionalController.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>

<!-- Section -->
<div class = "container" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
	<div class = "row">

		<!-- Create Additionals -->
		<div class = "col s12 m6 l4">
			<div ng-controller="ctrl.newAdditional">
				<form ng-submit="SaveNewAdditional()" class = "formCreate aside aside z-depth-3" id="formCreate" autocomplete="off">
					<div class = "createHeader">
						<h4 class = "center flow-text">Additionals Maintenance</h4>
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
								<input ng-model="additional.deciPrice"
                                       ui-number-mask
                                       id="itemPrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places.<br>*Example: P 0.00" name="item.dblPrice" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
								<label id="createPrice" for="itemPrice" data-error = "Invalid Format." data-success = "">Price<span style = "color: red;">*</span></label>
							</div>
						</div>
					</div>
					<div class = "additionalCategory row">
						<div class="input-field col s5 m5 l5">
							<select id="selectItemCategory" ng-model="additional.intAdditionalCategoryId" material-select watch>
								<option class = "additionalCategory2" value="" disabled selected>Category</option>
								<option ng-repeat="additionalCategory in additionalCategories" value="@{{ additionalCategory.intAdditionalCategoryId }}">@{{ additionalCategory.strAdditionalCategoryName }}</option>
							</select>
						</div>
						<a type = "submit" name = "action" class="col s6 m6 l6 modal-trigger btn light-green" href = "#modalItemCategory" style = "margin-top: 20px; color: black;">New Category</a>
					</div>
					<div class="additionalsDesc row">
						<div class="input-field col s12">
							<input ng-model="additional.strAdditionalDesc" id="itemDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric and special characters.<br>*Example: Storage for ash/bones." name="item.strItemDesc">
							<label id="createDesc" for="itemDesc" data-error = "Invalid Format" data-success = "">Description</label>
						</div>
					</div>
					<div class = "row">
						<i class = "requiredField left">*Required Fields</i>
						<button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-right: 20px; margin-bottom: 10px;">Create</button>
					</div>
				</form>
			</div>
		</div>



			<!-- Data Grid -->
			<div class = "dataGrid col s12 m6 l8" ng-controller="ctrl.additionalTable">
				<div class="row">
					<div id="admin">
						<div class="z-depth-2 card material-table">
							<div class="table-header">
								<h5 class = "flow-text">Additionals Record</h5>
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
										<td><button tooltipped ng-click="UpdateAdditional(additional.intAdditionalId, $index)" name = "action" class="btn modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Update Additional"><i class="material-icons" style = "color: black;">mode_edit</i></button>
											<button tooltipped ng-click="DeactivateAdditional(additional.intAdditionalId, $index)" name = "action" class="btn btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Additional"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
									</tr>
								</tbody>
							</table>
						</div>
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

@include('modals.additionals.update')
@include('modals.additionals.additionalsCategory')
@include('modals.additionals.archive')
@endsection