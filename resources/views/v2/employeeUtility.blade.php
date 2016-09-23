@extends('v2.baseLayout')
@section('title', 'Employee Utility')
@section('body')

     <!-- Import CSS/JS -->
<script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
<link rel = "stylesheet" href = "{!! asset('/css/employeeUtilities.css') !!}"/>
<script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/employee/controller.js') !!}"></script>

<body ng-controller="ctrl.employee">

<!-- Data Grid -->
<div>
    <div class = "main dataGrid col s12 m6 l3">
        <div class="row">
            <div id="admin">
                <div class="z-depth-2 card material-table">
                    <div class="table-header">
                        <h4>Employee Record</h4>
                        <div class="actions">
                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Create Employee" style = "margin-right: 10px;" href = "#modalCreateEmployee"><i class="material-icons" style = "color: black">add</i></button>
                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Employee" style = "margin-right: 10px;" href = "#modalArchiveEmployee"><i class="material-icons" style = "color: black">delete</i></button>
                            <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                        </div>
                    </div>
                    <table datatable="ng">
                        <thead >
                        <tr>
                            <th style = "font-size: .9vw; color: black;">Name</th>
                            <th style = "font-size: .9vw; color: black;">Address</th>
                            <th style = "font-size: .9vw; color: black;">Birth Day</th>
                            <th style = "font-size: .9vw; color: black;">Position</th>
                            <th style = "font-size: .9vw; color: black;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="employee in employeeList">
                            <td ng-bind="employee.strLastName+', '+employee.strFirstName+' '+employee.strMiddleName"></td>
                            <td ng-bind="employee.strAddress"></td>
                            <td ng-bind="employee.dateBirthday | amDateFilter : 'MMM D, YYYY'"></td>
                            <td ng-bind="employee.strPositionName"></td>
                            <td><button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Update Employee" style = "margin-right: 5px;" href = "#modalUpdateEmployee"><i class="material-icons" style = "color: black">mode_edit</i></button>
                                <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Employee" style = "margin-right: 5px;"><i class="material-icons" style = "color: black">not_interested</i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create Employee -->
<div id="modalCreateEmployee" class="modal modal-fixed-footer modalCreateEmployee" style = "overflow-y: hidden;">
    <div class = "modal-header" style = "background-color: #00897b;">
        <h4 class = "center modalCreateEmployeeH4">Create Employee</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <form autocomplete="off" ng-submit="saveEmployee()">
        <div class = "modal-content"  id="formCreate" style = "overflow-y: hidden;">
            <div class = "row">
                <div class = "col s3">
                    <div class = "view-img">
                        <img style = "max-width: 85%; height: 85%;" class = "insertEmployeeImage responsive-img circle" id="image2" src="{!! asset('/img/insert-image-employee.jpg') !!}" alt="..." />
                    </div>
                    <br>
                    <form action="#" style = "margin-left: -10px;">
                        <div class="file-field input-field" style = "margin-top: -55px;">
                            <div class="btn uploadbtn light-green" style = "color: black;">
                                <span>Image</span>
                                <input id = "upload" type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Select Image">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="headerDivider"></div>
                <div class = "col s9">
                    <div class = "employeeName container row col s12" style = "margin-top: -15px; padding-left: 10px;">
                        <div class="employeeOne input-field col s4">
                            <i class="material-icons prefix">account_circle</i>
                            <input ng-model="employee.strFirstName" id="firstName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Leyo'Leyo-Leyo" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" ng-pattern = "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="firstName" data-error = "INVALID" data-success = "">First Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <input ng-model="employee.strMiddleName" id="middleName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Dela-Cruz" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" ng-pattern = "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="middleName" data-error = "INVALID" data-success = "">Middle Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <input ng-model="employee.strLastName" id="lastName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Del'Rosario" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" ng-pattern = "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="lastName" data-error = "INVALID" data-success = "">Last Name<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "address row col s12">
                        <div class="addressOne input-field col s6">
                            <i class="material-icons prefix">room</i>
                            <input ng-model="employee.strAddress" id="addressNumber" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric and '-,. symbols.<br>*Example: Blk 85 Lot 25 Daffodil St. Rizal, Makati" required = "" aria-required="true" minlength = "1" maxlength="100" length = "100" ng-pattern = "[a-zA-Z0-9\'|\-|\.|\,|]+[a-zA-Z0-9\'|\-|\.|\,| ]+">
                            <label for="addressNumber" data-error = "INVALID" data-success = "">Address<span style = "color: red;">*</span></label>
                        </div>
                        <div class="dateOfBirth input-field col s6">
                            <i class="material-icons prefix">perm_contact_calendar</i>
                            <input ng-model="employee.dateBirthday" id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                            <label for="dateOfBirth">Birth Day<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "email row col s12">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">email</i>
                            <input ng-model="employee.strEmail" id="email" type="email" class="validate tooltipped"  data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only valid e-mail address.<br>*Example: yahoo@gmail.com">
                            <label for="email" data-error="INVALID" data-success="right">Email</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">vpn_key</i>
                            <input ng-model="employee.strPassword" id="password" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only. Max input: 20<br>*Example: 12345PASSWORD" required = "" aria-required="true" minlength = "1" maxlength="20" length = "20" ng-pattern = "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                            <label for="password" data-error = "Invalid format." data-success = "">Password<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "employeePosition row">
                        <div class="input-field col s6" style = "margin-top: -10px; overflow: auto; height: 150px;">
                            <div class="input-field col s12">
                                <select material-select watch ng-model="employee.intPositionId">
                                    <option value="" disabled selected>Select Position</option>
                                    <option ng-repeat="position in positionList" value="@{{ position.intPositionId }}">@{{ position.strPositionName }}</option>
                                </select>
                                <label>Employee Position</label>
                            </div>
                        </div>
                        <button type = "submit" name = "action" class="btnPosition modal-trigger btn light-green left" href = "#modalCreatePosition" style = "color: black; margin-top: 15px; margin-left: 10px;">New Position</button>
                    </div>

                    <i class = "requiredFieldCreate left">*Required Fields</i>

                </div>
            </div>
        </div>
    <div class="modal-footer">
        <button type="submit" name="action" class="btnModalUpdateConfirm btn light-green" style = "color: black; margin-right: 30px;">Confirm</button>
        <a class="btnModalUpdateCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
    </div>
    </form>
