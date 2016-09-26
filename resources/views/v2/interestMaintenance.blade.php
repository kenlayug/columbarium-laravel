@extends('v2.baseLayout')
@section('title', 'Interest Maintenance')
@section('body')

	<!-- Import CSS/JS -->
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/interestMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/interest/v2/controller.js') !!}"></script>


<div ng-controller="ctrl.interest">
    <div class = "container">
        <div class = "row">

            <!-- Create Interest -->
            <div class = "col s12 m6 l4">
                <form class = "createForm aside aside z-depth-3" id="formCreate" ng-submit="saveInterest()" autocomplete="off">
                    <div class = "createHeader">
                        <h4 class = "center flow-text">Interest Maintenance</h4>
                    </div>
                    <div class = "numberOfYears row">
                        <div>
                            <div class="numberOfYears input-field col s6 m12 l6">
                                <input ng-model="interest.intNoOfYear"
                                 ui-number-mask="0"
                                 id="numberOfYears" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole numbers only. Max input: 10<br>*Example: 5" name="item.strNumberOfYears" required = "" aria-required="true" min = "1" max="10">
                                <label id="createNoOfYear" for="numberOfYears" data-error = "Invalid format." data-success = "">Number of Years<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row container">
                        <div class="interestRate input-field col s6 m12 l6">
                            <input ng-model="interest.deciRegInterestRate"
                                   ui-percentage-mask
                                   id="interestRate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: 25" name="item.dblPrice" required = "" max="100" aria-required = "true">
                            <label id="createRate" for="interestRate" data-error = "Invalid Format." data-success = "">Regular Rate<span style = "color: red;">*</span></label>
                        </div>
                        <div class="interestRate input-field col s6 m12 l6">
                            <input ng-model="interest.deciAtNeedInterestRate"
                                   ui-percentage-mask
                                   id="atNeedRate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: 25" name="item.dblPrice" required = "" max="100" aria-required = "true">
                            <label id="createRate" for="atNeedRate" data-error = "Invalid Format." data-success = "">At Need Rate<span style = "color: red;">*</span></label>
                        </div>
                    </div>
                    <br>
                    <i class = "createRequiredField left">*Required Fields</i>
                    <br><br>
                    <button type = "submit" name = "action" class="btn light-green right" style = "margin-bottom: 10px; color: black; margin-right: 10px;">Create</button>
                </form>
            </div>


                <!-- Data Grid -->
                <div class = "dataGrid col s12 m6 l8">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header">
                                    <h3 class='flow-text'>Interest Record</h3>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Interest/s" style = "margin-right: 10px;" href = "#modalArchiveInterest"><i class="material-icons" style = "color: black">delete</i></button>
                                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table datatable="ng">
                                    <thead>
                                    <tr>
                                        <th>Number of Years</th>
                                        <th>Regular Rate</th>
                                        <th>At Need Rate</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="interest in interestList">
                                        <td ng-bind="interest.intNoOfYear"></td>
                                        <td ng-bind="interest.interest_rate.regular.deciInterestRate | percentage : 2"></td>
                                        <td ng-bind="interest.interest_rate.atNeed.deciInterestRate | percentage : 2"></td>
                                        <td><button tooltipped ng-click="getInterest(interest, $index)" name = "action" class = "btn modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Update Interest"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                            <button tooltipped ng-click="deleteInterest(interest, $index)" name = "action" class = "btn modal-trigger btn-floating light-green"  data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Interest" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
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


    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal({dismissible: false});
        });
    </script>

    @include('modals.interest.v2.archive')
    @include('modals.interest.v2.update')
</div>

@endsection