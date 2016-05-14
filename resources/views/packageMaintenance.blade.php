@extends('maintenanceLayout')
@section('title', 'Package Maintenance')
@section('body')

<div ng-app="packageController">
    <script type="text/javascript" src="{!! asset('/js/Package_Record_Form.js') !!}"></script>
	<link rel = "stylesheet" href = "{!! asset('/css/Package_Record_Form.css') !!}"/>
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
                <form class = "aside aside z-depth-3" style = "margin-top: 20px; height: 430px; margin-left: 30px;" id="formCreate" ng-submit="CreatePackage()">
                    <div class = "header">
                        <h4 style = "font-family: myFirstFont2; font-size: 1.8vw;padding-top: 10px; margin-top: 10px;">Package Maintenance</h4>
                    </div>

                        <div class="row">
                            <div class = "row" style = "padding-left: 10px; padding-top: -30px;">
                                <div class="input-field col s6">
                                    <input ng-model="strPackageName" id="packageName" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                    <label for="packageName" data-error = "Invalid format." data-success = "">Package Name<span style = "color: red;">*</span></label>
                                </div>
                                <div class="input-field col s6">
                                    <input ng-model="deciPrice" id="packagePrice" type="number" class="validate" required = "" aria-required="true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                                    <label for="packagePrice" data-error = "Invalid format." data-success = "">Package Price<span style = "color: red;">*</span></label>
                                </div>
                                <div class="input-field col s12" style = "padding-bottom: 10px;">
                                    <input ng-model="strPackageDesc" id="packageDesc" type="text" class="validate">
                                    <label for="packageDesc">Package Description</label>
                                </div>
                                <i class = "left" style = "margin-top: 0px; padding-left: 10px; color: red;">*Required Fields</i>
                            </div>



                            <div class = "row">
                                <div class = "col s6" style = "padding-top: -10px; margin-top: -20px;">
                                        <button type = "submit" name = "action" class="modal-trigger btn light-green left" style = "color: black; margin-left: 10px; margin-top: 10px; width: 180px; margin-right: 10px;" href = "#modalItem">View Item/s</button>
                                </div>
                                <div class = "col s6" style = "padding-top: -10px; margin-top: -20px;">
                                        <button type = "submit" name = "action" class="modal-trigger btn light-green left" style = "color: black; margin-top: 10px; margin-right: 10px; width: 180px;" href = "#modalService">View Service/s</button>
                                </div>
                            </div>

                            <label style = "color: black; padding-left: 20px; font-size: 1vw;">Total Price:</label>
                            <br>
                            <label style = "padding-left: 20px; font-size: 1vw;">@{{ totalAmount | currency }}</label>

                        </div>
                    <br><br>
                    <button type = "submit" name = "action" class="btn light-green right" style = "margin-top: -50px; color: black; margin-right: 20px;">Create</button>

                </form>
            </div>
        </div>



        <!-- Modal Item -->
        <div id="modalItem" class="modal" style = "width: 500px;" ng-controller="ctrl.prepareAdditional">
            <div class = "modal-header" style = "height: 55px;">
                <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">Item Inclusion/s</h4>
            </div>
                <div class = "col s12">
                <br>
                        <h6 style = "font-family: arial; padding-left: 10px;">Items</h6>
                        <div id="itemCheckBox" style = "padding-bottom: 20px; padding-left: 10px;">
                            <p ng-repeat="additional in additionals">
                                <input ng-click="AddAdditional(additional.price.deciPrice, $index)" ng-model="checkAdditional[$index]" ng-true-value="true" ng-false-value="false" type="checkbox" name="additionals[]" id="@{{ additional.intAdditionalId }}" value="@{{ additional.intAdditionalId }}" />
                                <label for="@{{ additional.intAdditionalId }}">@{{ additional.strAdditionalName }}( @{{ additional.price.deciPrice | currency }} )</label>
                            </p>
                        </div>
                    </div>

                <br><br><br>
                <label style = "color: black; padding-left: 380px; font-size: 1vw;">Total Item Price:</label>
                <br>
                <label style = "padding-left: 380px; font-size: 1vw;">@{{ totalAdditionalPrice | currency}}</label>

                <div style = "margin-top: 30px;">
                <div class="modal-footer">
                    <button type = "submit" name = "action" class="btn light-green modal-close" style = "color: black; margin-bottom: 0px; margin-top: 6px; margin-left: 10px; ">Done</button>
                </div>
                </div>
        </div>

    <!-- Modal Service -->
    <div id="modalService" class="modal" style = "width: 500px;" ng-controller="ctrl.prepareService">
        <div class = "modal-header" style = "height: 55px;">
            <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">Service Inclusion/s</h4>
        </div>
        <div class="modal-content">
            <div class = "col s12">
                <div class="row">
                    <div >
                        <div>
                            <h6 style = "font-family: arial;">Services</h6>
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

        <label style = "color: black; padding-left: 370px; font-size: 1vw;">Total Service Price:</label>
        <br>
        <label style = "padding-left: 370px; font-size: 1vw;">@{{ totalServicePrice | currency }}</label>
        <br>

        <div class="modal-footer">
            <button name = "action" class="btn light-green modal-close" style = "color: black; margin-left: 10px; ">Done</button>
        </div>
    </div>


    <!-- Modal Update -->
        <form id="modalUpdatePackage" class="modal" style = "width: 650px;" ng-controller="ctrl.updatePackage" ng-submit="SavePackage()">
            <div class = "modal-header" style = "height: 55px;">
                <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw;">Update Package</h4>
            </div>
            <div class="modal-content">
                <i class = "left" style = "margin-top: 0px; padding-left: 10px; color: red;">*Required Fields</i>
                <br><br>

                    <div class="row">
                        <div class="input-field col s6">
                        	<input ng-model="update.intPackageId" id="packageToBeUpdated" type="hidden">
                            <input ng-model="update.strPackageName" value=" " placeholder="Package Name" id="packageNameUpdate" type="text" class="validate" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                            <label for="packageNameUpdate" data-error = "Invalid format." data-success = "">New Package Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s6">
                            <input ng-model="update.deciPrice" value=" " placeholder="Package Price" id="packagePriceUpdate" type="text" class="validate" required = "" aria-required="true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                            <label for="packagePriceUpdate" data-error = "Invalid format." data-success = "">New Package Price<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s12">
                            <input ng-model="update.strPackageDesc" value=" " placeholder="Package Description" id="packageDescUpdate" type="text" class="validate">
                            <label for="packageDescUpdate">New Package Description</label>
                        </div>

                        <button type = "submit" name = "action" class="modal-trigger btn light-green left" style = "color: black; margin-left: 10px; margin-top: 10px; margin-right: 10px;" href = "#modalItem">Item/s</button>
                        <button type = "submit" name = "action" class="modal-trigger btn light-green left" style = "color: black; margin-top: 10px; margin-right: 10px;" href = "#modalService">Service/s</button>
                    </div>
            </div>

            <div class="modal-footer">
                <button type = "submit" name = "action" class="btn light-green" style = "margin-left: 10px; color: black;">Confirm</button>
                <button name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</button>
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
    <div id="modalPackageIncludes" class="modal" style = "width: 500px;" ng-controller="ctrl.packageTable">
        <div class = "modal-header" style = "height: 55px;">
            <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">Package</h4>
        </div>
        <div class="modal-content">
        	<div id="inclusionDiv">
        	   <li ng-repeat="additional in packageAdditional">@{{ additional.strAdditionalName }}</li>
        	</div>
            
        </div>
        <div class="modal-footer">
            <button name = "action" class="modal-close btn light-green" style = "color: black; margin-left: 10px; ">Confirm</button>

        </div>
    </div>

    <div id="modalListOfRequirement" class="modal" style = "width: 550px;" ng-controller="ctrl.packageTable">
            <div class = "modal-header" style = "height: 55px;">
                <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">Package include/s</h4>
            </div>
            <div class="modal-content">
                <ul class="collection with-header">
                    <li class="collection-header"><h4 style = "padding-left: 150px; font-family: arial; font-size: 20px;">Additional List</h4></li>
                    <div ng-repeat="additional in packageAdditionals">
                    <li class="collection-item">@{{ additional.strAdditionalName }}</li>
                    </div>
                    <li class="collection-header"><h4 style = "padding-left: 150px; font-family: arial; font-size: 20px;">Service List</h4></li>
                    <div ng-repeat="service in packageServices">
                    <li class="collection-item">@{{ service.strServiceName }}</li>
                    </div>
                </ul>
            </div>
            <div class="modal-footer">
                <button name = "action" class="modal-close btn light-green" style = "color: black; margin-right: 20px;">Done</button>
            </div>
        </div>


    <!-- Modal Archive Package-->
    <div id="modalArchivePackage" class="modal" style = "height: 400px; width: 600px;" ng-controller="ctrl.deactivatedTable">
        <div class="modal-content">
            <!-- Data Grid Deactivated Package/s-->
            <div id="admin1" class="col s12" style="margin-top: 0px">
                <div class="z-depth-2 card material-table" style="margin-top: 0px">
                    <div class="table-header" style="height: 45px; background-color: #00897b;">
                        <h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 1.7vw; color: white; padding-left: 0px;">Archive Package/s</h4>
                        <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 140px; color: #ffffff;">search</i></a>
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
            <button name = "action" class="btn light-green modal-close right" style = "color: black; margin-bottom: 10px; margin-right: 0px;">DONE</button>
        </div>

    </div>



    <!-- Data Grid -->
        <div class = "col s7" style = "margin-left: 0px; margin-left: 30px; margin-top: 20px;" ng-controller="ctrl.packageTable">
            <div class="row">
                <div id="admin">
                    <div class="z-depth-2 card material-table">
                        <div class="table-header" style="background-color: #00897b;">
                            <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; color: white; padding-left: 0px;">Package Record</h4>

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