</div>

<!-- Modal Update Employee -->
<div id="modalUpdateEmployee" class="modalUpdateEmployee modal modal-fixed-footer" style = "overflow-y: hidden;">
    <div class = "modal-header">
        <h4 class = "modalUpdateEmployeeH4 center">Update Employee</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <form id="formUpdate">
        <div class = "modal-content" id="formCreate" style = "overflow-y: hidden;">
            <div class = "row">
                <div class = "col s3">
                    <div class = "view-img2">
                        <img style = "max-width: 85%; height: 85%;" class = "insertEmployeeImage responsive-img circle" id="image2" src="{!! asset('/img/insert-image-employee.jpg') !!}" alt="..." />
                    </div>
                    <br>
                    <form action="#" style = "margin-left: -10px;">
                        <div class="file-field input-field" style = "margin-top: -55px;">
                            <div class="btn uploadbtn2 light-green" style = "color: black;">
                                <span>Image</span>
                                <input id = "upload2" type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Select Image">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="headerDivider"></div>
                <div class = "col s9">
                    <div class = "employeeName container row col s12" style = "margin-top: -15px; padding-left: 10px;">
                        <div class="employeeOne input-field col s4">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="firstName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Leyo'Leyo-Leyo" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" ng-pattern = "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="firstName" data-error = "INVALID" data-success = "">First Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <input id="middleName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Dela-Cruz" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" ng-pattern = "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="middleName" data-error = "INVALID" data-success = "">Middle Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <input id="lastName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphabet and '- symbols.<br>*Example: Del'Rosario" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" ng-pattern = "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="lastName" data-error = "INVALID" data-success = "">Last Name<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "address row col s12">
                        <div class="addressOne input-field col s6">
                            <i class="material-icons prefix">room</i>
                            <input id="addressNumber" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric and '-,. symbols.<br>*Example: Blk 85 Lot 25 Daffodil St. Rizal, Makati" required = "" aria-required="true" minlength = "1" maxlength="100" length = "100" ng-pattern = "[a-zA-Z0-9\'|\-|\.|\,|]+[a-zA-Z0-9\'|\-|\.|\,| ]+">
                            <label for="addressNumber" data-error = "INVALID" data-success = "">Address<span style = "color: red;">*</span></label>
                        </div>
                        <div class="dateOfBirth input-field col s6">
                            <i class="material-icons prefix">perm_contact_calendar</i>
                            <input id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Format: Month-Day-Year.<br>*Example: 08/12/2000">
                            <label for="dateOfBirth">Birth Day<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "email row col s12">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" class="validate tooltipped"  data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only valid e-mail address.<br>*Example: yahoo@gmail.com">
                            <label for="email" data-error="INVALID" data-success="right">Email</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">vpn_key</i>
                            <input id="password" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only. Max input: 20<br>*Example: 12345PASSWORD" required = "" aria-required="true" minlength = "1" maxlength="20" length = "20" ng-pattern = "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                            <label for="password" data-error = "Invalid format." data-success = "">Password<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "employeePosition row">
                        <div class="input-field col s6" style = "margin-top: -10px; overflow: auto; height: 150px;">
                            <div class="input-field col s12">
                                <select>
                                    <option value="" disabled selected>Select Position</option>
                                    <option ng-repeat="position in positionList" value="@{{ position.intPositionId }}" ng-bind="position.strPositionName"></option>
                                </select>
                                <label>Employee Position</label>
                            </div>
                        </div>
                        <button type = "submit" name = "action" class="btnPosition modal-trigger btn light-green left" href = "#modalCreatePosition" style = "color: black; margin-top: 15px; margin-left: 10px;">New Position</button>
                    </div>

                    <i class = "requiredFieldCreate left">*Required Fields</i>

                </div>
            </div>
        </div>
        <div class="modal-footer fixed">
            <button type="submit" name="action" class="btnModalUpdateConfirm btn light-green" style = "color: black; margin-right: 45px;">Confirm</button>
            <a class="btnModalUpdateCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
        </div>
    </form>
