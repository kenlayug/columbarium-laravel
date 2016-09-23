@extends('v2.baseLayout')
@section('title', 'Receipt Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/block/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.block'>


<!-- Receipt-->
  <div class="row">
    <div class="col s3" style="margin-top: 105px;">
      <div class="row">
        <select material-select watch>
          <option value="" disabled selected>Choose your filter</option>
          <option value="1">Day</option>
          <option value="2">Week</option>
          <option value="3">Month</option>
          <option value="4">Year</option>
        </select>
        <label style="margin-top: 170px;">For the last</label>
      </div>
      <div class="row">
        <select material-select watch>
          <option value="" disabled selected>Choose your filter</option>
          <option value="1">Unit Purchase</option>
          <option value="2">Collection & Downpayment</option>
          <option value="3">Manage Unit</option>
          <option value="4">Service Purchases</option>
          <option value="5">Assign Schedule</option>
        </select>
        <label style="margin-top: 250px;">Transaction Name</label>
      </div>
    </div>

    <div class="col s9">

      <div class="row">
        <div class="z-depth-1 input-field col s4 offset-s4">

          <div style="margin-right: 40px;">
            <input type="text" placeholder="Search Transaction ID">  
          </div>

          <a class="right waves-effect waves-light btn tooltipped" data-position="right" data-delay="50" data-tooltip="Search"  style="padding-left: 10px; padding-right: 10px; margin-top: -50px;">
            <i class="material-icons">search</i>
          </a>

        </div>
      </div>  

      <div class="col s12">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <!--<a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>-->
            <h5 style="color: #ffffff; padding-left: 40%;">Receipt Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatable1">
            <thead>
              <tr>
                <th>Transaction ID</th>
                <th>Transaction Name</th>
                <th>Unit</th>
                <th>Print</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>T234</td>
                <td>Manage Unit</td>
                <td>E11</td>
                <td>
                  <button data-target="" class="waves-light btn light-green modal-trigger" href="#" style = "color: black;">Receipt</button>
                </td>
              </tr>
              <tr>
                <td>T765</td>
                <td>Service Purchases</td>
                <td></td>
                <td>
                  <button data-target="" class="waves-light btn light-green modal-trigger" href="#" style = "color: black;">Receipt</button>
                </td>
              </tr>
              <tr>
                <td>T012</td>
                <td>Unit Purchases</td>
                <td>C6</td>
                <td>
                  <button data-target="" class="waves-light btn light-green modal-trigger" href="#" style = "color: black;">Receipt</button>
                </td>
              </tr>
              <tr>
                <td>T120</td>
                <td>Collection & Downpayment</td>
                <td>C6</td>
                <td>
                  <button data-target="" class="waves-light btn light-green modal-trigger" href="#" style = "color: black;">Receipt</button>
                </td>
              </tr>
              <tr>
                <td>T632</td>
                <td>Assign Schedule</td>
                <td></td>
                <td>
                  <button data-target="" class="waves-light btn light-green modal-trigger" href="#" style = "color: black;">Receipt</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


<!-- Receipt -->

  
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
          $('#datatable1').dataTable({
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