@extends('v2.baseLayout')
@section('title', 'Service Maintenance')
@section('body')


    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/serviceMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/service/controller.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>

    <div ng-controller="ctrl.service">
        <!-- Section -->
        <div class = "parent">
            <div class = "row">
                    <!-- Create Service -->
                    <div class = "col s12 m6 l4">
                        <div class = "formCreate aside aside z-depth-3" id="formCreate">
                            <div class = "createFormHeader">
                                <h4 class = "formCreateH4">Service Maintenance</h4>
                            </div>
                            <form ng-submit="saveService()" autocomplete="off">
                                <div class="formCreateStyle row" id="formCreate">
                                    <div class = "row">
                                        <div class="input-field col s6">
                                            <input ng-model="newService.strServiceName" id="serviceName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Installation" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                                            <label for="serviceName" data-error = "Invalid Format." data-success = "">Name<span style = "color: red;">*</span></label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input ng-model="newService.deciPrice"
                                                   ui-number-mask
                                                   id="servicePrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" min="1" max = "999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                            <label for="servicePrice" data-error = "Invalid Format." data-success = "">Price<span style = "color: red;">*</span></label>
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <input ng-model="newService.strServiceDesc" id="serviceDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Service offered to add additionals in a certain unit.">
                                        <label for="serviceDesc" data-error = "Invalid Format." data-success = "">Description</label>
                                    </div>
                                    <div class = "serviceCategory row">
                                        <div class="input-field col s6">
                                            <select ng-model="newService.intServiceCategoryId" id="selectServiceCategory" material-select watch>
                                                <option value="" disabled selected>Choose Category</option>
                                                <option ng-repeat="serviceCategory in serviceCategoryList" value="@{{ serviceCategory.intServiceCategoryId }}">@{{ serviceCategory.strServiceCategoryName }}</option>
                                            </select>
                                        </div>
                                        <a type = "submit" name = "action" class="modal-trigger btn light-green right" style = "color: black; margin-right: 10px; margin-top: 20px;" href = "#modalServiceCategory">New Category</a>
                                    </div>
                                    <div class = "row">
                                        <div class='col s12'>
                                            <a name = "action" class="modal-trigger btn light-green" style = "color: black;" href = "#modalRequirement">Choose Requirement</a>
                                        </div>
                                    </div>

                                </div>
                                <i class = "createReqField left" style = "padding-left: 20px;">*Required Fields</i>

                                <button type = "submit" name = "action" class="btn light-green right" style = "margin-top: 10px; color: black; margin-right: 10px;">Create</button>
                            </form>
                        </div>
                    </div>


                <!-- Data Grid -->
                <div class = "serviceDataGrid col s12 m6 m8">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header">
                                    <h4 class = "dataGridH4">Service Record</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Service/s" style = "margin-right: 10px;" href = "#modalArchiveService"><i class="material-icons" style = "color: black;">delete</i></button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatable" datatable='ng'>
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Requirement</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="service in serviceList">
                                        <td>@{{ service.strServiceName }}</td>
                                        <td>@{{ service.price.deciPrice | currency: "₱"}}</td>
                                        <td>@{{ service.strServiceDesc }}</td>
                                        <td><button ng-click="viewRequirements(service.intServiceId)" name = "action" class="btn tooltipped modal-trigger btn light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "View Requirement/s" style = "color: black; font-size: 10px; width: 100px; margin-right: 10px;" href = "#modalListOfRequirement">View</button></td>
                                        <td><button ng-click="getService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                            <button ng-click="deleteService(service.intServiceId, $index)" name = "action" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Update -->
        <div id="modalUpdateService" class="modalUpdate modal modal-fixed-footer">
            <div class = "modal-header">
                <h4 class = "center updateService">Update Service</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <form class="modal-content" id="formUpdate" ng-submit="fUpdateService()">

                <div class="updateFormStyle row" style = "margin-top: -20px;">
                    <div class="input-field col s6">
                        <input ng-model="updateService.strServiceName" id="serviceNameUpdate" value=" " type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Installation" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                        <label id="updateName" for="serviceNameUpdate" data-error = "Check format field." data-success = "">New Name<span style = "color: red;">*</span></label>
                    </div>
                    <div class="input-field col s6">
                        <input ng-model="updateService.price.deciPrice"
                               ui-number-mask
                               id="servicePriceUpdate" value="0" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts valid price format only.<br>*Example: P 0.00" min="1" max="999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                        <label id="updatePrice" for="servicePriceUpdate" data-error = "Check format field." data-success = "">New Price<span style = "color: red;">*</span></label>
                    </div>
                </div>
                <div class="input-field col s12" style = "margin-top: -10px; margin-left: 20px;">
                    <input ng-model="updateService.strServiceDesc" id="serviceDescUpdate" value=" " type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Service offered to add additionals in a certain unit.">
                    <label id="updateDesc" for="serviceDescUpdate" data-error = "Check format field." data-success = "">New Description</label>
                </div>
                <div class = "serviceCategory row" style = "margin-left: 10px; margin-top: 0px;">
                    <div class="input-field col s6">
                        <select ng-model="updateService.intServiceCategoryId" material-select id="selectServiceCategory">
                            <option value="" disabled selected>Choose Category</option>
                            <option ng-repeat="serviceCategory in serviceCategoryList" value="@{{ serviceCategory.intServiceCategoryId }}">@{{ serviceCategory.strServiceCategoryName }}</option>
                        </select>
                    </div>
                    <a type = "submit" name = "action" class="modal-trigger btn light-green right" style = "color: black; margin-right: 0px; margin-top: 20px; width: 220px;" href = "#modalServiceCategory">New Category</a>
                </div>
                <div class = "row">
                    <div class="input-field col s6">
                        <select ng-model="updateService.intServiceForm" material-select>
                            <option value="" disabled selected>Choose Form</option>
                            <option value="1">Deceased Form</option>
                            <option value="2">Unit Form</option>
                            <option value="0">No Form</option>
                        </select>
                    </div>
                    <a name = "action" class="modal-trigger btn light-green right" style = "color: black; font-size: 12px; width: 220px; margin-top: -20px; margin-left: 40px;" href = "#modalRequirement">Choose Requirement</a>
                    <i class = "createReqField left" style = "margin-top: 40px; padding-left: 20px;">*Required Fields</i>
                </div>

                <div class="btnUpdateConfirm modal-footer" style = "height: 55px;">
                    <button type = "submit" name = "action" class="btn light-green" style = "margin-right: 20px; color: black; margin-left: 10px; ">Confirm</button>
                    <a name = "action" class="modal-close btn light-green" style = "color: black;">Cancel</a>
                </div>
            </form>
        </div>

        <div id="modalViewRequirement" class="modal modal-fixed-footer" style = "width: 500px; height: 450px;">
            <div class = "modal-header">
                <h4 style = "font-family: fontSketch; font-size: 2.2vw; color: white; padding-left: 85px;">List of Requirement</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <div class="modal-content">
                <ul class="collection with-header">
                    <li class="collection-header"><h4 class = "additionalListH4 center" style = "font-size: 20px;">Requirement List</h4></li>
                    <div ng-repeat="requirement in serviceRequirementList">
                        <li class="collection-item center">@{{ requirement.strRequirementName }}</li>
                    </div>
                </ul>
            </div>
            <div class="modal-footer">
                <button name = "action" class="btnRequirementDone modal-close btn light-green" style = "margin-right: 20px; color: black;">Done</button>
            </div>
        </div>

        <!-- Modal Requirements -->
        <div id="modalRequirement" class="modalRequirement modal modal-fixed-footer">
            <div class = "modal-header">
                <h4 class = "listOfReqH4">List of Requirement/s</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <div class="modal-content">
                <div class = "col s12">
                    <br>
                    <div class="row">
                        <div class = "col s6">
                            <p ng-repeat="requirement in requirementList">
                                <input type="checkbox" id="@{{ requirement.intRequirementId }}" name="requirement[]" value="@{{ requirement.intRequirementId }}" />
                                <label for="@{{ requirement.intRequirementId }}">@{{ requirement.strRequirementName }}</label>
                            </p>
                        </div>

                        <div class = "col s6">

                        </div>
                    </div>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br>

                <div class="modal-footer" style = "width: 575px;">
                    <button onclick="$('#modalRequirement').closeModal()" name = "action" class="btn light-green right" style = "color: black;">CONFIRM</button>
                    <button name = "action" class="waves-effect waves-light modal-close btn light-green" style = "color: black; margin-right: 10px;">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Modal Service Category -->
        <div id="modalServiceCategory" class="modalServiceCategory modal modal-fixed-footer">
            <div class = "modalCategoryHeader modal-header">
                <h4 class = "center text">Service Category</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <form ng-submit="saveServiceCategory()" novalidate autocomplete="off">
                <div class="modal-content" style = "overflow-y: hidden;">
                        <div class = "row">
                            <div class = "col s4">
                                <div class="input-field col s12" style = "margin-top: -10px; padding-left: 10px;">
                                    <input ng-model="newServiceCategory.strServiceCategoryName" id="serviceCategoryDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Cremation" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                    <label for="serviceCategoryDesc" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
                                </div>

                                <div class="input-field col s12">
                                    <select ng-model='newServiceCategory.intServiceType' id = "test" name = "form_select" onchange = "showDiv(this)" material-select>
                                        <option class = "serviceType" value="" disabled selected>Type</option>
                                        <option value="0" class = "serviceType">Unit Servicing</option>
                                        <option value="1" class = "serviceType">Scheduled Service</option>
                                        <option value="2" class = "serviceType">For Return</option>
                                    </select>
                                </div>

                                <div class="input-field col s12" id = "hidden_scheduledService" style = "display: none;">
                                    <input ng-model='newServiceCategory.intServiceSchedulePerDay' name = "serviceQuantity" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts number/s only.<br>*Example: 6" required = "" aria-required="true" min = "1" minlength = "1" maxlength="10" length = "10">
                                    <label for="serviceQuantity" data-error = "Invalid Format." data-success = "">Service Schedule Log<span style = "color: red;">*</span></label>
                                </div>
                                <div class="input-field col s12" id = "hidden_forReturn" style = "display: none;">
                                    <input ng-model='newServiceCategory.intServiceDayInterval' name = "numberOfDays" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts number/s only.<br>*Example: 5" required = "" aria-required="true" min = "1" minlength = "1" maxlength="10" length = "10">
                                    <label for="numberOfDays" data-error = "Invalid Format." data-success = "">Number of Days<span style = "color: red;">*</span></label>
                                </div>

                                <i class = "modalCatReqField left" style = "padding-left: 10px;">*Required Fields</i>
                            </div>
                            <div class="headerDivider2"></div>
                            <div class = "col s8">
                                <!-- Data Grid -->
                                <div class = "col s12" style = "width: 100%;">
                                    <div class="row">
                                        <div id="admin">
                                            <div class="z-depth-2 card material-table">
                                                <table id="connectToRoom">
                                                    <thead>
                                                    <tr>
                                                        <th>Number</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <button name = "action" class="btn light-green modal-close modal-trigger left" href = "#modalConnectToRoom" style = "font-size: 11px; margin-left: 10px; color: black; margin-right: 10px;">Connect to Room</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            <button name = "action" class="btn light-green modal-close modal-trigger left" href = "#modalConnectToRoom" style = "font-size: 11px; margin-left: 10px; color: black; margin-right: 10px;">Connect to Room</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            <button name = "action" class="btn light-green modal-close modal-trigger left" href = "#modalConnectToRoom" style = "font-size: 11px; margin-left: 10px; color: black; margin-right: 10px;">Connect to Room</button>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                </div>
                <div class="modal-footer">
                    <button name = "action" class="btnConfirmCategory btn light-green" style = "color: black; margin-right: 20px;">Confirm</button>
                    <a name = "action" class="btnCancel btn light-green modal-close" style = "color: black; margin-right: 10px;">Cancel</a>
                </div>
            </form>
        </div>

        <div id="modalConnectToRoom" class="modal modal-fixed-footer" style = "overflow-y: hidden; height: 380px; width: 650px;">
            <div class = "modal-header box" style = "height: 55px;">
                <h4 class = "center" style = "padding-top: 8px; color: white; font-family: roboto3;">Connect to Room</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <form>
                <div class = "modal-content" style = "overflow-y: auto;">
                    <ul class="collapsible" data-collapsible="accordion" style = "width: 80%; margin-left: 75px; margin-bottom: 60px;">
                        <li>
                            <div class="collapsible-header" style = "background-color: #00897b">
                                <i class="material-icons">business</i><label class = "flow-text" style = "color: white; font-family: roboto3;">Main Building</label></div>
                            <div class="collapsible-body">
                                <div class="row">
                                    <div class="col s12 m12">
                                        <ul class="collapsible popout" data-collapsible="accordion">
                                            <li>
                                                <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                    <i class="material-icons">view_module</i>First Floor
                                                </div>
                                                <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                    <p style = "padding-top: 10px;">St. Peter
                                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Add to room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;"><i class="material-icons" style = "color: black;">add</i></button>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                    <i class="material-icons">view_module</i>Second Floor</div>
                                                <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                    <p style = "padding-top: 10px;">St. Joseph
                                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Add to room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;"><i class="material-icons" style = "color: black;">add</i></button>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header" style = "background-color: #00897b">
                                <i class="material-icons">business</i><label class = "flow-text" style = "color: white; font-family: roboto3;">Pastrana</label></div>
                            <div class="collapsible-body">
                                <div class="row">
                                    <div class="col s12 m12">
                                        <ul class="collapsible popout" data-collapsible="accordion">
                                            <li>
                                                <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                    <i class="material-icons">view_module</i>First Floor
                                                </div>
                                                <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                    <p style = "padding-top: 10px;">St. Peter
                                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Add to room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;"><i class="material-icons" style = "color: black;">add</i></button>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                    <i class="material-icons">view_module</i>Second Floor</div>
                                                <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                    <p style = "padding-top: 10px;">St. Joseph
                                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Add to room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;"><i class="material-icons" style = "color: black;">add</i></button>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header" style = "background-color: #fb8c00;">
                                                    <i class="material-icons">view_module</i>Third Floor</div>
                                                <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                    <p style = "padding-top: 10px;">St. John
                                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Add to room."  style = "margin-top: -5px; margin-right: -20px; margin-left: 5px;"><i class="material-icons" style = "color: black;">add</i></button>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button name = "action" class="btn light-green" style = "margin-right: 10px; color: black; margin-left: 10px;">Confirm</button>
                    <a name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</a>
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal({dismissible: false});
            });
        </script>

        <script type="text/javascript">
            function showDiv(elem){
                if(elem.value == 0)
                    document.getElementById('hidden_scheduledService').style.display = "none";
                if(elem.value == 0)
                    document.getElementById('hidden_forReturn').style.display = "none";
                if(elem.value == 1)
                    document.getElementById('hidden_scheduledService').style.display = "block";
                if(elem.value == 1)
                    document.getElementById('hidden_forReturn').style.display = "none";
                if(elem.value == 2)
                    document.getElementById('hidden_forReturn').style.display = "block";
                if(elem.value == 2)
                    document.getElementById('hidden_scheduledService').style.display = "none";
            }
        </script>
@endsection