</div>



<!-- Modal Create Position -->
<div id="modalCreatePosition" class="modalCreatePosition modal modal-fixed-footer">
    <div class = "modal-header">
        <h4 class = "center modalCreatePositionH4">Create New Position</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <form autocomplete="off" ng-submit="savePosition(position)">
        <div class="modal-content" id="formCreateItemCategory">
            <div class = "additionalsNewCategory">
                <div class = "row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">supervisor_account</i>
                        <input ng-model="position.strPositionName" id="positionName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" ng-pattern = "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                        <label for="positionName" data-error = "Invalid format." data-success = "">Position Name<span style = "color: red;">*</span></label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">https</i>
                        <input ng-model="position.intUserAuth" id="userAuthentication" type="number" class="validate" required = "" aria-required="true" minlength = "1" maxlength="20" length = "20">
                        <label for="userAuthentication" data-error = "Invalid format." data-success = "">User Authentication<span style = "color: red;">*</span></label>
                    </div>
                </div>
                <i class = "modalCreatePositionReqField">*Required Fields</i>
                <br>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black; margin-right: 20px;">Confirm</button>
            <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
        </div>
    </form>
</div>

<!-- Modal Archive Additionals-->
<div id="modalArchiveEmployee" class="modalArchive modal">
    <div class="modalArchiveContent modal-content">
        <!-- Data Grid Deactivated Additionals/s-->
        <div id="admin1" class="col s12">
            <div class="z-depth-2 card material-table">
                <div class="table-header">
                    <h4>Archive Additionals</h4>
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
                    <tr ng-repeat="additional in deactivatedAdditionals">
                        <td>@{{ additional.strAdditionalName }}</td>
                        <td>
                            <button name = "action" class="btnActivate btn light-green modal-close">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    $(document).ready(function() {

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.view-img img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#upload").change(function() {
            readURL(this);
        });

        $('.uploadbtn').on('click', function() {
            $('#upload').trigger('click');

        });
    });
</script>
<script>
 $(document).ready(function() {

     function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();

             reader.onload = function(e) {
                 $('.view-img2 img').attr('src', e.target.result);
             }

             reader.readAsDataURL(input.files[0]);
         }
     }
     $("#upload2").change(function() {
         readURL(this);
     });

     $('.uploadbtn2').on('click', function() {
         $('#upload2').trigger('click');

     });
 });
</script>

<script>
    $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal({dismissible: false});
    });

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
    //Copy settings and initialization tooltipped

</script>

@endsection

