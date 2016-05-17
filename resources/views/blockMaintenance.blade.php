@extends('maintenanceLayout')
@section('body')
<!-- Section -->
    <link rel = "stylesheet" href = "{!! asset('/css/Blocks_Record_Form.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/block/block-controller.js') !!}"></script>
    <link rel="stylesheet" type="text/css" href="{!! asset('/css/vaults.css') !!}">

<div ng-app="blockApp">
<h2 style = "font-family: myFirstFont2; padding-left: 50px; font-size: 2vw; margin-top: 20px;">Block Maintenance</h2>
<div class = "col s12" >
    <div class = "row">
        <div class = "responsive">

            <div class = "col s4" style = "width: 420px; margin-left: 30px;">

                <div style = "overflow: auto;height: 370px;">
                    <div class = "col s12">
                        <div class = "aside aside ">

                            <ul class="collapsible" data-collapsible="accordion" ng-controller="ctrl.buildingCollapsible" watch>
	                                <li ng-repeat="building in buildings">
	                                    <div ng-click="GetBuilding(building.intBuildingId, $index)" class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
	                                        <label style = "font-family: myFirstFont; font-size: 1.8vw; color: white;">@{{ building.strBuildingName }}</label>
	                                    </div>
	                                    <div class="collapsible-body">
	                                        <div class="row">
	                                            <div class="col s12 m12">
	                                                <ul class="collapsible" data-collapsible="accordion" watch>
	                                                    <li ng-repeat="floor in building.floors">
	                                                        <div ng-click="GetFloorBlock(floor.intFloorId, $index)" class="collapsible-header" style = "background-color: #ffa726">
	                                                            <i class="material-icons">view_module</i>@{{building.strBuildingCode + floor.intFloorNo }}
	                                                        </div>
	                                                        <div class="collapsible-body" style = "background-color: #ffa726">
	                                                            <p>Create Block
	                                                                <button ng-click="CreateBlock(floor.intFloorId, $index)" name = "action" class="modal-trigger btn-floating light-green right" style = "margin-right: 10px;" href = "#modalCreateBlock"><i class="material-icons">add</i></button>
	                                                            </p>
	                                                        </div>
                                                            <div ng-repeat="block in floor.blocks" class="collapsible-body" style = "background-color: #ffa726" watch>
                                                                <p>@{{ block.strBlockName + "(" + block.strUnitType + ")"}}
                                                                    <button ng-click="DeactivateBlock(block.intBlockId, $index)" name = "action" class="btn tooltipped modal-trigger btn-floating red right" data-position = "bottom" data-delay = "30" data-tooltip = "Floor price is not yet configured."  style = "margin-left: 5px;" href = "#modalDeactivateBlock"><i class="material-icons">not_interested</i></button>
                                                                    <button ng-click="UpdateBlock(block.intBlockId, $index)" name = "action" class="btn tooltipped modal-trigger btn-floating light-green right" data-position = "bottom" data-delay = "30" data-tooltip = "Floor is not yet configured." style = "margin-left: 5px;" href = "#modalUpdateBlock"><i class="material-icons">mode_edit</i></button>
                                                                    <button ng-click="PriceConfig(block.intBlockId, $index)" name = "action" class="btn tooltipped modal-trigger btn-floating yellow right" data-position = "bottom" data-delay = "30" data-tooltip = "Update Floor Price" style = "margin-left: 5px;" href = "#modalUpdateFloorPrice"><i class="material-icons">&#8369</i></button>
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
                    </div>
                </div>
            </div>


            <!-- Modal Create -->
            <div id="modalCreateBlock" class="modal" style = "width: 550px;" ng-controller="ctrl.newBlock">
                <div class = "modal-header" style = "height: 55px;">
                    <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; padding-left: 20px;">Create Block</h4>
                </div>
                <form id="createBlockForm" style = "padding-bottom: 0px;" ng-submit="SaveBlock()">

                    <div style = "margin-top: 0px; padding-top: 0px; padding-left: 10px;">
                        <div class="input-field col s12" style = "padding-bottom: 20px;">
                            <input ng-model="block.intFloorId" id="floorIdBlockToCreate" type="hidden">
                            <input ng-model="block.strBlockName" id="blockName" type="text" class="validate" required = "" aria-required="true" length = "20">
                            <label for="blockName" data-error = "Invalid format." data-success = "">Block Name<span style = "color: red;">*</span></label>
                        </div>

                        <div class="row" style = "padding-top: 0px;">
                            <h5 style = "padding-bottom: 0px; font-family: arial; font-size: 20px;">Block size:</h5>
                            <div class="input-field col s6" style = "padding-left: 10px;">
                                <input ng-model="block.intLevelNo" id="blockLevel" type="number" class="validate" required = "" aria-required = "true" min = "1" max = "10">
                                <label for="blockLevel" data-error = "1-10 only" data-success = "">Level/s:<span style = "color: red;">*</span></label>
                            </div>
                            <div class="input-field col s6">
                                <input ng-model="block.intColumnNo" id="blockColumn" type="number" class="validate" required = "" aria-required = "true" min = "1" max = "20">
                                <label for="blockColumn" data-error = "1-20 only" data-success = "">Unit/s:<span style = "color: red">*</span></label>
                            </div>
                            <div class="input-field col s6" id="divUnitType" ng-repeat="unitType in unitTypes">
                                <input ng-model="block.strFloorTypeName" type="radio" name="unitType" value="@{{ unitType.strFloorTypeName }}" id="@{{ unitType.intFloorTypeId }}">
                                <label for="@{{ unitType.intFloorTypeId }}">@{{ unitType.strFloorTypeName }}</label>
                            </div>
                        </div>
                    </div>

                    <i class = "left" style = "padding-top: 20px; margin-bottom: 0px; padding-left: 30px; color: red;">*Required Fields</i>
                    <div style = "margin-top: 50px;">
                        <div class="modal-footer">
                            <button name = "action" class="btn light-green" style = "color: black; margin-left: 10px;">Confirm</button>
                            <button name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</button>
                        </div>
                    </div>
                </form>

            </div>

            <!-- Modal Update -->
            <div id="modalUpdateBlock" class="modal" style = "width: 400px;" ng-controller="ctrl.updateBlock">
                <form ng-submit="SaveBlock()">
                <div class = "modal-header" style = "height: 55px;">
                    <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw;">Update Block</h4>
                </div>
                <div class="modal-content">
                    <div style = "padding-left: 10px;">
                        <div class="input-field col s12">
                        	<input ng-model="update.intBlockId" id="blockIdUpdate" type="hidden">
                            <input ng-model="update.strBlockName" value=" " id="newBlockName" type="text" class="validate" required = "" aria-required = "true" length = "20">
                            <label class = "active" for="newBlockName" data-error = "Invalid format." data-success = "">New Block Name <span style = "color: red;">*</span></label>
                        </div>
                    </div>
                    <i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>
                </div>
                <br><br><br><br>
                <div class="modal-footer">
                    <button type = "submit" name = "action" class="btn light-green" style = "margin-right: 20px; color: black; margin-left: 10px; ">Confirm</button>
                    </form>
                    <button name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</button>
                </div>
            </div>

            <!-- Modal Deactivate -->
            <div id="modalDeactivateBlock" class="modal" style = "width: 400px;">
                <div class = "modal-header" style = "height: 55px;">
                    <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw;">Deactivate Block</h4>
                </div>
                <div class="modal-content">
                    <p style = "padding-left: 20px; font-size: 15px;">Are you sure you want to deactivate this block?</p>
                </div>
				<input id="blockIdDeactivate" type="hidden">
                <div class="modal-footer">
                    <button onclick="deactivateBlock()" name = "action" class="btn light-green" style = "color: black; margin-left: 10px; ">Confirm</button>
                    <button name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</button>
                </div>
            </div>

            <!-- Modal Archive Block-->
            <div id="modalArchiveBlock" class="modal" style = "height: 400px; width: 600px;" ng-controller="ctrl.deactivatedTable">
                <div class="modal-content">
                    <!-- Data Grid Deactivated Block/s-->
                    <div id="admin1" class="col s12" style="margin-top: 0px">
                        <div class="z-depth-2 card material-table" style="margin-top: 0px">
                            <div class="table-header" style="height: 45px; background-color: #00897b;">
                                <h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 1.8vw; color: white; padding-left: 0px;">Archive Block/s</h4>
                                <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 150px; color: #ffffff;">search</i></a>
                            </div>
                            <table id="datatable2">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Building-Floor</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="block in deactivatedBlocks">
                                    <td>@{{ block.strBlockName }}</td>
                                    <td>@{{ block.strBuildingCode+"-"+block.intFloorNo }}</td>
                                    <td>
                                        <button ng-click="ReactivateBlock(block.intBlockId, $index)" name = "action" class="btn light-green modal-close" style = "color: black;">Activate</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <button name = "action" class="btn light-green modal-close right" style = "color: black; margin-bottom: 10px; margin-right: 30px;">DONE</button>
            </div>
            
 	        <!-- Modal Price -->
            <div id="modalUpdatePrice" class="modal" style = "width: 700px;">
                <div class = "modal-header" style = "height: 55px;">
                    <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 1.8vw; ">Block Price</h4>
                </div>
                <div class="modal-content">
                    <div class = "col s12">
                        <div class = "row">
                            <div style = "padding-left: 10px;">
                                <div class="input-field col s6" ng-repeat="unitCategory in unitCategories">
                                    <input id="UC@{{ unitCategory.intUnitCategoryId }}" type="text" class="validate" required = "" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                                    <label for="UC@{{ unitCategory.intUnitCategoryId }}" data-error = "Invalid format.">Level @{{ unitCategory.intLevelNo }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name = "action" class="waves-effect waves-light btn light-green" style = "color: black; margin-left: 10px; margin-right: 40px;">Confirm</button>
                    <button name = "action" class="waves-effect waves-light btn light-green modal-close" style = "color: black;">Cancel</button>
                </div>
            </div>

            <!-- Data Grid -->
            <div class = "col s7" style = "margin-top: 0px; margin-left: 30px;" ng-controller="ctrl.blockTable" ng-show="tableShow">
                <div class="row">
                    <div id="admin">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header" style="background-color: #00897b;">
                                <h4 style = "font-family: myFirstFont2; font-size: 1.8vw; color: white; padding-left: 0px;">Block Record</h4>
                                <div class="actions">
                                    <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Block/s" style = "margin-right: 10px;" href = "#modalArchiveBlock"><i class="material-icons" style = "color: black">delete</i></button>
                                    <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table id="datatable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Floor Number</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="block in blocks">
                                    <td>@{{ block.strBlockName }}</td>
                                    <td>@{{ block.strUnitType }}</td>
                                    <td>@{{ block.strBuildingName }}</td>
                                    <td>@{{ block.strBuildingCode + "-" + block.intFloorNo }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

             <div class = "col s7" ng-hide="tableShow" ng-controller="ctrl.configPrice">
                <div class = "col s4 z-depth-2 " style = "margin-top: 20px; width: 100%;">
                    <div class="responsive">
                        <div class = "col s12">
                            <div class = "aside aside z-depth-3">
                                <div class="center vaults-content">
                                    <table id="tableUnits" style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                        <tbody>
                                        <tr ng-repeat="unitCategory in unitCategories">
                                            <td style="background-color: green">
                                                <a ng-click="OpenConfig(unitCategory.intUnitCategoryId, $index)" class="waves-effect waves-light modal-trigger">Level @{{ unitCategory.intLevelNo }}</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <a ng-click="tableShow = true" class="waves-effect waves-light btn">Done</a>

                                    <!-- Modal Structure For Unit Status -->
                                    <div id="modal1" class="modal modal-fixed">
                                        <div class="modal-header">
                                            <label style="font-family: myFirstFont2; font-size: 1.8vw">Unit Status</label>
                                        </div>
                                            <div class="row">
                                                <div class="input-field col s3">
                                                    <input ng-model="unit.intUnitId" id="unitToToggle" type="hidden">
                                                    <label style="font-size: 20px">Unit Id: <span style="color: black">@{{ unit.intUnitId }}</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s3">
                                                    <label style="font-size: 20px">Status: <span style="color: @{{ unit.colorStatus }}" id="unitStatus">@{{ unit.strUnitStatus }}</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s3">
                                                </div>
                                                <div class="input-field col s6">
                                                    <button ng-if="unit.unitActive" ng-click="DeactivateUnit()" id="btnDeactivate" class="waves-effect waves-light btn red right" style = "width: 135px;  margin-top: 20px; margin-bottom: 10px;" type="submit">Deactivate</button>
                                                    <button ng-if="unit.unitDeactive" ng-click="ActivateUnit()" id="btnActivate" class="waves-effect waves-light btn red right" style = "width: 130px;  margin-top: 20px; margin-bottom: 10px; margin-right: 10px;" type="submit">Activate</button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

       

<script>
	
	$(document).ready(function() {
	    $('input#input_text, textarea#textarea1').characterCounter();
	});
	$('.modal-trigger').leanModal({
        dismissible: false
  	});
    
</script>
</div>
@endsection