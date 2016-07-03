@extends('maintenanceLayout')
@section('title', 'Package Maintenance')
@section('body')

<div ng-app="packageController">
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/Package_Record_Form.js') !!}"></script>
	<link rel = "stylesheet" href = "{!! asset('/css/packageMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/package/package-controller.js') !!}"></script>
    <script type="text/javascript" src = "{!! asset('/js/index.js') !!}"></script>


<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
    <div class = "row">
        <div class = "col s4">
            <div id="alertDiv">
            </div>

            <!-- Create Package -->
            <div class = "col s12" ng-controller="ctrl.newPackage">
                <form class = "formCreate aside aside z-depth-3" id="formCreate" ng-submit="CreatePackage()">
                    <div class = "createPackageHeader">
                        <h4 class = "createFormH4">Package Maintenance</h4>
                    </div>
                        <div class="row">
                            <div class = "formStyle row">
                                <div class="input-field col s6">
                                    <input ng-model="strPackageName" id="packageName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Senior's Cremation Package" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
                                    <label for="packageName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
                                </div>
                                <div class="packageDesc input-field col s12">
                                    <input ng-model="strPackageDesc" id="packageDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: This package includes: cremation service with urn.">
                                    <label for="packageDesc">Description</label>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "btnAdditional col s6">
                                        <button type = "submit" name = "action" class="modal-trigger btn light-green left" style = "font-size: 10px; color: black; margin-left: 10px; margin-top: 10px; width: 180px; margin-right: 10px;" href = "#modalItem">Choose Additional/s</button>
                                </div>
                                <div class = "btnService col s6">
                                        <button type = "submit" name = "action" class="modal-trigger btn light-green left" style = "color: black; margin-top: 10px; font-size: 10px; margin-right: 10px; width: 180px;" href = "#modalService">Choose Service/s</button>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col s6" style = "margin-top: 4px;">
                                    <label class = "totalCreatePriceH4">Total Price:</label>
                                    <br>
                                    <label class = "totalAmtH4">@{{ totalAmount | currency }}</label>
                                </div>
                                <div class="input-field col s6" style = "margin-top: 0px;">
                                    <input ng-model="deciPrice" id="packagePrice" type="number" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: P 0.00" required = "" aria-required="true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)" min = "1" max = "999999">
                                    <label for="packagePrice" data-error = "Invalid format." data-success = "">Price<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <i class = "createReqField left">*Required Fields</i>
                        </div>
                    <br><br>
                    <button type = "submit" name = "action" class="btnCreate btn light-green right">Create</button>
                </form>
            </div>
        </div>

    <div id="modalListOfRequirement" class="modalRequirement modal modal-fixed-footer" ng-controller="ctrl.packageTable">
            <div class = "modal-header">
                <h4 class = "modalRequirementH4">Package include/s</h4>
            </div>
            <div class="modal-content">
                <ul class="collection with-header">
                    <li class="collection-header"><h4 class = "additionalListH4">Additional List</h4></li>
                    <div ng-repeat="additional in packageAdditionals">
                    <li class="collection-item">@{{ additional.strAdditionalName }}</li>
                    </div>
                    <li class="collection-header"><h4 class = "serviceListH4">Service List</h4></li>
                    <div ng-repeat="service in packageServices">
                    <li class="collection-item">@{{ service.strServiceName }}</li>
                    </div>
                </ul>
            </div>
            <div class="modal-footer">
                <button name = "action" class="btnRequirementDone modal-close btn light-green">Done</button>
            </div>
        </div>


    <!-- Data Grid -->
        <div class = "packageDataGrid col s7" style = "margin-left: 50px;" ng-controller="ctrl.packageTable">
            <div class="row">
                <div id="admin">
                    <div class="z-depth-2 card material-table">
                        <div class="table-header">
                            <h4 class = "dataGridH4">Package Record</h4>

                            <div class="actions">
                                <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Package/s" style = "margin-right: 10px;" href = "#modalArchivePackage"><i class="material-icons" style = "color: black;">delete</i></button>
                                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                            </div>
                        </div>
                        <table id="datatable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Includes:</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="package in packages">
                                <td>@{{ package.strPackageName }}</td>
                                <td>@{{ package.price.deciPrice | currency }}</td>
                                <td>@{{ package.strPackageDesc }}</td>
                                <td><button ng-click="ViewPackage(package.intPackageId)" name = "action" data-target="modalPackageIncludes" class="modal-trigger light-green center btn-floating"><i class="material-icons" style = "color: black;">visibility</i></button>
                                <td>
                                    <button ng-click="UpdatePackage(package.intPackageId, $index)" name = "action" data-target="modalUpdatePackage" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button ng-click="DeactivatePackage(package.intPackageId, $index)" name = "action" data-target="modalDeactivatePackage" class="modal-trigger btn-floating light-green"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    
    <script>
        $('.modal-trigger').leanModal({
                    dismissible: false
                }
        );
    </script>
    @include('modals.package.archive')
    @include('modals.package.additionals')
    @include('modals.package.service')
    @include('modals.package.update')
</div>
@endsection