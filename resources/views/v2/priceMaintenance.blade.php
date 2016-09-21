@extends('v2.baseLayout')
@section('title', 'Price Maintenance')
@section('body')
    <!-- Section -->
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/blocksMaintenance.css') !!}"/>
{{--    <link rel="stylesheet" type="text/css" href="{!! asset('/css/vaults.css') !!}">--}}
    <script src="{!! asset('/price/controller.js') !!}"></script>

    <div ng-controller="ctrl.price">
        <div class = "parent" style = "width: 100%;">
            <div class = "row">

                    <div class = "col s12 m6 l4" style = "margin: 0 auto;">
                        <div style = "height: 50px; background-color: #4db6ac;">
                            <h2 class = "center" style = "padding-top: 10px; color: white; font-family: roboto3; font-size: 2vw; margin-top: 30px;">Price Maintenance</h2>
                        </div>
                        <div style = "overflow: auto;height: 370px;">
                            <div class = "aside aside">
                                <ul class="collapsible" data-collapsible="accordion" watch>
                                    <li ng-repeat="building in buildingList">
                                        <div ng-click="getFloors(building.intBuildingId, $index)" class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                            <label style = "font-family: roboto3; font-size: 25px; color: white;">@{{ building.strBuildingName }}</label>
                                        </div>
                                        <div ng-show="building.floorList.length == 0" class="collapsible-body" style = "background-color: #fb8c00;">
                                            <p>No floor configured to create a block.</p>
                                        </div>
                                        <div class="collapsible-body" ng-hide="building.floorList.length == 0">
                                            <div class="row">
                                                <div class="col s12 m12">
                                                    <ul class="collapsible popout" data-collapsible="accordion" watch>
                                                        <li ng-repeat="floor in building.floorList">
                                                            <div class="collapsible-header orange"><i class="medium material-icons">business</i>
                                                                <label style = "font-family: roboto3; font-size: 1.5vw; color: white;">Floor No @{{ floor.intFloorNo }}</label>
                                                            </div>
                                                            <div class="collapsible-body orange box">
                                                                <div style = "padding-top: 10px; height: 60px; border-top: 1px solid white;" ng-repeat="unitType in floor.unitType"><label style = "margin-top: 25px; padding-left: 20px; font-family: roboto3; font-size: 1.6vw; color: white;">@{{ unitType.strUnitTypeName }}</label>
                                                                    <button style = "margin-right: 10px; font-family: roboto3; font-size: 1.5vw; color: white;" ng-click="openPrice(floor.intFloorId, floor.intFloorNo, unitType.intRoomTypeId, unitType)" name = "action" class="btn tooltipped right teal" data-position = "bottom" data-delay = "30" data-tooltip = "View Block">SET</button>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                <div ng-hide="unitCategoryList != null" class = "dataGrid col s12 m6 l8">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style = "background-color: #00897b;">
                                    <h5 class = "flow-text" style = "font-family: roboto3; color: white;">Unit Price Record</h5>
                                    <div class="actions">
                                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id = "datatable">
                                    <thead>
                                    <tr>
                                        <th>Building Name</th>
                                        <th>Floor No.</th>
                                        <th>Unit Type</th>
                                        <th>No. of Level</th>
                                        <th>Level Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="unitCategory in tableUnitCategoryList">
                                        <td ng-bind="unitCategory.strBuildingName"></td>
                                        <td ng-bind="unitCategory.intFloorNo"></td>
                                        <td ng-bind="unitCategory.strUnitTypeName"></td>
                                        <td ng-bind="unitCategory.display"></td>
                                        <td ng-bind="unitCategory.price.deciPrice | currency : 'P'"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <form ng-show="unitCategoryList != null" ng-submit="savePrice()" autocomplete="off">
                    <div class = "col s12 m6 l8" style = "margin-top: 65px;">
                        <div class="responsive">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3" style = "overflow: auto;width: 100%; margin-top: -50px; height: 470px; background-color: #e0f2f1;">
                                    <div style = "margin-top: 20px; width: 100%; height: 50px; background-color: #4db6ac;">
                                        <h2 class = "center flow-text" style = "padding-top: 10px; color: white; font-family: roboto3; margin-top: 10px;">Price Configuration</h2>
                                        <a ng-click="closePrice()"
                                                ng-show="unitCategoryList != null"
                                                class = "btn-floating btn teal right" style = "margin-top: -51px; margin-right: 10px;">&#10006;</a>
                                    </div>
                                    <h5 ng-show="floorNo != null" class="center" style = "font-family: roboto3;">Floor No. @{{ floorNo }} (@{{ unitType.strUnitTypeName }})</h5>
                                    <div ng-repeat="unitCategory in unitCategoryList"
                                         class = "row" style = " margin-bottom: -30px;">
                                        <table class = "col s6" id="tableUnits" style="font-size: small;">
                                            <tbody>
                                            <tr style = "height: 0px;">
                                                <td style="height: 55px; background-color: #00695c; border: 2px solid white;">
                                                    <label style = "padding-left: 150px; color: white; font-size: 16px; font-family: roboto3;">Level @{{ unitCategory.display }}</label>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="input-field col s6">
                                                <input  ng-model="unitCategory.price.deciPrice"
                                                        ui-number-mask="2"
                                                        id="@{{ unitCategory.intUnitCategoryId }}" type="text" class="number validate tooltipped" placeholder="P 0.00" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places. <br>*Example: P 0.00" required = "" min="1" max="999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                                <label for="@{{ unitCategory.intUnitCategoryId }}" for="levelPrice" data-error = "Invalid Format." data-success = "">Level Price<span style = "color: red;">*</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="center">
                            <button ng-show="unitCategoryList != null" name = "action" class="btn light-green" style = "color: black; margin-top: 10px;">SAVE</button>
                        </div>
                    </div>

                </form>

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
            $('.tooltipped').tooltip({delay: 50});
        });


        $(document).ready(function() {
            $('input#input_text, textarea#textarea1').characterCounter();
        });
        $('.modal-trigger').leanModal({
            dismissible: false
        });

    </script>
    @include('modals.price.archive')
</div>
@endsection