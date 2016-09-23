@extends('v2.baseLayout')
@section('title', 'Unit Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/unit/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.unit'>


<!-- Unit-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intUnitStatus' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Status Types</option>
            <option value="3">Owned</option>
            <option value="2">Reserved</option>
            <option value="4">At Need</option>
            <option value="5">Deactivated</option>
        </select>
        <label>Unit Status</label>
        </div>
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intBuildingId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Buildings</option>
            <option ng-repeat='building in buildingList' value="@{{ building.intBuildingId }}">@{{ building.strBuildingName }}</option>
          </select>
          <label style="margin-top: 80px;">Building Name</label>
        </div>
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intFloorNo' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Floors</option>
            <option ng-repeat='n in [] | range: intFloorNo' value="@{{ $index+1 }}">@{{ $index+1 }}</option>
        </select>
        <label style="margin-top: 160px;">Building Floor</label>
        </div>
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intRoomId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Rooms</option>
            <option ng-repeat='room in filterRoomList' value="@{{ room.intRoomId }}">@{{ room.strBuildingCode+'-'+room.intFloorNo+'-'+room.strRoomName }}</option>
        </select>
        <label style="margin-top: 240px;">Building Room</label>
        </div>
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intUnitTypeId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Unit Types</option>
            <option ng-repeat='unitType in unitTypeList' value="@{{ unitType.intRoomTypeId }}">@{{ unitType.strRoomTypeName }}</option>
        </select>
        <label style="margin-top: 320px;">Type of Block</label>
        </div>
        <div class="row">
          <select ng-change='filterBlocks()' ng-model='blockFilter.intBlockNo' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="0">All Blocks</option>
            <option ng-repeat='block in filterBlockList' value="@{{ block.intBlockNo }}">@{{ block.intBlockNo }}</option>
        </select>
        <label style="margin-top: 400px;">Block</label>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <h5 style="color: #ffffff; padding-left: 43%;">Unit Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table datatable='ng'>
            <thead>
              <tr>
                <th style="color: #000000;">Building Name</th>
                <th style="color: #000000;">Floor No.</th>
                <th style="color: #000000;">Room Name</th>
                <th style="color: #000000;">Block No.</th>
                <th style="color: #000000;">Unit Type</th>
                <th style="color: #000000;">Unit Id</th>
                <th style="color: #000000;">Customer</th>
                <th style="color: #000000;">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat='unit in filterUnitList'>
                <td><span title="@{{ unit.strBuildingName }}">@{{ unit.strBuildingName }}</span></td>
                <td>@{{ unit.intFloorNo }}</td>
                <td><span title="@{{ unit.strRoomName }}">@{{ unit.strRoomName }}</span></td>
                <td>@{{ unit.intBlockNo }}</td>
                <td><span title="@{{ unit.strRoomTypeName }}">@{{ unit.strRoomTypeName }}</span></td>
                <td>@{{ unit.intUnitId }}</td>
                <td><span title="@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}">@{{ unit.strLastName+', '+unit.strFirstName+' '+unit.strMiddleName }}</span></td>
                <td>@{{ unitStatusList[unit.intUnitStatus] }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Unit -->
    <script type="text/javascript">

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
            "iDisplayLength": -1,
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



    $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();
    });
    function myCtrl($scope) {
        $scope.myDecimal = 0;
    }

  </script>
</div>
@endsection