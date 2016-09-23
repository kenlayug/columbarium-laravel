@extends('v2.baseLayout')
@section('title', 'Schedule Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/schedule/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.query.schedule'>

<!-- Schedules -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class='row'>
          <i class="material-icons prefix">today</i>
          <input ng-change="getSchedule()" ng-model='filter.dateSchedule' id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
          <label for="dateOfBirth">Schedule Date<span style = "color: red;">*</span></label>
        </div>
        <div class="row">
          <select ng-change="getSchedule()" ng-model='filter.intServiceCategoryId' material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option ng-repeat='service in serviceList' value="@{{ service.intServiceCategoryId }}">@{{ service.strServiceCategoryName }}</option>
            <option value="0">Interment</option>
          </select>
          <label style="margin-top: 80px;">Service Name</label>
        </div>
        <div class="row" ng-hide="filter.intServiceCategoryId == 0">
          <select ng-change="getSchedule()" material-select watch ng-model="filter.intStatus">
            <option disabled selected>Choose your filter</option>
            <option value="0">All Status Types</option>
            <option value="2">Scheduled</option>
            <option value="3">Rescheduled</option>
            <option value="6">Finished</option>
            <option value="5">Ongoing</option>
            <option value="4">Cancelled</option>
          </select>
          <label style='margin-top: 160px '>Schedule Status</label>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <h5 style="color: #ffffff; padding-left: 38%;">Schedules Query</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table datatable="ng">
            <thead>
              <tr>
                <th class="center">Customer Name</th>
                <th class="center" ng-show="boolSchedule">Service</th>
                <th class="center">Date</th>
                <th class="center" ng-show="boolSchedule">Time</th>
                <th class="center" ng-show="boolSchedule">Status</th>
                <th class="center" ng-hide="boolSchedule">Deceased Name</th>
                <th class="center" ng-hide="boolSchedule">Unit</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="schedule in scheduleList">
                <td class="center" ng-bind="schedule.strLastName+', '+schedule.strFirstName+' '+schedule.strMiddleName"></td>
                <td class="center" ng-bind="schedule.strServiceCategoryName" ng-show="boolSchedule"></td>
                <td class="center">
                  <span ng-bind="schedule.dateSchedule | amDateFormat : 'MMMM D, YYYY'" ng-show="boolSchedule"></span>
                  <span ng-bind="schedule.dateInterment | amDateFormat : 'MMMM D, YYYY'" ng-hide="boolSchedule"></span>
                </td>
                <td class="center" ng-show="boolSchedule"><span ng-bind="schedule.timeStart"></span> - <span ng-bind="schedule.timeEnd" /></td>
                <td class="center" ng-bind="scheduleStatusList[schedule.status]" ng-show="boolSchedule"></td>
                <td class="center" ng-bind="schedule.strDeceasedLast+', '+schedule.strDeceasedFirst+' '+schedule.strDeceasedMiddle" ng-hide="boolSchedule"></td>
                <td class="center" ng-hide="boolSchedule" ng-bind="schedule.intUnitIdFK"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Schedules -->

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

    <script>
        $('.datepicker').pickadate({
            selectMonths: true,//Creates a dropdown to control month
            selectYears: 15,//Creates a dropdown of 15 years to control year
//The title label to use for the month nav buttons
            labelMonthNext: 'Next Month',
            labelMonthPrev: 'Last Month',
//The title label to use for the dropdown selectors
            labelMonthSelect: 'Select Month',
            labelYearSelect: 'Select Year',
//Months and weekdays
            monthsFull: [ 'January', 'February', 'March', 'April', 'March', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
            monthsShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mar', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
            weekdaysFull: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ],
            weekdaysShort: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ],
//Materialize modified
            weekdaysLetter: [ 'S', 'M', 'T', 'W', 'T', 'F', 'S' ],
//Today and clear
            today: 'Today',
            clear: 'Clear',
            close: 'Close',
//The format to show on the `input` element
            format: 'mm/dd/yyyy'
        });
    </script>


</div>
@endsection