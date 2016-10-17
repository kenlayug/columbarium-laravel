@extends('v2.baseLayout')
@section('title', 'Package Maintenance')
@section('body')

<div ng-controller="ctrl.package">
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/Package_Record_Form.js') !!}"></script>
	<link rel = "stylesheet" href = "{!! asset('/css/packageMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/package/controller.js') !!}"></script>
    <script type="text/javascript" src = "{!! asset('/js/index.js') !!}"></script>

<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
    <div class = "row">
            <!-- Create Package -->
            <div class = "col s12 m6 l4">
                <form class = "formCreate aside aside z-depth-3" id="formCreate" ng-submit="createPackage()">
                    <div class = "createPackageHeader">
                        <h4 class = "center createFormH4">Package Maintenance</h4>
                    </div>
                        <div class="row">
                            <div class = "formStyle row">
                                <div class="input-field col s6">
                                    <input ng-model="newPackage.strPackageName" id="packageName" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Senior's Cremation Package" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                                    <label for="packageName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
                                </div>
                                <div class="packageDesc input-field col s12">
                                    <input ng-model="newPackage.strPackageDesc" id="packageDesc" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: This package includes: cremation service with urn.">
                                    <label for="packageDesc">Description</label>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "btnAdditional col s6">
                                        <a type = "submit" name = "action" class="modal-trigger btn light-green left" style = "font-size: 10px; color: black; margin-left: 10px; margin-top: 10px; width: 190px; margin-right: 10px;" href = "#modalAdditionals">Choose Additional/s</a>
                                </div>
                                <div class = "btnService col s6">
                                        <a type = "submit" name = "action" class="modal-trigger btn light-green left" style = "color: black; margin-top: 10px; font-size: 10px; margin-right: 10px; width: 180px;" href = "#modalService">Choose Service/s</a>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col s6" style = "margin-top: 4px;">
                                    <label class = "totalCreatePriceH4">Total Price:</label>
                                    <br>
                                    <label class = "totalAmtH4">@{{ totalPackagePrice | currency: "₱" }}</label>
                                </div>
                                <div class="input-field col s6" style = "margin-top: 0px;">
                                    <input ng-model="newPackage.deciPrice"
                                           ui-number-mask
                                           id="packagePrice" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: P 0.00" required = "" aria-required="true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$" min = "1" max = "999999">
                                    <label for="packagePrice" data-error = "Invalid format." data-success = "">Price<span style = "color: red;">*</span></label>
                                </div>
                            </div>
                            <i class = "createReqField left">*Required Fields</i>
                        </div>
                    <br><br>
                    <button type = "submit" name = "action" class="btnCreate btn light-green right">Create</button>
                </form>
            </div>

    <div id="modalPackageInclusion" class="modalRequirement modal">
            <div class = "modal-header">
                <h4 class = "modalRequirementH4">Package include/s</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <div class="modal-content">
                <ul class="collection with-header">
                    <li class="collection-header"><h5 class = "center">Additional List</h5></li>
                    <div ng-repeat="additional in packageAdditionalList">
                    <li class="collection-item center">@{{ additional.strAdditionalName }}(@{{ additional.intQuantity }})</li>
                    </div>
                    <li class="collection-header"><h5 class = "center">Service List</h5></li>
                    <div ng-repeat="service in packageServiceList">
                    <li class="collection-item center">@{{ service.strServiceName }}(@{{ service.intQuantity }})</li>
                    </div>
                </ul>
            </div>
            <div class="modal-footer">
                <button name = "action" class="btnRequirementDone modal-close btn light-green" style = "margin-right: 20px;">Done</button>
            </div>
        </div>


    <!-- Data Grid -->
        <div class = "packageDataGrid col s12 m6 l8">
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
                        <table id="datatable" datatable="ng">
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
                            <tr ng-repeat="package in packageList">
                                <td>@{{ package.strPackageName }}</td>
                                <td>@{{ package.price.deciPrice | currency:"₱" }}</td>
                                <td>@{{ package.strPackageDesc }}</td>
                                <td><button tooltipped ng-click="viewInclusions(package.intPackageId)" name = "action" data-target="modalPackageIncludes" class="btn modal-trigger light-green center btn-floating" data-position = "bottom" data-delay = "30" data-tooltip = "View Inclusion/s"><i class="material-icons" style = "color: black;">visibility</i></button>
                                <td>
                                    <button tooltipped ng-click="getPackage(package.intPackageId, $index)" name = "action" data-target="modalUpdatePackage" class="btn modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Update Package"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button tooltipped ng-click="deletePackage(package.intPackageId, $index)" name = "action" data-target="modalDeactivatePackage" class="btn modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Package"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Additionals -->
        <div id="modalAdditionals" class="modalService modal">
            <div class = "modal-header">
                <h4 class = "center inclusionsH4">Additionals Inclusion/s</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <div class="modal-content">
                <div class = "col s12">
                    <div class = "row">
                        <!-- Data Grid -->
                        <div class = "col s6">
                            <div style = "margin-top: -10px; margin-left: -10px; width: 800px;">
                                <div id="admin">
                                    <div class="z-depth-2 card material-table">
                                        <table id="datatable4" datatable="ng">
                                            <thead>
                                            <tr>
                                                <th style='width: 5px;'></th>
                                                <th>Name</th>
                                                <th>Additional Price</th>
                                                <th style = "font-size: 12px;">Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr style = "height: 50px;" ng-repeat="additional in additionalList">
                                                <td>
                                                    <input ng-click="updateTotalAdditionalPrice(additional)" ng-model="additional.selected" type="checkbox" class="filled-in" id="@{{ additional.intAdditionalId }}" value="1" />
                                                    <label for="@{{ additional.intAdditionalId }}"></label>
                                                </td>
                                                <td style = "margin-top: 0px;">@{{ additional.strAdditionalName }}</td>
                                                <td style = "margin-top: 0px;">@{{ additional.price.deciPrice | currency: "₱"}}</td>
                                                <td style = "width: 150px;">
                                                    <div class="required input-field col s10" style = "margin-top: 0px; padding-left: -20px;">
                                                        <input ng-change="updateTotalAdditionalPrice(null)"
                                                                ng-disabled='additional.selected != 1'
                                                               ui-number-mask="0"
                                                               ng-model="additional.intQuantity" id="additionalQuantity" type="text" placeholder="0" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole number only. Max input: 10<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "10">
                                                    </div>
                                                </td>
                                                <td style = "width: 120px; margin-top: 0px;">@{{ additional.price.deciPrice * additional.intQuantity | currency: "₱"}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="headerDivider"></div>
                        <div class = "col s6">
                            <label class = "totalAdditionalPriceH4">Total Additionals Price:</label>
                            <label class = "totalPriceH4">@{{ totalAdditionalPrice | currency: "₱" }}</label>
                            <div class="modal-footer">
                                <button ng-click="updateTotalPackagePrice()" name = "action" class="btnServiceDone btn light-green modal-close right" style = "margin-top: 210px;">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Service -->
        <div id="modalService" class="modalService modal">
            <div class = "modal-header">
                <h4 class = "center serviceInclusionH4">Service Inclusion/s</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <div class="modal-content">
                <div class = "col s12">
                    <div class = "row">
                        <!-- Data Grid -->
                        <div class = "col s6">
                            <div style = "margin-top: -10px; margin-left: -10px; width: 800px;">
                                <div id="admin">
                                    <div class="z-depth-2 card material-table">
                                        <table id="datatable2" datatable="ng">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Service Price</th>
                                                <th style = "font-size: 12px;">Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr style = "height: 50px;" ng-repeat="service in serviceList">
                                                <td>
                                                    <form action="#" style = "margin-top: 10px;">
                                                        <p>
                                                            <input ng-model="service.selected"
                                                                   ng-click="updateTotalServicePrice(service)"
                                                                   type="checkbox" class="filled-in" id="service@{{ service.intServiceId }}"/>
                                                            <label for="service@{{ service.intServiceId }}"></label>
                                                        </p>
                                                    </form>
                                                </td>
                                                <td style = "margin-top: 0px;">@{{ service.strServiceName }}</td>
                                                <td style = "margin-top: 0px;">@{{ service.price.deciPrice | currency: "₱" }}</td>
                                                <td style = "width: 150px;">
                                                    <div class="required input-field col s10" style = "margin-top: 0px; padding-left: -20px;">
                                                        <input ng-model="service.intQuantity"
                                                               ng-change="updateTotalServicePrice(null)"
                                                               ui-number-mask="0"
                                                               ng-disabled='service.selected != 1'
                                                               id="serviceQuantity" type="text" placeholder="0" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts whole number only. Max input: 10<br>*Example: 5" required = "" aria-required = "true" min = "1" max = "10">
                                                    </div>
                                                </td>
                                                <td style = "width: 120px; margin-top: 0px;">@{{ service.price.deciPrice * service.intQuantity | currency: "₱" }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="headerDivider"></div>
                        <div class = "col s6">
                            <label class = "totalServicePriceH4">Total Service Price:</label>
                            <label class = "servicePriceH4">@{{ totalServicePrice | currency: "₱" }}</label>
                            <div class="modal-footer">
                                <button ng-click="updateTotalPackagePrice()" name = "action" class="btnServiceDone btn light-green modal-close right" style = "margin-top: 210px;">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal Update -->
    <div id="modalUpdatePackage" class="modalUpdate modal modal-fixed-footer">
        <form ng-submit="fUpdatePackage()">
            <div class = "modal-header">
                <h4 class = "updatePackageH4">Update Package</h4>
                <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
                   style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
                </a>
            </div>
            <div class="modal-content">

                <div class="row" style = "margin-top: -10px;">
                    <div class="input-field col s6">
                        <input ng-model="updatePackage.strPackageName" value=" " placeholder="Package Name" id="packageNameUpdate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Senior's Cremation Package" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                        <label for="packageNameUpdate" data-error = "Invalid format." data-success = "">New Name<span style = "color: red;">*</span></label>
                    </div>
                    <div class="input-field col s12">
                        <input ng-model="updatePackage.strPackageDesc" value=" " placeholder="Package Description" id="packageDescUpdate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: This package includes: cremation service with urn.">
                        <label for="packageDescUpdate">New Description</label>
                    </div>

                    <div class = "row">
                        <div class = "btnAdditional col s6">
                            <a class="modal-trigger btn light-green left" style = "font-size: 13px; color: black; margin-left: 0px; margin-top: 20px; width: 240px; margin-right: 10px;" href = "#modalAdditionals">Choose Additional/s</a>
                        </div>
                        <div class = "btnService col s6">
                            <a class="modal-trigger btn light-green left" style = "color: black; margin-top: 20px; font-size: 14px; margin-left: 40px; width: 240px;" href = "#modalService">Choose Service/s</a>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col s6" style = "margin-top: 4px;">
                    <label class = "totalCreatePriceH4">Total Price:</label>
                            <br>
                            <label class = "totalAmtH4">@{{ totalAdditionalPrice + totalServicePrice | currency: "₱" }}</label>
                        </div>
                        <div class="input-field col s6" style = "margin-top: 0px;">
                            <input ng-model="updatePackage.price.deciPrice"
                                   ui-number-mask
                                   id="packagePrice" type="text" placeholder = "P 0.00" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: P 0.00" required = "" aria-required="true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$" min = "1" max = "999999">
                            <label for="packagePrice" data-error = "Invalid format." data-success = "">New Price<span style = "color: red;">*</span></label>
                        </div>
                    </div>
                </div>
                <i class = "modalUpdateReqField left">*Required Fields</i>
            </div>
            <div class="modal-footer">
                <button type = "submit" name = "action" class="btnUpdateConfirm btn light-green" style = "margin-left: 10px; margin-right: 20px;">Confirm</button>
                <a ng-click="closeUpdate()" name = "action" class="btnUpdateCancel btn light-green modal-close">Cancel</a>
            </div>
        </form>
    </div>


    <script>

        $('.modal-trigger').leanModal({
                    dismissible: false
                }
        );
    </script>
    @include('modals.package.archive')
    @include('modals.package.additionals')
</div>
@endsection