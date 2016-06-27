@extends('v2.baseLayout')
@section('title', 'Employee Utility')
@section('body')

     <!-- Import CSS/JS -->

<link rel = "stylesheet" href = "{!! asset('/css/employeeUtilities.css') !!}"/>
<script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>

<body>

<!-- Data Grid -->
<div>
    <div class = "main dataGrid col s12 m6 l3">
        <div class="row">
            <div id="admin">
                <div class="z-depth-2 card material-table">
                    <div class="table-header">
                        <h3>Employee Record</h3>
                        <div class="actions">
                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Create Employee" style = "margin-right: 10px;" href = "#modalCreateEmployee"><i class="material-icons" style = "color: black">add</i></button>
                            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Employee" style = "margin-right: 10px;" href = "#modalArchiveEmployee"><i class="material-icons" style = "color: black">delete</i></button>
                            <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                        </div>
                    </div>
                    <table id="datatable">
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>            <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Update Employee" style = "margin-right: 10px;" href = "#modalUpdateEmployee"><i class="material-icons" style = "color: black">mode_edit</i></button>
                                <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Employee" style = "margin-right: 10px;"><i class="material-icons" style = "color: black">not_interested</i></button>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create Employee -->
<div id="modalCreateEmployee" class="modalCreateEmployee modal">
    <div class = "modal-header">
        <h4 class = "modalCreateEmployeeH4">Create Employee</h4>
    </div>
    <form id="formCreate">
        <div class="container vertical-divider">
            <div class="column two-third">
                <div class = "col s4">
                    <img class = "insertEmployeeImage responsive-img circle" id="image2" src="{!! asset('/img/insert-image-employee.jpg') !!}" alt="..." />

                    <br>
                    <div action="#" class = "col s3">
                        <div class="file-field input-field">
                            <div class="btn light-green" style = "color: black;">
                                <span>Image</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input id = "image" class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column one-third">
                <div class = "col s12">
                    <div class = "employeeName container row col s12" style = "padding-left: 10px;">
                        <div class="employeeOne input-field col s4">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="firstName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="firstName" data-error = "INVALID" data-success = "">First Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <input id="middleName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="middleName" data-error = "INVALID" data-success = "">Middle Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <input id="lastName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="lastName" data-error = "INVALID" data-success = "">Last Name<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "address row col s12">
                        <div class="addressOne input-field col s6">
                            <i class="material-icons prefix">room</i>
                            <input id="addressNumber" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="100" length = "100" pattern= "[a-zA-Z0-9\-|\.|\,|]+[a-zA-Z0-9\-|\.|\,| ]+">
                            <label for="addressNumber" data-error = "INVALID" data-success = "">Address<span style = "color: red;">*</span></label>
                        </div>
                        <div class="dateOfBirth input-field col s6">
                            <i class="material-icons prefix">perm_contact_calendar</i>
                            <input id="dateOfBirth" type="date" required="" aria-required="true" class="datepicker">
                            <label for="dateOfBirth">Birth Day<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "email row col s12">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" class="validate">
                            <label for="email" data-error="INVALID" data-success="right">Email</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">vpn_key</i>
                            <input id="password" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                            <label for="password" data-error = "Invalid format." data-success = "">Password<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "employeePosition row">
                        <div class="input-field col s6" style = "margin-top: 0px;">
                            <div class="input-field col s12">
                                <select>
                                    <option value="" disabled selected>Select Position</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>
                                <label>Employee Position</label>
                            </div>
                        </div>
                        <button type = "submit" name = "action" class="btnPosition modal-trigger btn light-green right" href = "#modalCreatePosition" style = "color: black; margin-top: 25px; margin-right: 10px;">New Position</button>
                    </div>
                    <i class = "requiredFieldCreate left">*Required Fields</i>

                </div>
            </div>
        </div>

        <div class="modal-footer modal-fixed-footer">
            <button type="submit" name="action" class="btnModalUpdateConfirm btn light-green" style = "color: black; margin-right: 45px;">Confirm</button>
            <a class="btnModalUpdateCancel btn light-green modal-close" style = "color: black; margin-right: 5px;">Cancel</a>
        </div>
    </form>
