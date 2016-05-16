@extends('maintenanceLayout')
@section('body')

<link href="{!! asset('/css/vaults.css') !!}" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="{!! asset('/unit/unit-controller.js') !!}"></script>
<div ng-app="unitApp">
<!-- Section -->
<h2 style = "font-family: myFirstFont2; font-size: 2vw; padding-left: 55px; margin-bottom: 10px;">Unit Maintenance</h2>
<div class = col s12 >
    <div class = "row">
        <div class = "col s4" style="margin-left: 20px; height: 500px">

            <div class = "col s12" style="margin-top: 0px; margin-left: 0px;" ng-controller="ctrl.buildingCollapsible">
                <div style = "overflow: auto;height: 370px;">
                    <div class = "col s12" style = "margin-left: 0px;">
                        <div class = "aside aside ">

                            <!-- Building -->
                            <ul class="collapsible" data-collapsible="accordion" watch>
								 <li ng-repeat="building in buildings">
                                    <div ng-click="GetBuilding(building.intBuildingId, $index)" class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                        <label style = "font-family: myFirstFont; font-size: 1.8vw; color: white;">@{{ building.strBuildingName }}</label>
                                    </div>
                                    <div class="collapsible-body">
                                        <div class="row">
                                            <div class="col s12 m12">
                                                <ul class="collapsible popout" data-collapsible="accordion" watch>
	                                                <li ng-repeat="floor in building.floors">
                                                        <div ng-click="GetFloorBlock(floor.intFloorId, $index)" class="collapsible-header" style = "background-color: #ffa726">
                                                            <i class="material-icons">view_module</i>@{{ floor.intFloorNo }}
                                                        </div>
                                                    		<div class="collapsible-body" ng-repeat="block in floor.blocks" watch>
	                                                            <p  style = "max-height: 50px; padding-top: 15px; font-size: 1.3vw; font-family: myFirstFont;">@{{ block.strBlockName }}
	                                                            	<button ng-click="GetBlockUnit(block.intBlockId)" name = "action" class="btn tooltipped light-green right btn-floating" data-position = "bottom" data-delay = "30" data-tooltip = "View Block" style = "margin-top: -10px; margin-right: 0px; font-family: arial; color: black;" ><i class="material-icons" style = "color: black">visibility</i></button>
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
        </div>


        <div class = "col s7" ng-controller="ctrl.unitTable">
            <div class = "col s4 z-depth-2 " style = "margin-top: 20px; width: 100%;">
                <div class="responsive">
                    <div class = "col s12">
                        <div class = "aside aside z-depth-3">
                            <div class="center vaults-content">
                                <table id="tableUnits" style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                    <tbody>
                                    <tr ng-repeat="unitLevel in units">
                                        <td ng-repeat="unitColumn in unitLevel">
                                            <a data-target="modal1" class="waves-effect waves-light modal-trigger">@{{ unitColumn.intUnitId }}</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <!-- Modal Structure For Unit Status -->
                                <div id="modal1" class="modal modal-fixed">
                                    <div class="modal-header">
                                        <label style="font-family: myFirstFont2; font-size: 1.8vw">Unit Status</label>
                                    </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                            	<input id="unitToToggle" type="hidden">
                                                <label style="font-size: 20px">Status: <span style="color: green" id="unitStatus"></span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                            </div>
                                            <div class="input-field col s6">
                                                <button onclick="deactivateUnit()" id="btnDeactivate" class="waves-effect waves-light btn red right" style = "width: 135px;  margin-top: 20px; margin-bottom: 10px;" type="submit">Deactivate</button>
                                                <button onclick="activateUnit()" id="btnActivate" class="waves-effect waves-light btn red right" style = "width: 130px;  margin-top: 20px; margin-bottom: 10px; margin-right: 10px;" type="submit">Activate</button>
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
    $('.modal-trigger').leanModal({
            dismissible: false, // Modal can be dismissed by clicking outside of the modal
            opacity: .5, // Opacity of modal background
            in_duration: 300, // Transition in duration
            out_duration: 200, // Transition out duration
            ready: function() { alert('Ready'); }, // Callback for Modal open
            complete: function() { alert('Closed'); } // Callback for Modal close
        }
    );
    $("input:radio").on("click", function() {
            $("input:text").attr("disabled", true);
            $(this).next("input").attr("disabled", false)
    });
    
    </script>
</div>
@endsection