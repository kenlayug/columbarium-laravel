@extends('v2.baseLayout')
@section('title', 'Manage Unit')
@section('body')
    <script type="text/javascript" src="{!! asset('/js/materialize.clockpicker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/materialize.clockpicker2.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/materialize.clockpicker.css') !!}"/>

    <link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/vaults.css') !!}">
    <script type="text/javascript" src="{!! asset('/js/manageUnit.js') !!}"></script>
    <script src="{!! asset('/js/tooltip.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('/manage-unit/controller.js') !!}"></script>

    <div ng-controller="ctrl.manage-unit">

        <div class = "col s12">
            <div class = "row">
                <div class = "col s4">
                    <div class="row" style="background-color: #00897b; margin-top: 20px; ">
                        <center><h5 style = "margin-left: 20px;  color: white; padding: 20px; padding-bottom: 5px;">Manage Unit</h5></center>
                    </div>
                    <div class="z-depth-1 row"  style="margin-top: -25px;">
                        <div class="input-field col s4">
                            <label  style="color: #000000; font-size: 17px;">Search Building: </label>
                        </div>
                        <div class="input-field col s8">
                            <div style="margin-right: 5px;">
                                <input ng-model="filterBuilding" type="text" placeholder="Building Name" list="buildingName">  
                            </div>
                            <datalist id="buildingName">
                                <option ng-repeat="building in buildingList" ng-value="building.strBuildingName">
                            </datalist>
                        </div>
                    </div> 
                    <div style = "margin-top: -20px;">
                        <div class = "col s12">
                            <div class = "aside aside " style="overflow: auto; height: 400px;">
                                <ul class="collapsible" data-collapsible="accordion" watch>
                                    <li ng-repeat="unitType in unitTypeList">

                                        <div ng-click="getBlocks(unitType, $index)"
                                             class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                            <label style = "font-size: 1.5vw; color: white;">@{{ unitType.strUnitTypeName }}</label>
                                        </div>

                                        <div ng-repeat="block in unitType.blockList"
                                            ng-if="(filterBuilding == null || filterBuilding == '') || (filterBuilding != null && block.strBuildingName.toUpperCase().indexOf(filterBuilding.toUpperCase()) >= 0)"
                                            class="collapsible-body @{{ block.color }}" 
                                            tooltipped
                                            data-position="right"
                                            data-delay="50"
                                            data-tooltip="<u>@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}</u><br>Available: @{{ block.unitStatusCount[1] }}<br>Reserved: @{{ block.unitStatusCount[2] }}<br>At Need: @{{ block.unitStatusCount[4] }}<br>Partially Owned: @{{ block.unitStatusCount[6] }}<br>Owned: @{{ block.unitStatusCount[3] }}<br>Deactivated: @{{ block.unitStatusCount[0] }}"
                                            style = "max-height: 50x;">
                                            <p style = "padding-top: 15px;">@{{ block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo }}
                                                <button ng-click="getUnits(block, $index)"
                                                        id = "Button1" tooltipped class="right btn-floating light-green" data-position = "left" data-delay = "25" data-tooltip = "View" type="button" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                            </p>
                                        </div>
                                        <div ng-if="unitType.blockList.length == 0"
                                             class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                            <p style = "padding-top: 15px;">
                                                No blocks available for this unit type.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class = "col s8">
                    <div class = "row" style = "width: 100%;">
                        <div ng-hide="showUnit" id="tableStart" style="margin-top: 18px; z-index: -1;">
                            <div class = "card material-table" style = "text-align: left">
                                <div class="table-header" style="background-color: #00897b;">
                                    <h4 style = "font-size: 20px; color: white; padding-left: 45%;">Overview</h4>
                                    <div class="actions">
                                        <button ng-click="openSafeBox()" data-target="safeBox" class="right waves-light btn blue modal-trigger" href="#safeBox" style = "color: black; margin-right: 0px; float: right;">Safe Box</button>
                                        <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table datatable="ng">
                                    <thead>
                                        <tr>
                                            <th class="center" style="font-size:15px; color: #000000; width: 20%;">Deceased Name</th>
                                            <th class="center" style="font-size:15px; color: #000000; width: 30%;">Building</th>
                                            <th class="center" style="font-size:15px; color: #000000; width: 10%;">Floor</th>
                                            <th class="center" style="font-size:15px; color: #000000; width: 20%;">Room</th>
                                            <th class="center" style="font-size:15px; color: #000000; width: 10%;">Block</th>
                                            <th class="center" style="font-size:15px; color: #000000; width: 10%;">Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="deceased in deceasedInUnitList">
                                            <td class="center" ng-bind="deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName"></td>
                                            <td class="center" ng-bind="deceased.strBuildingName"></td>
                                            <td class="center" ng-bind="deceased.intFloorNo"></td>
                                            <td class="center" ng-bind="deceased.strRoomName"></td>
                                            <td class="center" ng-bind="deceased.intBlockNo"></td>
                                            <td class="center" ng-bind="deceased.display"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>      
                        </div>

                        <div ng-show="showUnit" class="responsive" id="tableUnit" style="margin-top: 45px;">
                            <div class = "col s12 z-depth-1" style="background-color: #e0f2f1; z-index: -1;">
                                <a ng-click="closeBlock()" tooltipped class="right btn-floating btn-flat btn teal" data-position="right" data-delay="30" data-tooltip="Close"
                                    style="position:absolute; color: white; font-weight: 900; margin-top: 25px; margin-left: 15px;">X</a>
                                <div class = "aside aside z-depth-3">
                                    <div class="center vaults-content">
                                        <div class="table-header" style="background-color: #00897b;">
                                            <h2 style = "padding-left: 40px; font-size: 30px; margin-top: 20px; padding: 10px; color: #ffffff;">@{{ blockName }}</h2>
                                        </div>
                                        <button ng-click="openSafeBox()" data-target="safeBox" class="right waves-light btn blue modal-trigger" href="#safeBox" style = "color: black; margin-right: 10px; margin-top: -64px; float: right;">Safe Box</button>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px; border: 2px solid #00beab; color: #000000;">
                                            <tbody>
                                            <tr ng-repeat="unitLevel in unitList">
                                                <td ng-repeat="unit in unitLevel"
                                                    class="@{{ unit.color }}"
                                                    style="max-height: 50px; border: 2px solid #00beab; color: #000000;">
                                                    <a ng-click="openModal(unit)"
                                                       data-target="modal1"
                                                       href="#modal1"
                                                        tooltipped
                                                        data-position="bottom"
                                                        data-delay="50"
                                                        data-tooltip="<u>Unit: @{{ unit.display }}</u><br>Owner: @{{ unit.strCustomerName }}<br>Unit type: @{{ unit.strUnitTypeName }}"
                                                        class="waves-effect waves-light modal-trigger">@{{ unit.display }}</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Legends -->
                                <div class = "row" style="margin-top: -30px; margin-right: -10px; margin-left: -10px;">
                                    <div class = "col s12">
                                        <div class = "aside aside z-depth-3" style = "height: 155px;">
                                            <div class="row" style="background-color: #00897b; margin-top: 20px; ">
                                                <center><h5 style = "margin-left: 20px;  color: white; padding: 20px; padding-bottom: 5px;">Legend</h5></center>
                                            </div>

                                            <div class = "row" style = "margin-top: -10px;">
                                                <center>
                                                    <div class = "col s2">
                                                        <button name = "action" class="btn-floating green darken-3" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[1]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">Available</label>
                                                    </div>
                                                    <div class = "col s2" style = "margin-left: -5px;">
                                                        <button name = "action" class="btn-floating blue darken-3" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[2]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">Reserved</label>
                                                    </div>
                                                    <div class = "col s2">
                                                        <button name = "action" class="btn-floating yellow darken-2" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[4]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">AtNeed</label>
                                                    </div>
                                                    <div class = "col s2">
                                                        <button name = "action" class="btn-floating pink darken-1" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[6]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">Partially Owned</label>
                                                    </div>
                                                    <div class = "col s2">
                                                        <button name = "action" class="btn-floating red darken-3" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[3]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">Owned</label>
                                                    </div>
                                                    <div class = "col s2">
                                                        <button name = "action" class="btn-floating orange darken-1" style="color: #000000; font-size: 16px; font-weight: 900;" ng-bind="unitStatusCount[0]"></button>
                                                        <br><label style="font-size: 15px; color: #000000;">Deactivated</label><br>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>


            <script type="text/javascript">
                $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                
              $('.modal-trigger').leanModal({
                  dismissible: false, // Modal can be dismissed by clicking outside of the modal
                  opacity: .5, // Opacity of modal background
                  in_duration: 300, // Transition in duration
                  out_duration: 200, // Transition out duration
                  starting_top: '4%', // Starting top style attribute
                  ending_top: '10%', // Ending top style attribute
                }
              );
                  
            });

            $( document ).ready(function() {
                $('.datepicker').pickadate({
                    format: 'mm/dd/yyyy',
                    selectMonths: true, // Creates a dropdown to control month
                    selectYears: 15 // Creates a dropdown of 15 years to control year
                });
            });
                $(document).ready(function(){
                    $('input[type="checkbox"]').click(function(){
                        if($(this).attr("value")=="addRel"){
                            $(".addRelationship").toggle();
                            $(".oldRel").toggle();
                        }
                    });
                });
            (function(window, document, undefined) {

                var factory = function($, DataTable) {
                    "use strict";

                    $('.search-toggle').click(function() {
                        if ($('.hiddensearch').css('display') == 'none')
                            $('.hiddensearch').slideDown();
                        else
                            $('.hiddensearch').slideUp();
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
                    bAutoWidth: false
                });
            });
            $(document).ready(function() {
                $('#datatable1').dataTable({
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
                    bAutoWidth: false
                });
            });
            $(document).ready(function() {
                $('#datatable2').dataTable({
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
                    bAutoWidth: false
                });
            });
            $(document).ready(function() {
                $('#datatable3').dataTable({
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
                    bAutoWidth: false
                });
            });
            $(document).ready(function() {
                $('#datatable4').dataTable({
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
                    bAutoWidth: false
                });
            });
            $(document).ready(function() {
                $('#datatable5').dataTable({
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
                    bAutoWidth: false
                });
            });
            $(document).ready(function() {
                $('#datatable-overviewUnit').dataTable({
                    "iDisplayLength": 7,
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
                    bAutoWidth: false
                });
            });
            $(document).ready(function() {
                $('#datatable-purchased').dataTable({
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
                    bAutoWidth: false
                });
            });

            $(document).ready(function() {
                $('#datatable-deceased').dataTable({
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
                    bAutoWidth: false
                });
            });
            </script>

            @include('modals.buy-unit.v2.cheque')
            @include('modals.service-purchases.newDeceasedForm')
            @include('modals.manage-unit.addTransferPullOutForm')
            @include('modals.manage-unit.newCustomer1')
            @include('modals.manage-unit.retrieveDeceased')
            @include('modals.manage-unit.returnDeceased')
            @include('modals.manage-unit.purchased-manage-unit')
            @include('modals.manage-unit.safeBox')
            @include('modals.manage-unit.successAddDeceased')
            @include('modals.manage-unit.successPullOutDeceased')
            @include('modals.manage-unit.successReturnDeceased')
            @include('modals.manage-unit.successTransferDeceased')
            @include('modals.manage-unit.successTransferOwnership')
            @include('modals.manage-unit.successSafeBox')
            @include('modals.service-purchases.requirements')
        </div>
    </div>
@endsection