</div>

<!-- Modal Update Employee -->
<div id="modalUpdateEmployee" class="modalUpdateEmployee modal">
    <div class = "modal-header">
        <h4 class = "modalUpdateEmployeeH4">Update Employee</h4>
    </div>
    <form id="formUpdate">
        <div class="container vertical-divider">
            <div class="column two-third">
                <div class = "col s4">
                    <img class = "insertEmployeeImage responsive-img circle" id="image2" src="{!! asset('/img/insert-image-employee.jpg') !!}" alt="..." />

                    <br>
                    <div action="#" class = "col s3">
                        <div class="file-field input-field">
                            <div class="btn light-green" style = "color: black;">
                                <span>Image</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input id = "image" class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column one-third">
                <div class = "col s12">
                    <div class = "employeeName container row col s12" style = "padding-left: 10px;">
                        <div class="employeeOne input-field col s4">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="firstNameUpdate" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="firstNameUpdate" data-error = "Invalid format." data-success = "">First Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <input id="middleNameUpdate" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="middleNameUpdate" data-error = "Invalid format." data-success = "">Middle Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <input id="lastNameUpdate" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                            <label for="lastNameUpdate" data-error = "Invalid format." data-success = "">Last Name<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "address row col s12">
                        <div class="addressOne input-field col s6">
                            <i class="material-icons prefix">room</i>
                            <input id="addressNumberUpdate" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\.|\,|]+[a-zA-Z0-9\-|\.|\,| ]+">
                            <label for="addressNumberUpdate" data-error = "Invalid format." data-success = "">Address<span style = "color: red;">*</span></label>
                        </div>
                        <div class="dateOfBirth input-field col s6">
                            <i class="material-icons prefix">perm_contact_calendar</i>
                            <input id="dateOfBirthUpdate" type="date" required="" aria-required="true" class="datepicker">
                            <label for="dateOfBirthUpdate">Birth Day<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "email row col s12">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">email</i>
                            <input id="emailUpdate" type="email" class="validate">
                            <label for="emailUpdate" data-error="wrong" data-success="right">Email</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">vpn_key</i>
                            <input id="passwordUpdate" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                            <label for="passwordUpdate" data-error = "Invalid format." data-success = "">Password<span style = "color: red;">*</span></label>
                        </div>
                    </div>

                    <div class = "employeePosition row">
                        <div class="input-field col s6" style = "margin-top: 0px;">
                            <div class="input-field col s12">
                                <select>
                                    <option value="" disabled selected>Select Position</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>
                                <label>Employee Position</label>
                            </div>
                        </div>
                    </div>
                    <i class = "requiredFieldCreate left">*Required Fields</i>

                </div>
            </div>
        </div>

        <div class="modal-footer fixed">
            <button type="submit" name="action" class="btnModalUpdateConfirm btn light-green" style = "color: black; margin-right: 45px;">Confirm</button>
            <a class="btnModalUpdateCancel btn light-green modal-close" style = "color: black; margin-right: 5px;">Cancel</a>
        </div>
    </form>
</div>



<!-- Modal Create Position -->
<form id="modalCreatePosition" class="modalCreatePosition modal">
    <div class = "modal-header">
        <h4 class = "modalCreatePositionH4">Create New Position</h4>
    </div>
    <div class="modal-content" id="formCreateItemCategory">
        <div class = "additionalsNewCategory">
            <div class = "row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">supervisor_account</i>
                    <input id="positionName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z\-|\'|]+[a-zA-Z\-|\'| ]+">
                    <label for="positionName" data-error = "Invalid format." data-success = "">Position Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">https</i>
                    <input id="userAuthentication" type="number" class="validate" required = "" aria-required="true" minlength = "1" maxlength="20" length = "20">
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
        format: 'dd/mm/yyyy'
    });
    //Copy settings and initialization tooltipped


    $(document).ready(function() {
        $('select').material_select();
    });
</script>

@endsection

