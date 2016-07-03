@extends('maintenanceLayout')
@section('title', 'Package Maintenance')
@section('body')

<div ng-app="packageController">
    <script type="text/javascript" src="{!! asset('/js/Package_Record_Form.js') !!}"></script>
	<link rel = "stylesheet" href = "{!! asset('/css/packageMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/package/package-controller.js') !!}"></script>
    <script type="text/javascript" src = "{!! asset('/js/index.js') !!}"></script>

<style>

</style>


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
                                    <input ng-model="strPackageName" id="packageName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
                                    <label for="packageName" data-error = "Invalid format." data-success = "">Package Name<span style = "color: red;">*</span></label>
                                </div>
                                <div class="input-field col s6">
                                    <input ng-model="deciPrice" id="packagePrice" type="number" class="validate" required = "" aria-required="true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)" min = "1" max = "999999">
                                    <label for="packagePrice" data-error = "Invalid format." data-success = "">Package Price<span style = "color: red;">*</span></label>
                                </div>
                                <div class="packageDesc input-field col s12">
                                    <input ng-model="strPackageDesc" id="packageDesc" type="text" class="validate">
                                    <label for="packageDesc">Package Description</label>
                                </div>
                                <i class = "createReqField left">*Required Fields</i>
                            </div>

                            <div class = "row">
                                <div class = "btnAdditional col s6">
                                        <button type = "submit" name = "action" class="modal-trigger btn light-green left" style = "font-size: 10px; color: black; margin-left: 10px; margin-top: 10px; width: 190px; margin-right: 10px;" href = "#modalItem">Choose Additional/s</button>
                                </div>
                                <div class = "btnService col s6">
                                        <button type = "submit" name = "action" class="modal-trigger btn light-green left" style = "color: black; margin-top: 10px; font-size: 10px; margin-right: 10px; width: 180px;" href = "#modalService">Choose Service/s</button>
                                </div>
                            </div>

                            <label class = "totalCreatePriceH4">Total Price:</label>
                            <br>
                            <label class = "totalAmtH4">@{{ totalAmount | currency }}</label>

                        </div>
                    <br><br>
                    <button type = "submit" name = "action" class="btnCreate btn light-green right">Create</button>

                </form>
            </div>
        </div>



        <!-- Modal Additionals -->
        <div id="modalItem" class="modalAdditionals modal" ng-controller="ctrl.prepareAdditional">
            <div class = "modal-header">
                <h4 class = "inclusionsH4">Additionals Inclusion/s</h4>
            </div>
                <div class = "col s12">
                <br>
                        <h6 class = "modalAdditionalsH4">Additionals</h6>
                        <div class = "modalCheckbox" id="itemCheckBox">
                            <p ng-repeat="additional in additionals">
                                <input ng-click="AddAdditional(additional.price.deciPrice, $index)" ng-model="checkAdditional[$index]" ng-true-value="true" ng-false-value="false" type="checkbox" name="additionals[]" id="@{{ additional.intAdditionalId }}" value="@{{ additional.intAdditionalId }}" />
                                <label for="@{{ additional.intAdditionalId }}">@{{ additional.strAdditionalName }}( @{{ additional.price.deciPrice | currency }} )</label>
                            </p>
                        </div>
                    </div>

                <br><br><br>
                <label class = "totalAdditionalPriceH4">Total Additionals Price:</label>
                <br>
                <label class = "totalPriceH4">@{{ totalAdditionalPrice | currency}}</label>

                <div class = "modalFooter">
                    <div class="modal-footer">
                        <button type = "submit" name = "action" class="btn light-green modal-close" style = "color: black; margin-bottom: 0px; margin-top: 6px; margin-left: 10px; ">Done</button>
                    </div>
                </div>
        </div>

    <!-- Modal Service -->
    <div id="modalService" class="modalService modal" ng-controller="ctrl.prepareService">
        <div class = "modal-header">
            <h4 class = "serviceInclusionH4">Service Inclusion/s</h4>
        </div>
        <div class="modal-content">
            <div class = "col s12">
                <div class="row">
                    <div >
                        <div>
                            <h6 class = "servicesH4">Services</h6>
                            <div id="serviceCheckBox">
                                <p ng-repeat="service in services">
                                    <input ng-click="AddService(service.price.deciPrice, $index)" ng-model="checkService[$index]" ng-true-value="true" ng-false-value="false" type="checkbox" name="services[]" id="Service@{{ service.intServiceId }}" value="@{{ service.intServiceId }}" />
                                    <label for="Service@{{ service.intServiceId }}">@{{ service.strServiceName }} ( @{{ service.price.deciPrice | currency }} )</label>
                                </p>
							</div>
                        <br><br>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <label class = "totalServicePriceH4">Total Service Price:</label>
        <br>
        <label class = "servicePriceH4">@{{ totalServicePrice | currency }}</label>
        <br>

        <div class="modal-footer">
            <button name = "action" class="btnServiceDone btn light-green modal-close">Done</button>
        </div>
    </div>


    <!-- Modal Update -->
        <form id="modalUpdatePackage" class="modalUpdate modal" ng-controller="ctrl.updatePackage" ng-submit="SavePackage()">
            <div class = "modal-header">
                <h4 class = "updatePackageH4">Update Package</h4>
            </div>
            <div class="modal-content">
                <i class = "modalUpdateReqField left">*Required Fields</i>
                <br><br>

                    <div class="row">
                        <div class="input-field col s6">
                        	<input ng-model="update.intPackageId" id="packageToBeUpdated" type="hidden">
                            <input ng-model="update.strPackageName" value=" " placeholder="Package Name" id="packageNameUpdate" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "[a-zA-Z0-9\-|\'|]+[a-zA-Z0-9\-|\'| ]+">
                            <label for="packageNameUpdate" data-error = "Invalid format." data-success = "">New Package Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s6">
                            <input ng-model="update.deciPrice" value=" " placeholder="Package Price" id="packagePriceUpdate" type="number" class="validate" required = "" min = "1" max = "999999" aria-required="true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                            <label for="packagePriceUpdate" data-error = "Invalid format." data-success = "">New Package Price<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s12">
                            <input ng-model="update.strPackageDesc" value=" " placeholder="Package Description" id="packageDescUpdate" type="text" class="validate">
                            <label for="packageDescUpdate">New Package Description</label>
                        </div>

                        <button type = "submit" name = "action" class="btnUpdateAdditional modal-trigger btn light-green left" href = "#modalItem">Item/s</button>
                        <button type = "submit" name = "action" class="btnUpdateService modal-trigger btn light-green left" href = "#modalService">Service/s</button>
                    </div>
            </div>

            <div class="modal-footer">
                <button type = "submit" name = "action" class="btnUpdateConfirm btn light-green">Confirm</button>
                <a name = "action" class="btnUpdateCancel btn light-green modal-close">Cancel</a>
            </div>
        </form>


        <!-- Modal Deactivate -->
        <div id="modalDeactivatePackage" class="modal" style = "width: 400px;">
            <div class = "modal-header" style = "height: 55px;">
                <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">Deactivate Package</h4>
            </div>
            <input id="packageToBeDeactivated" type="hidden">
            <div class="modal-content">
                <p style = "padding-left: 30px; font-size: 15px;">Are you sure you want to deactivate this package?</p>
            </div>
            <div class="modal-footer">
                <button onclick="deactivatePackage()" name = "action" class="btn light-green" style = "color: black; margin-left: 10px; ">Confirm</button>
                <button name = "action" class="modal-close btn light-green" style = "color: black;">Cancel</button>
            </div>
        </div>

    <!-- Modal Package Includes -->
    <div id="modalPackageIncludes" class="modalPackageInclusion modal" ng-controller="ctrl.packageTable">
        <div class = "modal-header">
            <h4 class = "modalPackageH4">Package</h4>
        </div>
        <div class="modal-content">
        	<div id="inclusionDiv">
        	   <li ng-repeat="additional in packageAdditional">@{{ additional.strAdditionalName }}</li>
        	</div>
            
        </div>
        <div class="modal-footer">
            <button name = "action" class="btnPackageConfirm modal-close btn light-green">Confirm</button>

        </div>
    </div>

    <div id="modalListOfRequirement" class="modalRequirement modal" ng-controller="ctrl.packageTable">
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


    <!-- Modal Archive Package-->
    <div id="modalArchivePackage" class="modalArchive modal" ng-controller="ctrl.deactivatedTable">
        <div class="modal-content">
            <!-- Data Grid Deactivated Package/s-->
            <div id="admin1" class="col s12">
                <div class="z-depth-2 card material-table">
                    <div class="table-header">
                        <h4 class = "archiveH4">Archive Package/s</h4>
                        <a href="#" class="search-toggle btn-flat right"><i class="searchBtn material-icons right">search</i></a>
                    </div>
                    <table id="datatable2">
                        <thead>
                        <tr>
                            <th>Package Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="package in deactivatedPackages">
                            <td>@{{ package.strPackageName }}</td>
                            <td>
                                <button ng-click="ReactivatePackage(package.intPackageId, $index)" name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button name = "action" class="btnArchiveDone btn light-green modal-close right">DONE</button>
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
                                <td><button ng-click="ViewPackage(package.intPackageId)" name = "action" data-target="modalPackageIncludes" class="modal-trigger light-green center"><i class="material-icons" style = "color: black;">visibility</i></button>
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
</div>
@endsection